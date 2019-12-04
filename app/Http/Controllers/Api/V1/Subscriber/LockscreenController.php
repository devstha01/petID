<?php

namespace App\Http\Controllers\Api\V1\Subscriber;

use App\Cloudsa9\Constants\DeviceType;
use App\Domain\Api\V1\Requests\Subscriber\LockscreenRequest;
use App\Domain\Api\V1\Services\Subscriber\ContactInfoService;
use App\Domain\Api\V1\Services\Subscriber\LockscreenService;
use App\Http\Controllers\Controller;
use App\Mail\Subscriber\SendLockscreen;
use Illuminate\Support\Facades\Mail;

class LockscreenController extends Controller
{
    /**
     * @var LockscreenService
     */
    private $lockscreenService;
    /**
     * @var ContactInfoService
     */
    private $contactInfoService;

    /**
     * LockscreenController constructor.
     * @param LockscreenService $lockscreenService
     * @param ContactInfoService $contactInfoService
     */
    public function __construct(LockscreenService $lockscreenService, ContactInfoService $contactInfoService)
    {
        $this->lockscreenService = $lockscreenService;
        $this->contactInfoService = $contactInfoService;
    }

    /**
     * @return array
     */
    public function getLockscreen()
    {
        $lockScreenInfo = $this->lockscreenService->findBySubscriber(currentUser()->id);

        if ($lockScreenInfo) {
            foreach ($lockScreenInfo->toArray() as $lockScreenInfoKey => $lockScreenInfoValue) {
                if (is_null($lockScreenInfoValue)) {
                    $lockScreenInfo[$lockScreenInfoKey] = "";
                }
            }
        }

        $devices = DeviceType::all();

        $response = [
            'error' => false,
            'lockscreenInfo' => $lockScreenInfo,
            'devices' => $devices
        ];

        if (!$lockScreenInfo) {
            $response = [
                'error' => false,
                'lockscreenInfo' => '',
                'devices' => $devices,
                'message' => 'Please update the lockscreen information to view lockscreen preview.',
            ];
        }

        return $response;
    }

    /**
     * @param LockscreenRequest $request
     * @return array
     */
    public function postLockscreen(LockscreenRequest $request)
    {
        try {
            $contactInfo = $this->contactInfoService->findBySubscriber(currentUser()->id);

            if (!$contactInfo) {
                $response = [
                    'error' => true,
                    'message' => 'Please update the recovery information to view lockscreen preview.',
                ];

                return $response;
            }

            $lockscreenInfo = $this->lockscreenService->updateOrCreate($request->all());

            // Generate QR code
            $qrCode = storage_path('app/public/qrcode/' . uniqid('', true) . '.png');
            generateQRCode('fowndapp.com/rfp/' . currentUser()->phone_code, $qrCode, $lockscreenInfo->lockscreen_color);

            // Generate wallpaper
            $lockscreen = generateLockscreen(currentUser()->phone_code, $qrCode, $lockscreenInfo->device, $contactInfo->postLockscreen, $lockscreenInfo->lockscreen_color);

            // Save lockscreen to database
            $newLockScreen = $this->lockscreenService->update(['lockscreen' => $lockscreen], $lockscreenInfo->id);
            $newLockScreen->lockscreen =unserialize($newLockScreen->lockscreen) ;
            $response = [
                'error' => false,
                'message' => 'Lockscreen information successfully updated.',
                'lockscreen' => $newLockScreen,
            ];
        } catch (Exception $e) {
            logger()->error($e);

            $response = [
                'error' => true,
                'message' => 'Unable to update lockscreen information.',
            ];
        }

        return $response;
    }

    /**
     * @return array
     */
    public function emailLockscreen()
    {
        try {
            $lockscreenInfo = $this->lockscreenService->findBySubscriber(currentUser()->id);

            // Send mail
            Mail::to(currentUser()->email)->send(new SendLockscreen($lockscreenInfo));

            $response = [
                'error' => false,
                'message' => 'Lockscreen email successfully sent.',
            ];
        } catch (Exception $e) {
            logger()->error($e);

            $response = [
                'error' => true,
                'message' => 'Unable to email lockscreen information.',
                'user' => currentUser(),
            ];
        }

        return $response;
    }
}
