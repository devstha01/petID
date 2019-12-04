<?php

namespace App\Http\Controllers\Api\V1\Pet;

use Illuminate\Http\Request;
use App\Cloudsa9\Entities\Models\User\UserPet;
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
    public function getPets()
    {
       $pets = $this->user()->pets()->get();
       return $pets;
    }

    public function postPet(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'gender'=>'required',
            'color'=>'required',
            'breed'=>'required',
            'image1'=>'required',
            'image2'=>'required',
            'status'=>'required'
        ]);

        $image1UploadStatus1 = $this->uploadPetImage($request->image1);
        $image1UploadStatus2 = $this->uploadPetImage($request->image2);

        if ($image1UploadStatus1['status'] === false) return $image1UploadStatus1;
        if ($image1UploadStatus2['status'] === false) return $image1UploadStatus2;

        $pet = UserPet::create([
            'user_id' => currentUser()->id,
            'name' => $request->name,
            'gender' => $request->gender,
            'color' => $request->color,
            'breed' => $request->breed,
            'image1' => $image1UploadStatus1['image'],
            'image2' => $image1UploadStatus2['image'],
            'status' => $request->status,
            'status_verified_at' => Carbon::now(),
            'message' => $request->message,
        ]);

        if($pet){
            return response()->json([
                'status'=>true,
                'message'=>'Pet Created Successfully',
                'data'=>$this->dataFormat($pet)
            ]);
        }

        return response()->json([
            'status'=>false,
            'message'=>'failed to save pets. Something went wrong'
        ]);
      

       
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
        if($pet['status'] === 1){
            $status = 'Protected';
        }else{
            $status = 'Lost';
        }

        $pet['name'] = $pet->name;
        $pet['color'] = $pet->color;
        $pet['breed'] = $pet->breed;
        $pet['image1'] = isset($pet['image1']) ? url('pet/' . $pet['image1']) : '';
        $pet['image2'] = isset($pet['image2']) ? url('pet/' . $pet['image2']) : '';
        $pet['status'] = $status;
        $pet['message'] = $pet['message'];
        return $pet;
    }

}
