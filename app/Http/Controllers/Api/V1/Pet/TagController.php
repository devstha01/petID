<?php

namespace App\Http\Controllers\Api\V1\Pet;

use Illuminate\Http\Request;
use App\Cloudsa9\Entities\Models\User\UserPet;
use App\Cloudsa9\Entities\Models\User\Country;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function getCountry(){
        $countries = Country::select('id','name','code')->get();
        return response()->json([
            'status'=>true,
            'message'=>'Country array with codes',
            'data'=>$countries
        ]);
    }
}
