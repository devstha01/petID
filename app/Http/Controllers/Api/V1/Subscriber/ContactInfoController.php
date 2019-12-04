<?php

namespace App\Http\Controllers\Api\V1\Subscriber;

use App\Domain\Api\V1\Requests\Subscriber\ContactInfoRequest;
use App\Domain\Api\V1\Services\Subscriber\ContactInfoService;
// use App\Domain\Api\V1\Services\Subscriber\LockscreenService;
use App\Http\Controllers\Controller;
use Exception;
use Twilio;

class ContactInfoController extends Controller
{
    /**
     * @var ContactInfoService
     */
    private $contactInfoService;
    /**
     * @var LockscreenService
     */
    private $lockscreenService;

    /**
     * ContactInfoController constructor.
     *
     * @param ContactInfoService $contactInfoService
     * @param LockscreenService $lockscreenService
     */
    public function __construct(ContactInfoService $contactInfoService)
    {
        $this->contactInfoService = $contactInfoService;
        // $this->lockscreenService = $lockscreenService;
    }

    /**
     * @return mixed|string
     */
    public function getContactInfo()
    {
        $contactInfo = $this->contactInfoService->findBySubscriber(currentUser()->id);

        if ($contactInfo) {
            foreach ($contactInfo->toArray() as $contactInfoKey => $contactInfoValue) {
                if (is_null($contactInfoValue)) {
                    $contactInfo[$contactInfoKey] = "";
                }
            }
        }

        if (!$contactInfo) {
            return response()->json([
                'message' => 'No recovery information found.'
            ]);
        }

        return response()->json($contactInfo);
    }

    /**
     * Update subscriber contact info
     *
     * @param ContactInfoRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function postContactInfo(ContactInfoRequest $request)
    {
        try {
            $oldContactInfo = $this->contactInfoService->findBySubscriber(currentUser()->id);
            $secondaryPhones = $request->only(['phone1', 'phone2']);

            $contactInfo = $this->contactInfoService->updateOrCreate($request->all());

            // Send text to secondary phone numbers
//            $this->notifySecondaryPhoneNumber($oldContactInfo, $secondaryPhones);

            // $lockscreenInfo = $this->lockscreenService->findBySubscriber(currentUser()->id);

            // if ($lockscreenInfo) {
            //     // Generate QR code
            //     $qrCode = storage_path('app/public/qrcode/' . uniqid('', true) . '.png');
            //     generateQRCode('fowndapp.com/rfp/' . currentUser()->phone_code, $qrCode, $lockscreenInfo->lockscreen_color);

            //     // Generate wallpaper
            //     $lockscreen = generateLockscreen(currentUser()->phone_code, $qrCode, $lockscreenInfo->device, $contactInfo->reward, $lockscreenInfo->lockscreen_color);

            //     // Save lockscreen to database
            //     $this->lockscreenService->update(['lockscreen' => $lockscreen], $lockscreenInfo->id);
            // }

            $response = [
                'error' => false,
                'message' => 'Recovery information successfully updated.',
                'recovery-info' => $contactInfo,
            ];
        } catch (Exception $e) {
            logger()->error($e);

            $response = [
                'error' => true,
                'message' => 'Unable to update recovery information.',
                'user' => currentUser(),
            ];
        }

        return response()->json($response);
    }

    /**
     * @param $contactInfo
     * @param $inputs
     */
    protected function notifySecondaryPhoneNumber($contactInfo, $inputs): void
    {
        $message = 'Hello. ' . currentUser()->full_name . ' has added this number as a secondary contact for phone recovery at fowndapp.com.';

        foreach ($inputs as $inputKey => $inputValue) {
            optional($contactInfo)->$inputKey != $inputValue ? $this->sendTextMessage($inputValue, $message) : false;
        }
    }

    /**
     * @param $phone
     * @param $message
     */
    protected function sendTextMessage($phone, $message): void
    {
        try {
            if (!is_null($phone)) {
                Twilio::message($phone, $message);
            }
        } catch (Exception $e) {
            logger()->error($e);
        }
    }
}
