<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Domain\Api\V1\Requests\Auth\RegisterRequest;
use App\Domain\Api\V1\Services\Subscriber\ContactInfoService;
use App\Domain\Api\V1\Services\Subscriber\LockscreenService;
use App\Domain\Api\V1\Services\User\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tymon\JWTAuth\JWTAuth;

class RegisterController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;
    /**
     * @var ContactInfoService
     */
    private $contactInfoService;
    /**
     * @var LockscreenService
     */
    private $lockscreenService;

    /**
     * RegisterController constructor.
     *
     * @param UserService $userService
     * @param ContactInfoService $contactInfoService
     * @param LockscreenService $lockscreenService
     */
    public function __construct(UserService $userService, ContactInfoService $contactInfoService, LockscreenService $lockscreenService)
    {
        $this->userService = $userService;
        $this->contactInfoService = $contactInfoService;
        $this->lockscreenService = $lockscreenService;
    }

    /**
     * @param RegisterRequest $request
     * @param JWTAuth $JWTAuth
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request, JWTAuth $JWTAuth)
    {
        // Create new user
        $user = $this->userService->create(array_merge($request->all(), ['account_type' => 'paid']));

        // Create contact info
        $contactInfo = $this->contactInfoService->create([
            'user_id' => $user->id,
            'name' => $user->full_name,
            'email' => $user->email,
            'phone1' => $user->phone,
            'phone2' => '',
            'phone3' => '',
            'phone4' => '',
            'reward' => 0,
            'message' => '',
        ]);

        // Create lockscreen
        $lockscreenInfo = $this->lockscreenService->create([
            'user_id' => $user->id,
            'device' => 'phone',
            'lockscreen_color' => 'black',
        ]);

        // Generate QR code
        $qrCode = storage_path('app/public/qrcode/' . uniqid('', true) . '.png');
        generateQRCode('fowndapp.com/rfp/' . $user->phone_code, $qrCode, $lockscreenInfo->lockscreen_color);

        // Generate wallpaper
        $lockscreen = generateLockscreen($user->phone_code, $qrCode, $lockscreenInfo->device, $contactInfo->reward, $lockscreenInfo->lockscreen_color);

        // Save lockscreen to database
        $this->lockscreenService->update(['lockscreen' => $lockscreen], $lockscreenInfo->id);

        $token = $JWTAuth->fromUser($user);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
        ], 201);
    }
}
