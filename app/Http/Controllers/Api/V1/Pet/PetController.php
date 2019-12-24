<?php

namespace App\Http\Controllers\Api\V1\Pet;

use Illuminate\Http\Request;
use App\Cloudsa9\Entities\Models\User\UserPet;
use App\Cloudsa9\Entities\Models\User\ContactInfo;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use File;
use Image;

class PetController extends Controller
{

    public function user()
    {
        return currentUser();
    }
    public function getMyPets()
    {
        $pets = $this->user()->pets()->get();
        $data = [];
        foreach ($pets as $pet) {
            $data[] = $this->dataFormat($pet);
        }
        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    public function getMyPet($id)
    {
        $pet = UserPet::find($id);
        if (!$pet) {
            return response()->json([
                'status' => false,
                'message' => 'No Pet exists with that id'
            ]);
        }
        return response()->json([
            'status' => true,
            'data' => $this->dataFormat($pet)
        ]);
    }

    public function postPet(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'color' => 'required',
            'breed' => 'required',
            'image1' => 'required',
            'image2' => 'required',
            'status' => 'required'
        ]);

        if ($request->image1) {
            $image1UploadStatus1 = $this->uploadPetImage($request->image1);
            if ($image1UploadStatus1['status'] === false) return $image1UploadStatus1;
        }
        if ($request->image2) {
            $image1UploadStatus2 = $this->uploadPetImage($request->image2);
            if ($image1UploadStatus2['status'] === false) return $image1UploadStatus2;
        }

        $pet = UserPet::create([
            'user_id' => currentUser()->id,
            'name' => $request->name,
            'pet_code' => str_shuffle(substr(uniqid(), 0, 6)),
            'qr_code' => str_shuffle(substr(uniqid(), 0, 10)),
            'gender' => $request->gender,
            'color' => $request->color,
            'breed' => $request->breed,
            'image1' => $image1UploadStatus1['image'],
            'image2' => $image1UploadStatus2['image'],
            'status' => $request->status,
            'status_verified_at' => Carbon::now(),
            'message' => $request->message,
        ]);

        $contacInfo = ContactInfo::where('user_id', $pet->user_id)->first();

        $qrCode = storage_path('app/public/qrcode/' . $pet->qr_code . '.png');
        // generateQRCode('petid.app/rfp/' . $user->pet_code, $qrCode, $lockscreenInfo->lockscreen_color);
        generateQRCode('petid.app/rfp/' . $pet->pet_code, $qrCode);
        
        $backTag = $this->makeCurveQrImage($pet->qr_code, $pet->pet_code);
        $pet->update([
            'back_tag'=> $backTag,
        ]);

        $frontTag = $this->makeCurveImageWithPetName($pet->pet_code, $pet->name, $contacInfo->phone1, $contacInfo->phone2);
        $pet->update([
            'front_tag'=> $frontTag
        ]);

        if ($pet) {
            return response()->json([
                'status' => true,
                'message' => 'Pet Created Successfully',
                'data' => $this->dataFormat($pet)
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'failed to save pets. Something went wrong'
        ]);
    }

    public function updateMyPet(Request $request, $id)
    {
        $pet = UserPet::find($id);
        if (!$pet) {
            return response()->json([
                'status' => false,
                'message' => 'No Pet exists with that id'
            ]);
        }
        $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'color' => 'required',
            'breed' => 'required',
            'status' => 'required'
        ]);

        if ($request->status != $pet->status) {
            $statusVerified = Carbon::now();
        } else {
            $statusVerified = $pet->status_verified_at;
        }

        $pet->update([
            'user_id' => currentUser()->id,
            'name' => $request->name,
            'gender' => $request->gender,
            'color' => $request->color,
            'breed' => $request->breed,
            'status' => $request->status,
            'status_verified_at' => $statusVerified,
            'message' => $request->message,
        ]);

        return response()->json([
            'status' => true,
            'data' => $this->dataFormat($pet)
        ]);
    }

    public function myPetImageUpload($id, Request $request)
    {
        $pet = UserPet::find($id);
        if (!$pet) {
            return response()->json([
                'status' => false,
                'message' => 'No Pet exists with that id'
            ]);
        }

        $request->validate([
            'image_key' => 'required',
            'image' => 'required'
        ]);

        if (!$request->image_key == ('image1' || 'image2')) return response()->json([
            'status' => false,
            'message' => 'Wrong key'
        ]);

        $image1UploadStatus = $this->uploadPetImage($request->image);
        if ($image1UploadStatus['status'] === false) return $image1UploadStatus;
        $image = $this->uploadPetImage($request->image);
        $pet->update([
            $request->image_key => $image1UploadStatus['image']
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Image uploaded succesfully',
            'data' => $this->dataFormat($pet)
        ]);
    }

    public function deleteMyPet($id)
    {
        $pet = UserPet::findOrFail($id);
        if ($pet) {
            $pet->delete();
            return response()->json([
                'status' => true,
                'message' => 'Pet Deleted Succefully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Pet delete failed'
            ]);
        }
    }

    public function uploadPetImage($image)
    {
        // your base64 encoded

        if (preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {
            $image = substr($image, strpos($image, ',') + 1);
            $type = strtolower($type[1]); // jpg, png, gif

            if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                return ['status' => false, 'message' => 401, 'error' => 'Invalid image type'];
            }
            $image = base64_decode($image);
            if ($image === false) {
                return ['status' => false, 'message' => 401, 'error' => 'base64_decode failed'];
            }
            $image_name = time() . str_random(16) . '.' . $type;

            $destinationPath = public_path('pet');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }


            $img = Image::make($image);
            $img->save($destinationPath . '/' . $image_name);

            //            File::put($destinationPath . '/' . $image_name, $image);
            return ['status' => true, 'image' => $image_name];
        }
        return ['status' => false, 'message' => 401, 'error' => 'did not match data URI with image data'];
    }

    protected function dataFormat($pet)
    {
        $pet['name'] = $pet->name;
        $pet['color'] = $pet->color;
        $pet['breed'] = $pet->breed;
        $pet['image1'] = isset($pet['image1']) ? url('pet/' . $pet['image1']) : '';
        $pet['image2'] = isset($pet['image2']) ? url('pet/' . $pet['image2']) : '';
        $pet['status'] = $pet->status;
        $pet['message'] = $pet['message'];
        return $pet;
    }

    function makeCurveQrImage($qr_code, $pet_code)
    {

        $im = imagecreate(300, 300);

        $white = imagecolorallocate($im, 0xFF, 0xFF, 0xFF);
        $grey = imagecolorallocate($im, 0xFF, 0xFF, 0xFF);
        $txtcol = imagecolorallocate($im, 0x00, 0x00, 0x00);

        $r = 120;
        $cx = 150;
        $cy = 150;
        $txt1 = '* P E T - I D . A P P / R F P / ' . implode(' ',str_split(strtoupper($pet_code))) . ' * P E T - I D . A P P / R F P / ' . implode(' ',str_split(strtoupper($pet_code)));
        $txt2 = '';
        $font1 = public_path('fonts/squada-one/SquadaOne-Regular.ttf');

        $size = 23;
        $s = 100;
        $e = 70;
        imagearc($im, $cx, $cy, $r * 2, $r * 2, $s, $e, $grey);
        $pad = 2;

        $this->textOnArc($im, $cx, $cy, $r, $s, $e, $txtcol, $txt1, $font1, $size, $pad);
        $pad = 6;
        $s = 10;
        $e = 55;
        $this->textInsideArc($im, $cx, $cy, $r, $s, $e, $txtcol, $txt2, $font1, $size, $pad);

        $img1 = Image::make($im);


        $qrCode = storage_path('app/public/qrcode/' . $qr_code . '.png');

        $insertQr = Image::make($qrCode);
        $img1->insert($insertQr, 'center');

        $fileName = uniqid('', true);
        $saveimg = storage_path('app/public/tag/image/' . $fileName . '.jpg');
        $img1->save($saveimg);

        return $fileName . '.jpg';
    }

    function makeCurveImageWithPetName($pet_code, $pet_name, $contct_no1, $contct_no2)
    {
        $im = imagecreate(300, 300);

        $white = imagecolorallocate($im, 0xFF, 0xFF, 0xFF);
        $grey = imagecolorallocate($im, 0xFF, 0xFF, 0xFF);
        $txtcol = imagecolorallocate($im, 0x00, 0x00, 0x00);

        $r = 120;
        $cx = 150;
        $cy = 150;
        $txt1 = '* P E T - I D . A P P / R F P / ' . implode(' ',str_split(strtoupper($pet_code))) . ' * P E T - I D . A P P / R F P / ' . implode(' ',str_split(strtoupper($pet_code)));
        $txt2 = '';
        $font1 = public_path('fonts/squada-one/SquadaOne-Regular.ttf');
        // $font2 = public_path('fonts/Raleway/Raleway-Bold.ttf');

        $size = 23;
        $s = 100;
        $e = 70;
        imagearc($im, $cx, $cy, $r * 2, $r * 2, $s, $e, $grey);
        $pad = 2;

        $this->textOnArc($im, $cx, $cy, $r, $s, $e, $txtcol, $txt1, $font1, $size, $pad);
        $pad = 6;
        $s = 10;
        $e = 55;
        $this->textInsideArc($im, $cx, $cy, $r, $s, $e, $txtcol, $txt2, $font1, $size, $pad);

        $img1 = Image::make($im);
        $fileName = uniqid('', true);
        $saveimg = storage_path('app/public/tag/image/demo' . $pet_code . '.jpg');
        $img1->save($saveimg);

        $img2 = Image::make(storage_path('app/public/tag/image/demo' . $pet_code . '.jpg'));

        $textColor = '#000000';

        $img2->text(strtoupper($pet_name), 150, 130, function ($font) use ($font1, $textColor) {
            $font->file(($font1));
            $font->size(38);
            $font->color($textColor);
            $font->align('center');
        });
        $img2->text($contct_no1, 150, 165, function ($font) use ($textColor, $font1) {
            $font->file($font1);
            $font->size(32);
            $font->color($textColor);
            $font->align('center');
        });
        $img2->text($contct_no2, 150, 200, function ($font) use ($textColor, $font1) {
            $font->file($font1);
            $font->size(32);
            $font->color($textColor);
            $font->align('center');
        });

        $fileName2 = uniqid('', true);
        $saveimg2 = storage_path('app/public/tag/image/' . $fileName2 . '.jpg');
        $img2->save($saveimg2);

        unlink(storage_path('app/public/tag/image/demo' . $pet_code . '.jpg'));

        return $fileName2 . '.jpg';
    }

    function textWidth($txt, $font, $size)
    {
        $bbox = imagettfbbox($size, 0, $font, $txt);
        $w = abs($bbox[4] - $bbox[0]);
        return $w;
    }

    function textOnArc($im, $cx, $cy, $r, $s, $e, $txtcol, $txt, $font, $size, $pad = 0)
    {
        $tlen = strlen($txt);
        $arccentre = ($e + $s) / 2;
        $total_width = $this->textWidth($txt, $font, $size) - ($tlen - 1) * $pad;
        $textangle = rad2deg($total_width / $r);
        $s = $arccentre - $textangle / 2;
        $e = $arccentre + $textangle / 2;
        for ($i = 0, $theta = deg2rad($s); $i < $tlen; $i++) {
            $ch = $txt{
                $i};
            $tx = $cx + $r * cos($theta);
            $ty = $cy + $r * sin($theta);
            $dtheta = ($this->textWidth($ch, $font, $size)) / $r;
            $angle = rad2deg(M_PI * 3 / 2 - ($dtheta / 2 + $theta));
            imagettftext($im, $size, $angle, $tx, $ty, $txtcol, $font, $ch);
            $theta += $dtheta;
        }
    }

    function textInsideArc($im, $cx, $cy, $r, $s, $e, $txtcol, $txt, $font, $size, $pad = 0)
    {
        $tlen = strlen($txt);
        $arccentre = ($e + $s) / 2;
        $total_width = $this->textWidth($txt, $font, $size) + ($tlen - 1) * $pad;
        $textangle = rad2deg($total_width / $r);
        $s = $arccentre - $textangle / 2;
        $e = $arccentre + $textangle / 2;
        for ($i = 0, $theta = deg2rad($e); $i < $tlen; $i++) {
            $ch = $txt{
                $i};
            $tx = $cx + $r * cos($theta);
            $ty = $cy + $r * sin($theta);
            $dtheta = ($this->textWidth($ch, $font, $size) + $pad) / $r;
            $angle = rad2deg(M_PI / 2 - ($theta - $dtheta / 2));
            imagettftext($im, $size, $angle, $tx, $ty, $txtcol, $font, $ch);
            $theta -= $dtheta;
        }
    }
}