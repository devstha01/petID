<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Cloudsa9\Entities\Models\User\User;
use App\Mail\NewUserPETiD;
use App\Cloudsa9\Repositories\User\UserRepository;
use App\Domain\Api\V1\Services\Subscriber\ContactInfoService;
use App\Domain\Api\V1\Services\Subscriber\LockscreenService;
use App\Http\Controllers\Controller;
use App\Mail\Subscriber\SendLockscreen;
use Illuminate\Support\Facades\Mail;
use PDF;


class TagController extends Controller
{
    private $lockscreenService;
    private $contactInfoService;
    
    public function __construct(LockscreenService $lockscreenService, ContactInfoService $contactInfoService)
    {
        $this->lockscreenService = $lockscreenService;
        $this->contactInfoService = $contactInfoService;
    }

    public function getNewUserTag(){
        $new_users = User::where('new_user_status', 0)->get();
    
        $fileName = uniqid('', true);

        // $savepdf = storage_path('app/public/tag/' . $fileName . '.pdf');
        $pdf = PDF::loadView('admin.modules.tag');
        return $pdf->stream('certificate.pdf');

        // PDF::loadView('admin.modules.tag',array(
        //     'newUsers'=>$new_users
        // ))->save($savepdf);
        
    }

}
