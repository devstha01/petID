<?php

namespace App\Http\Controllers\Front;

use App\Cloudsa9\Entities\Models\User\Influencer;
use App\Cloudsa9\Repositories\User\UserRepository;
use App\Domain\Front\Requests\ContactRequest;
use App\Domain\Front\Services\User\ContactInfoService;
use App\Domain\Front\Services\User\UserService;
use App\Mail\Front\SendContact;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Cloudsa9\Entities\Models\User\UserPet;
use PDF;
use Image;
use Carbon\Carbon;

class PagesController extends Controller
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
     * Show home page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('front.modules.index');
    }

    /**
     * Show return found phone page
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function getReturnFoundPet(Request $request)
    {
        $phoneCode = $request->segment(2) ? $request->segment(2) : $request->input('phone_code');
        $contactInfo = [];

        if (!$phoneCode) {
            return view('front.modules.return-found-pet', ['phoneCode' => $phoneCode, 'contactInfo' => $contactInfo]);
        }

        try {
            $userInfo = $this->userService->findByPhoneCode($phoneCode);

            /*if ($userInfo && $userInfo->account_type == 'paid') {
                if (!$userInfo->subscribed('main') || $userInfo->subscription('main')->cancelled()) {
                    throw new Exception('No information found with phone code: ' . $phoneCode);
                }
            }*/

            $contactInfo = $this->contactInfoService->findByUser($userInfo->id);

            flash()->success('User found having phone code: ' . $phoneCode);

        } catch (Exception $e) {
            logger()->error($e);
            flash()->error('No information found with phone code: ' . $phoneCode);
        }

        return view('front.modules.return-found-pet', ['phoneCode' => $phoneCode, 'contactInfo' => $contactInfo]);
    }

    /**
     * Show how to set lock screen page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getHowToSetLockScreen()
    {
        return view('front.modules.how-to-set-lock-screen');
    }

    /**
     * Show faq page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getFAQ()
    {
        return view('front.modules.faq');
    }

    public function getCommunity()
    {
        return view('front.modules.community');
    }

    public function getAboutUs()
    {
        return view('front.modules.about-us');
    }

    public function getReturnsAndShipping()
    {
        return view('front.modules.returns-and-shipping');
    }

    public function getLostPetChecklist()
    {
        return view('front.modules.lost-pet-checklist');
    }

    public function getInfluencers()
    {
        return view('front.modules.influencers');
    }

    function postInfluencers(Request $request, UserRepository $userRepository)
    {
        $valid = $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
        ]);
        $input = $request->except('_token', 'first_name', 'last_name', 'email');
        $valid['password'] = bcrypt('secret' . rand(1000, 9999));
        $valid['phone'] = "0";
        $valid['phone_code'] = rand(100000, 999999);
        $user = $userRepository->create($valid);
        if (!$user)
            return redirect()->back()->with('success', 'Failed to submit information');
        $input['user_id'] = $user->id;
        $inf = Influencer::create($input);
        if (!$inf)
            return redirect()->back()->with('success', 'Failed to submit information');
        return redirect()->back()->with('success', 'Your information has been submitted');
    }

    /**
     * Show contact page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getContact()
    {
        return view('front.modules.contact');
    }

    /**
     * Send contact email
     *
     * @param ContactRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function postContact(ContactRequest $request)
    {
        try {
            Mail::to('support@fowndapp.com')->send(new SendContact($request->all()));

            flash()->success('Contact form successfully submitted.');

            return redirect()->back();
        } catch (Exception $e) {
            logger()->error($e);
            flash()->error('Unable to submit contact form.');
        }

        return redirect()->back()->withInput();
    }

    /**
     * Show terms of service page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getTOS()
    {
        return view('front.modules.tos');
    }

    /**
     * Show privacy policy page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPrivacyPolicy()
    {
        return view('front.modules.privacy-policy');
    }

    public function redirectToStore()
    {
        // Detect special conditions devices
        $iPod = stripos($_SERVER['HTTP_USER_AGENT'], "iPod");
        $iPhone = stripos($_SERVER['HTTP_USER_AGENT'], "iPhone");
        $iPad = stripos($_SERVER['HTTP_USER_AGENT'], "iPad");
        $Android = stripos($_SERVER['HTTP_USER_AGENT'], "Android");
        $webOS = stripos($_SERVER['HTTP_USER_AGENT'], "webOS");

        $playStore = 'https://play.google.com/store/apps/details?id=com.smartcodetechnology.fownd';
        $appStore = 'https://apps.apple.com/tt/app/fowndapp/id1459825685';

        // Do something with this information
        if ($iPhone || $iPad || $iPod) {
            return redirect($appStore);
        } else if ($Android) {
            return redirect($playStore);
        } else {
            return redirect($playStore);
        }
    }


   public function test_pdf()
    {

        $users = UserPet::where('created_at', '>=', Carbon::now()->subDay())->get();

        //return view('pdf.frontpdf', ['myusers' => $users]);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
        ->loadHTML(view('tag.backpdf', ['myusers' => $users])->render())->setPaper('a3', 'landscape');
        //download('invoice.pdf')
        return $pdf->stream('test.pdf');
    }
}
