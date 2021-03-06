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
use App\Cloudsa9\Constants\DBTable;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Cloudsa9\Entities\Models\User\User;

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
        $request['name'] = ucwords($request->name);
        $user = $this->userService->create(array_merge($request->all(), ['account_type' => 'paid']));

        // Create contact info
        $contactInfo = $this->contactInfoService->create([
            'user_id' => $user->id,
            'name' => ucwords($user->name),
            'email' => $user->email,
            'phone1' => '',
            'phone2' => '',
            // 'phone3' => '',
            // 'phone4' => '',
            'reward' => 0,
            'message' => '',
        ]);

        // Create lockscreen
        // $lockscreenInfo = $this->lockscreenService->create([
        //     'user_id' => $user->id,
        //     'device' => 'phone',
        //     'lockscreen_color' => 'black',
        // ]);

        // Generate QR code
        $qrCode = storage_path('app/public/qrcode/' . $user->qr_code . '.png');
        // generateQRCode('petid.app/rfp/' . $user->pet_code, $qrCode, $lockscreenInfo->lockscreen_color);
        generateQRCode('petid.app/rfp/' . $user->pet_code, $qrCode);

        // Generate wallpaper
        // $lockscreen = generateLockscreen($user->phone_code, $qrCode, $lockscreenInfo->device, $contactInfo->reward, $lockscreenInfo->lockscreen_color);

        // Save lockscreen to database
        // $this->lockscreenService->update(['lockscreen' => $lockscreen], $lockscreenInfo->id);

        $token = $JWTAuth->fromUser($user);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
        ], 201);
    }

    public function registerViaFb(Request $request,JWTAuth $JWTAuth){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:' . DBTable::USERS,
            'provider' => 'required',
            'provider_id'=> 'required'
        ]);

        $user = User::create([
            'name'=> ucwords($request->name),
            'email'=>$request->email,
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt($request->provider_id),
            'account_type' => 'paid',
            'provider' => $request->provider,
            'provider_id' => $request->provider_id,
        ]);

        $user->roles()->sync([2]);

        // Create contact info
        $contactInfo = $this->contactInfoService->create([
            'user_id' => $user->id,
            'name' => ucwords($user->name),
            'email' => $user->email,
            'phone1' => '',
            'phone2' => '',
            'reward' => 0,
            'message' => '',
        ]);

        $token = $JWTAuth->fromUser($user);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
        ], 201);
    }

    public function registerViaApple(Request $request,JWTAuth $JWTAuth){
        if (empty(request('provider_id'))){
            return response()->json(['error' => 'User ID not found'], 401);
        }
    
        $user = User::create([
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt($request->provider_id),
            'account_type' => 'paid',
            'provider' => 'Apple',
            'provider_id' => $request->provider_id
        ]);
    
        $user->roles()->sync([2]);

        // Create contact info
        $contactInfo = $this->contactInfoService->create([
            'user_id' => $user->id,
            'name' => '',
            'email' => '',
            'phone1' => '',
            'phone2' => '',
            'reward' => 0,
            'message' => '',
        ]);

        $token = $JWTAuth->fromUser($user);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
        ], 201);
    }
}
