<?php

namespace App\Http\Controllers\Api\V1\Front;

use App\Domain\Api\V1\Services\Front\ContactInfoService;
use App\Domain\Api\V1\Services\Front\UserService;
use Exception;
use Illuminate\Http\Request;
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
    public function getReturnFoundPhone(Request $request)
    {
        $phoneCode = $request->segment(3) ? $request->segment(3) : $request->input('phone_code');

        $contactInfo = [];

        if (!$phoneCode) {
            return [
                'phoneCode' => $phoneCode,
                'contactInfo' => $contactInfo
            ];
        }

        try {
            $userInfo = $this->userService->findByPhoneCode($phoneCode);

//            if ($userInfo && $userInfo->account_type == 'paid') {
//                if (!$userInfo->subscribed('main') || $userInfo->subscription('main')->cancelled()) {
//                    throw new Exception('No information found with phone code: ' . $phoneCode);
//                }
//            }

            $contactInfo = $this->contactInfoService->findByUser($userInfo->id);

            $response = [
                'error' => false,
                'message' => 'User found having phone code: ' . $phoneCode,
                'recovery-info' => $contactInfo,
            ];

        } catch (Exception $e) {
            logger()->error($e);

            $response = [
                'error' => true,
                'message' => 'No information found with phone code: ' . $phoneCode,
                'recovery-info' => $contactInfo,
            ];
        }

        return $response;
    }
}
