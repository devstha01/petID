<?php

use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

/**
 * Generate QR Code
 *
 * @param $content
 * @param $fileName
 * @param $backgroundColor
 * @return void
 */
// function generateQRCode($content, $fileName, $backgroundColor): void
// {
//     if ($backgroundColor == 'black') {
//         QrCode::format('png')->size(200)->generate($content, $fileName);
// //    } elseif ($backgroundColor == 'image') {
// //        QrCode::format('png')->size(200)->generate($content, $fileName);
//     } else {
//         QrCode::format('png')->size(200)->generate($content, $fileName);
//     }
// }

function generateQRCode($content, $fileName): void
{
    QrCode::format('png')->size(250)->generate($content, $fileName);
}

/**
 * @param $phoneCode
 * @param $qrCode
 * @param $device
 * @param $reward
 * @param $backgroundColor
 * @return string
 */
function generateLockscreen($phoneCode, $qrCode, $device, $reward, $backgroundColor,$user): string
{

//    $bgColor = $backgroundColor == 'black' ? '#000000' : '#ffffff';
//    $textColor = $backgroundColor == 'black' ? '#ffffff' : '#000000';
    if ($backgroundColor == 'white') {
        $bgColor = '#ffffff';
        $textColor = '#000000';
    } else {
        $bgColor = '#000000';
        $textColor = '#ffffff';
    }

    /*
    phone = 1" size
    tablet = 1.25" size
    */

    // Create a new empty image resource with $bgColor background
    if ($device == 'phone') {
        $img = Image::canvas(192, 192);
        $img->circle(192, 96, 96, function ($draw) use ($bgColor) {
            $draw->background($bgColor);
        });
        $img1 = Image::canvas(192, 192);
        $img1->circle(192, 96, 96, function ($draw) use ($bgColor) {
            $draw->background($bgColor);
        });
//        $customPaper = array(0, 0, 192, 192);
    } elseif ($device == 'tablet') {
        $img = Image::canvas(240, 240);
        $img->circle(240, 120, 120, function ($draw) use ($bgColor) {
            $draw->background($bgColor);
        });
        $img1 = Image::canvas(240, 240);
        $img1->circle(240, 120, 120, function ($draw) use ($bgColor) {
            $draw->background($bgColor);
        });
//        $customPaper = array(0, 0, 240, 240);
    }

//    if ($backgroundColor == 'image') {
//        if (request()->has('image')) {
//            $image = request('image');
//            $backgroundImage = makeBackgroundImage($image, $device);
//            if ($backgroundImage !== false) {
//                $img->insert($backgroundImage, 'center');
//                return customImageLockscreen($img, $device, $reward, $qrCode, $phoneCode, $textColor);
//            }
//        }
//    }

    $fontPathExtraBold = public_path('fonts/Raleway/Raleway-ExtraBold.ttf');
    $fontPathBold = public_path('fonts/Raleway/Raleway-Bold.ttf');
    $fontPathSemiBold = public_path('fonts/Raleway/Raleway-SemiBold.ttf');
    $fontPathLight = public_path('fonts/Raleway/Raleway-Light.ttf');

    if ($device == 'phone') {
        // Insert text
        $img1->text('ROCCO', 96, 50, function ($font) use ($fontPathExtraBold, $textColor) {
            $font->file($fontPathExtraBold);
            $font->size(18);
            $font->color($textColor);
            $font->align('center');
        });

        $img1->text($phoneCode, 96, 75, function ($font) use ($textColor, $fontPathExtraBold) {
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
        $img1->text('PET-ID.APP/RFP/' . $phoneCode, 96, 125, function ($font) use ($textColor, $fontPathExtraBold) {
            $font->file($fontPathExtraBold);
            $font->size(13);
            $font->color($textColor);
            $font->align('center');
        });
      

        // Insert QR Code
        $insertQr = Image::make($qrCode)->resize(122, 122);
        $img->insert($insertQr, 'center');

    } else {
        $img1->text('ROCCO', 120, 75, function ($font) use ($fontPathExtraBold, $textColor) {
            $font->file($fontPathExtraBold);
            $font->size(22);
            $font->color($textColor);
            $font->align('center');
        });

        $img1->text($phoneCode, 120, 105, function ($font) use ($textColor, $fontPathExtraBold) {
            $font->file($fontPathExtraBold);
            $font->size(20);
            $font->color($textColor);
            $font->align('center');
        });
        $img1->text('SCAN OR BROWSE:', 120, 135, function ($font) use ($textColor, $fontPathExtraBold) {
            $font->file($fontPathExtraBold);
            $font->size(20);
            $font->color($textColor);
            $font->align('center');
        });
        $img1->text('PET-ID.APP/RFP/' . $phoneCode, 120, 165, function ($font) use ($textColor, $fontPathExtraBold) {
            $font->file($fontPathExtraBold);
            $font->size(17);
            $font->color($textColor);
            $font->align('center');
        });

    
        // Insert QR Code
        $insertQr = Image::make($qrCode)->resize(150, 150);
        $img->insert($insertQr, 'center');
    }

    $fileName = uniqid('', true);
    $fileName1 = uniqid('', true);
    $fileName2 = uniqid('', true);

    $saveimg = storage_path('app/public/wallpaper/image/' . $fileName . '.jpg');
    $saveimg1 = storage_path('app/public/wallpaper/image/' . $fileName1 . '.jpg');
    // Save file
    $img->save($saveimg);
    $img1->save($saveimg1);

    $savepdf = storage_path('app/public/wallpaper/' . $fileName . '.pdf');
    $savepdf1 = storage_path('app/public/wallpaper/' . $fileName1 . '.pdf');

    PDF::loadHTML("<img src='" . $saveimg . "'>")->save($savepdf);
    PDF::loadHTML("<img src='" . $saveimg1 . "'>")->save($savepdf1);

//    CSV of user info
    $savecsv = storage_path('app/public/wallpaper/' . $fileName2 . '.csv');
    $results = [
        0 => ['name',$user->name],
        1 => ['email',$user->email],
        2 => ['phone1',$user->phone1],
        3 => ['phone2',$user->phone2],
        4 => ['phone3',$user->phone3],
        5 => ['phone4',$user->phone4],
        6 => ['address1',$user->address1],
        7 => ['address2',$user->address2],
        8 => ['city',$user->city],
        9 => ['state',$user->state],
        10 => ['zip',$user->zip],
    ];
    $csvfilename = $fileName2 . '.csv';
    $fd = fopen($savecsv, "w");
    foreach ($results as $row) {
        fputcsv($fd, $row);
    }
    fclose($fd);

    return serialize([
        'back' => $fileName . ".pdf",
        'front' => $fileName1 . ".pdf",
        'info' => $csvfilename
    ]);
}

function makeBackgroundImage($image, $device)
{
    if (preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {
        $image = substr($image, strpos($image, ',') + 1);
        $type = strtolower($type[1]); // jpg, png, gif

        if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
            return false;
        }
        $image = base64_decode($image);
        if ($image === false) {
            return false;
        }
        $img = Image::make($image);
        if ($device == 'phone') {
            $whitePatchCanvas = Image::canvas(750, 1624);
            $ratio = 750 / 1624;
            $imageratio = $img->width() / $img->height();
            if ($ratio > $imageratio) {
                $img = $img->resize(750, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            } else {
                $img = $img->resize(null, 1624, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $whitePatchCanvas->insert($img, 'center');
//            $img = $img->resize(260,410)->fill('#000000')->opacity(70);;
            $img = $img->resize(750, 240)->fill('#000000')->opacity(80);
            $whitePatchCanvas->insert($img, null, 0, 920);
        } elseif ($device == 'tablet') {
            $whitePatchCanvas = Image::canvas(1278, 1704);
            $ratio = 1278 / 1704;
            $imageratio = $img->width() / $img->height();
            if ($ratio > $imageratio) {
                $img = $img->resize(1278, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            } else {
                $img = $img->resize(null, 1704, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
            $whitePatchCanvas->insert($img, 'center');
//            $img = $img->resize(260,410)->fill('#000000')->opacity(70);;
            $img = $img->resize(1278, 240)->fill('#000000')->opacity(80);
            $whitePatchCanvas->insert($img, null, 0, 1020);
        }
        return $whitePatchCanvas;
    }

}

function customImageLockscreen($img, $device, $reward, $qrCode, $phoneCode, $textColor)
{

    $fontPathExtraBold = public_path('fonts/Raleway/Raleway-ExtraBold.ttf');
    $fontPathBold = public_path('fonts/Raleway/Raleway-Bold.ttf');
    $fontPathSemiBold = public_path('fonts/Raleway/Raleway-SemiBold.ttf');
    $fontPathLight = public_path('fonts/Raleway/Raleway-Light.ttf');

    if ($device == 'phone') {
        if ($reward) {
            // Insert text
            $img->text('If You\'ve found this device claim your ', 60, 1000, function ($font) use ($fontPathExtraBold) {
                $font->file($fontPathExtraBold);
                $font->size(19);
                $font->color('#ffffff');
            });

            // Insert text
            $img->text('reward by scanning or visiting:', 80, 1025, function ($font) use ($textColor, $fontPathExtraBold) {
                $font->file($fontPathExtraBold);
                $font->size(19);
                $font->color('#ffffff');
            });

            // Insert text
            $img->text('FowndApp.com/rfp/' . $phoneCode, 90, 1065, function ($font) use ($textColor, $fontPathExtraBold) {
                $font->file($fontPathExtraBold);
                $font->size(20);
                $font->color($textColor);
            });

            // Insert text
            $img->text('Protected by', 100, 1120, function ($font) use ($textColor, $fontPathLight) {
                $font->file($fontPathLight);
                $font->size(18);
                $font->color($textColor);
            });

            // Insert text
            $img->text('FowndApp.com', 220, 1120, function ($font) use ($textColor, $fontPathBold) {
                $font->file($fontPathBold);
                $font->size(18);
                $font->color('#fb8122');
            });

            // Insert QR Code
            $img->insert($qrCode, null, 490, 940);
        } else {
            // Insert text
            $img->text('If You\'ve found this device ', 100, 1000, function ($font) use ($fontPathExtraBold) {
                $font->file($fontPathExtraBold);
                $font->size(19);
                $font->color('#ffffff');
            });

            // Insert text
            $img->text('please scan or visit:', 130, 1025, function ($font) use ($textColor, $fontPathExtraBold) {
                $font->file($fontPathExtraBold);
                $font->size(19);
                $font->color('#ffffff');
            });

            // Insert text
            $img->text('FowndApp.com/rfp/' . $phoneCode, 90, 1065, function ($font) use ($textColor, $fontPathExtraBold) {
                $font->file($fontPathExtraBold);
                $font->size(20);
                $font->color($textColor);
            });

            // Insert text
            $img->text('Protected by', 100, 1120, function ($font) use ($textColor, $fontPathLight) {
                $font->file($fontPathLight);
                $font->size(18);
                $font->color($textColor);
            });

            // Insert text
            $img->text('FowndApp.com', 220, 1120, function ($font) use ($textColor, $fontPathBold) {
                $font->file($fontPathBold);
                $font->size(18);
                $font->color('#fb8122');
            });

            // Insert QR Code
            $img->insert($qrCode, null, 490, 940);
        }
    } else {
        if (!$reward) {
            // Insert text
            $img->text('If You\'ve found this device claim your ', 260, 1100, function ($font) use ($fontPathExtraBold) {
                $font->file($fontPathExtraBold);
                $font->size(19);
                $font->color('#ffffff');
            });

            // Insert text
            $img->text('reward by scanning or visiting:', 280, 1125, function ($font) use ($textColor, $fontPathExtraBold) {
                $font->file($fontPathExtraBold);
                $font->size(19);
                $font->color('#ffffff');
            });

            // Insert text
            $img->text('FowndApp.com/rfp/' . $phoneCode, 290, 1165, function ($font) use ($textColor, $fontPathExtraBold) {
                $font->file($fontPathExtraBold);
                $font->size(20);
                $font->color($textColor);
            });

            // Insert text
            $img->text('Protected by', 300, 1220, function ($font) use ($textColor, $fontPathLight) {
                $font->file($fontPathLight);
                $font->size(18);
                $font->color($textColor);
            });

            // Insert text
            $img->text('FowndApp.com', 420, 1220, function ($font) use ($textColor, $fontPathBold) {
                $font->file($fontPathBold);
                $font->size(18);
                $font->color('#fb8122');
            });

            // Insert QR Code
            $img->insert($qrCode, null, 690, 1040);

        } else {
            // Insert text
            $img->text('If You\'ve found this device ', 300, 1100, function ($font) use ($fontPathExtraBold) {
                $font->file($fontPathExtraBold);
                $font->size(19);
                $font->color('#ffffff');
            });

            // Insert text
            $img->text('please scan and visit:', 330, 1125, function ($font) use ($textColor, $fontPathExtraBold) {
                $font->file($fontPathExtraBold);
                $font->size(19);
                $font->color('#ffffff');
            });

            // Insert text
            $img->text('FowndApp.com/rfp/' . $phoneCode, 290, 1165, function ($font) use ($textColor, $fontPathExtraBold) {
                $font->file($fontPathExtraBold);
                $font->size(20);
                $font->color($textColor);
            });

            // Insert text
            $img->text('Protected by', 300, 1220, function ($font) use ($textColor, $fontPathLight) {
                $font->file($fontPathLight);
                $font->size(18);
                $font->color($textColor);
            });

            // Insert text
            $img->text('FowndApp.com', 420, 1220, function ($font) use ($textColor, $fontPathBold) {
                $font->file($fontPathBold);
                $font->size(18);
                $font->color('#fb8122');
            });

            // Insert QR Code
            $img->insert($qrCode, null, 690, 1040);

        }
    }

    $fileName = 'wallpaper/' . uniqid('', true) . '.jpg';

    // Save file
    $img->save(storage_path('app/public/' . $fileName));

    return $fileName;
}
