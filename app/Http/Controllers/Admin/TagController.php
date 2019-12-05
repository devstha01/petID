<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Cloudsa9\Entities\Models\User\User;
use App\Mail\NewUserPETiD;
use App\Cloudsa9\Repositories\User\UserRepository;
// use App\Domain\Api\V1\Services\Subscriber\ContactInfoService;
// use App\Domain\Api\V1\Services\Subscriber\LockscreenService;
use App\Http\Controllers\Controller;
// use App\Mail\Subscriber\SendLockscreen;
use Illuminate\Support\Facades\Mail;
use PDF;
use Image;


class TagController extends Controller
{
    // private $lockscreenService;
    // private $contactInfoService;
    
    // public function __construct(LockscreenService $lockscreenService, ContactInfoService $contactInfoService)
    // {
    //     $this->lockscreenService = $lockscreenService;
    //     $this->contactInfoService = $contactInfoService;
    // }

    // public function getNewPetTag(){
    //     $new_users = User::where('new_user_status', 0)->get();
    
    //     $fileName = uniqid('', true);

    //     // $savepdf = storage_path('app/public/tag/' . $fileName . '.pdf');
    //     $pdf = PDF::loadView('admin.modules.tag');
    //     return $pdf->stream('certificate.pdf');

    //     // PDF::loadView('admin.modules.tag',array(
    //     //     'newUsers'=>$new_users
    //     // ))->save($savepdf);
        
    // }


     public function tag()
     {

        $bgColor = '#000000';
        $textColor = '#ffffff';
    
        $img = Image::canvas(192, 192);
        $img->circle(192, 96, 96, function ($draw) use ($bgColor) {
            $draw->background($bgColor);
        });
        $img1 = Image::canvas(192, 192);
        $img1->circle(192, 96, 96, function ($draw) use ($bgColor) {
            $draw->background($bgColor);
        });


        $fontPathExtraBold = public_path('fonts/Raleway/Raleway-ExtraBold.ttf');
        $fontPathBold = public_path('fonts/Raleway/Raleway-Bold.ttf');
        $fontPathSemiBold = public_path('fonts/Raleway/Raleway-SemiBold.ttf');
        $fontPathLight = public_path('fonts/Raleway/Raleway-Light.ttf');


        $img1->text('ROCCO', 96, 50, function ($font) use ($fontPathExtraBold, $textColor) {
            $font->file($fontPathExtraBold);
            $font->size(18);
            $font->color($textColor);
            $font->align('center');
        });

        $img1->text('12345', 96, 75, function ($font) use ($textColor, $fontPathExtraBold) {
            $font->file($fontPathExtraBold);
            $font->size(16);
            $font->color($textColor);
            $font->align('center');
        });
        $img1->text('SCAN OR BROWSE:', 96, 100, function ($font) use ($textColor, $fontPathExtraBold) {
            $font->file($fontPathExtraBold);
            $font->size(16);
            $font->color($textColor);
            $font->align('center');
        });
        $img1->text('PET-ID.APP/RFP/12345', 96, 125, function ($font) use ($textColor, $fontPathExtraBold) {
            $font->file($fontPathExtraBold);
            $font->size(13);
            $font->color($textColor);
            $font->align('center');
        });
      
        //QR Code
        $qrCode = url('/qrcode.png');
        // Insert QR Code
        $insertQr = Image::make($qrCode)->resize(122, 122);
        $img->insert($insertQr, 'center');

  

        $fileName = uniqid('', true);
        $fileName1 = uniqid('', true);
        $fileName2 = uniqid('', true);

        $saveimg = storage_path('app/public/tag/image/' . $fileName . '.jpg');
        $saveimg1 = storage_path('app/public/tag/image/' . $fileName1 . '.jpg');
  
        $img->save($saveimg);
        $img1->save($saveimg1);

        $savepdf = storage_path('app/public/wallpaper/' . $fileName . '.pdf');
        $savepdf1 = storage_path('app/public/wallpaper/' . $fileName1 . '.pdf');

        PDF::loadHTML("<img src='" . $saveimg . "'>")->save($savepdf);
        PDF::loadHTML("<img src='" . $saveimg1 . "'>")->save($savepdf1);
        return 'done';
    }

}
