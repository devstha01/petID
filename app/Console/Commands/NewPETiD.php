<?php

namespace App\Console\Commands;

use App\Cloudsa9\Entities\Models\User\User;
use App\Domain\Api\V1\Requests\Subscriber\LockscreenRequest;
use App\Mail\NewUserPETiD;
use Illuminate\Console\Command;
use App\Cloudsa9\Constants\DeviceType;
use App\Domain\Api\V1\Services\Subscriber\ContactInfoService;
use App\Domain\Api\V1\Services\Subscriber\LockscreenService;
use App\Http\Controllers\Controller;
use App\Mail\Subscriber\SendLockscreen;
use Illuminate\Support\Facades\Mail;


class NewPETiD extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newuser:petid';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send badge mail for New Users';

    /**
     * @var LockscreenService
     */
    private $lockscreenService;
    /**
     * @var ContactInfoService
     */
    private $contactInfoService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(LockscreenService $lockscreenService, ContactInfoService $contactInfoService)
    {
        $this->lockscreenService = $lockscreenService;
        $this->contactInfoService = $contactInfoService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $new_users = User::where('new_user_status', 0)->get();
        foreach ($new_users as $new_user) {

            try {
                $success = $this->postLockscreen($new_user);
                if ($success) {

                    $lockscreenInfo = $this->lockscreenService->findBySubscriber($new_user->id);

                    // Send mail
                    Mail::to('anand.smartcode@gmail.com')->send(new NewUserPETiD($lockscreenInfo));
                    \Log::warning($new_user->email . ' - Success! new PETiD Mail sent');
                } else {
                    \Log::warning($new_user->email . 'Please update the recovery information.');
                }

            } catch (Exception $e) {
                logger()->error($e);

                \Log::warning($new_user->email . ' - Failed! new PETiD Mail not sent');
            }
        }
        //
    }

    public function postLockscreen($user)
    {
        try {
            $contactInfo = $this->contactInfoService->findBySubscriber($user->id);

            if (!$contactInfo) {
                $response = [
                    'error' => true,
                    'message' => 'Please update the recovery information to view lockscreen preview.',
                ];

                return false;
//             return $response;
            }

//default  = black color
//default  = phone size i.e. 1"
            $lockscreenInfo = $this->lockscreenService->updateOrCreate(['user_id' => $user->id, 'device' => 'phone', 'lockscreen_color' => 'black']);

            // Generate QR code
            $qrCode = storage_path('app/public/qrcode/' . uniqid('', true) . '.png');
            generateQRCode('fowndapp.com/rfp/' . $user->phone_code, $qrCode, 'black');

            // Generate wallpaper
            $lockscreen = generateLockscreen($user->phone_code, $qrCode, 'phone', $contactInfo->postLockscreen, 'black',$contactInfo);

            // Save lockscreen to database
            $newLockScreen = $this->lockscreenService->update(['lockscreen' => $lockscreen], $lockscreenInfo->id);
//            $newLockScreen->lockscreen = unserialize($newLockScreen->lockscreen);

            return true;
//           $response = [
//                'error' => false,
//                'message' => 'Lockscreen information successfully updated.',
//                'lockscreen' => $newLockScreen,
//            ];
        } catch (Exception $e) {
            logger()->error($e);

            return false;
//            $response = [
//                'error' => true,
//                'message' => 'Unable to update lockscreen information.',
//            ];
        }

//        return $response;
    }
}
