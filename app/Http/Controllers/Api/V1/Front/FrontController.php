<?php

namespace App\Http\Controllers\Api\V1\Front;

use App\Domain\Api\V1\Services\Front\ContactInfoService;
use App\Domain\Api\V1\Services\Front\UserService;
use Exception;
use Illuminate\Http\Request;
use App\Cloudsa9\Entities\Models\User\User;
use App\Cloudsa9\Entities\Models\User\UserPet;
use App\Cloudsa9\Entities\Models\User\ContactInfo;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    private $contactInfoService;
    /**
     * @var UserService
     */
    private $userService;

    /**
     * PagesController constructor.
     * @param UserService $userService
     * @param ContactInfoService $contactInfoService
     */
    public function __construct(UserService $userService, ContactInfoService $contactInfoService)
    {
        $this->userService = $userService;
        $this->contactInfoService = $contactInfoService;
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|string|null
     */
    public function getReturnFoundPet($petCode)
    {
        $contactInfo = [];

        if (!$petCode) {
            return [
                'status'=>false,
                'message'=>'Unable to find contact information',
                'petcode' => $petCode,
            ];
        }

        try {
            $pet = UserPet::where('pet_code',$petCode)->first();

            $petInfo = $this->petInfo($pet);
            
            $contactInfo = ContactInfo::where('user_id',$petInfo->user_id)->first();

            $response = [
                'error' => true,
                'message' => 'User found having pet code: ' . $petCode,
                'contact-info' => $contactInfo,
                'pet-info' => $petInfo
            ];

        } catch (Exception $e) {
            logger()->error($e);

            $response = [
                'error' => true,
                'message' => 'No information found with pet code: ' . $petCode
            ];
        }

        return $response;
    }

    public function petInfo($pet){
        if($pet['status'] === 1){
            $status = 'Protected';
        }else{
            $status = 'Lost';
        }

        $pet['name'] = $pet->name;
        $pet['color'] = $pet->color;
        $pet['breed'] = $pet->breed;
        $pet['rabies_tag_id'] = $pet->rabies_tag_id;
        $pet['rabies_exp'] = $pet->rabies_tag_id;
        $pet['microship_id'] = $pet->microship_id;
        $pet['county_reg'] = $pet->county_reg;
        $pet['image1'] = isset($pet['image1']) ? url('pet/' . $pet['image1']) : '';
        $pet['image2'] = isset($pet['image2']) ? url('pet/' . $pet['image2']) : '';
        $pet['status'] = $status;
        $pet['message'] = $pet['message'];
        return $pet;
    }
}
