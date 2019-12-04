<?php

namespace App\Http\Controllers\Subscriber;

use App\Cloudsa9\Constants\MobilePlatform;
use App\Domain\Subscriber\Requests\User\ContactInfoRequest;
use App\Domain\Subscriber\Services\User\ContactInfoService;
use App\Domain\Subscriber\Services\User\LockscreenService;
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
    public function __construct(ContactInfoService $contactInfoService, LockscreenService $lockscreenService)
    {
        $this->contactInfoService = $contactInfoService;
        $this->lockscreenService = $lockscreenService;
    }

    /**
     * Show the subscriber contact info.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getContactInfo()
    {
        $contactInfo = $this->contactInfoService->findBySubscriber(currentUser()->id);
        $mobilePlatforms = MobilePlatform::all();

        return view('subscriber.modules.contact-info', ['contactInfo' => $contactInfo, 'mobilePlatforms' => $mobilePlatforms]);
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
            $secondaryPhones = $request->only(['phone1', 'phone2', 'phone3', 'phone4']);

            $contactInfo = $this->contactInfoService->updateOrCreate($request->all());

            // Send text to secondary phone numbers
            $this->notifySecondaryPhoneNumber($oldContactInfo, $secondaryPhones);

            $lockscreenInfo = $this->lockscreenService->findBySubscriber(currentUser()->id);

            if ($lockscreenInfo) {
                // Generate QR code
                $qrCode = storage_path('app/public/qrcode/' . uniqid('', true) . '.png');
                generateQRCode('fowndapp.com/rfp/' . currentUser()->phone_code, $qrCode, $lockscreenInfo->lockscreen_color);

                // Generate wallpaper
                $lockscreen = generateLockscreen(currentUser()->phone_code, $qrCode, $lockscreenInfo->device, $contactInfo->reward, $lockscreenInfo->lockscreen_color);

                // Save lockscreen to database
                $this->lockscreenService->update(['lockscreen' => $lockscreen], $lockscreenInfo->id);
            }

            flash()->success('Recovery information successfully updated.');

            return redirect()->back();
        } catch (Exception $e) {
            logger()->error($e);
            flash()->error('Unable to update recovery information.');
        }

        return redirect()->back();
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
//        try {
//            if (!is_null($phone)) {
//                Twilio::message($phone, $message);
//            }
//        } catch (Exception $e) {
//            logger()->error($e);
//        }
    }
}
