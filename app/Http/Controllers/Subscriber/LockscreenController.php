<?php

namespace App\Http\Controllers\Subscriber;

use App\Cloudsa9\Constants\DeviceType;
use App\Domain\Subscriber\Requests\User\LockscreenRequest;
use App\Domain\Subscriber\Services\User\ContactInfoService;
use App\Domain\Subscriber\Services\User\LockscreenService;
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getMyLockscreen()
    {
        $lockscreenInfo = $this->lockscreenService->findBySubscriber(currentUser()->id);
        $contactInfo = $this->contactInfoService->findBySubscriber(currentUser()->id);

        $devices = DeviceType::all();

        return view('subscriber.modules.lockscreen', [
            'lockscreenInfo' => $lockscreenInfo,
            'contactInfo' => $contactInfo,
            'devices' => $devices
        ]);
    }

    /**
     * @param LockscreenRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postMyLockscreen(LockscreenRequest $request)
    {
        try {
            $lockscreenInfo = $this->lockscreenService->updateOrCreate($request->all());
            $contactInfo = $this->contactInfoService->findBySubscriber(currentUser()->id);

            // Generate QR code
            $qrCode = storage_path('app/public/qrcode/' . uniqid('', true) . '.png');
            generateQRCode('fowndapp.com/rfp/' . currentUser()->phone_code, $qrCode, $lockscreenInfo->lockscreen_color);

            // Generate wallpaper
            $lockscreen = generateLockscreen(currentUser()->phone_code, $qrCode, $lockscreenInfo->device, $contactInfo->reward, $lockscreenInfo->lockscreen_color);

            // Save lockscreen to database
            $this->lockscreenService->update(['lockscreen' => $lockscreen], $lockscreenInfo->id);

            flash()->success('Lockscreen information successfully updated.');
        } catch (Exception $e) {
            logger()->error($e);
            flash()->error('Unable to update lockscreen information.');
        }

        return redirect()->back();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function emailLockscreen()
    {
        $lockscreenInfo = $this->lockscreenService->findBySubscriber(currentUser()->id);

        // Send mail
        Mail::to(currentUser()->email)->send(new SendLockscreen($lockscreenInfo));

        flash()->success('Email successfully sent.');

        return redirect()->back();
    }
}
