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
use App\Cloudsa9\Entities\Models\User\User;
use App\Cloudsa9\Entities\Models\User\UserPet;
use App\Cloudsa9\Entities\Models\User\DiscountCode;
use App\Cloudsa9\Entities\Models\User\OrderTag;
use App\Cloudsa9\Entities\Models\User\ContactInfo;
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
        $petCode = $request->segment(2) ? $request->segment(2) : $request->input('pet_code');
        $contactInfo = [];

        if (!$petCode) {
            return view('front.modules.return-found-pet', ['petCode' => $petCode, 'contactInfo' => $contactInfo]);
        }

        try {
            $pet = UserPet::where('pet_code',$petCode)->first();

            $petInfo = $this->petInfo($pet);
            
            $contactInfo = ContactInfo::where('user_id',$petInfo->user_id)->first();

            /*if ($userInfo && $userInfo->account_type == 'paid') {
                if (!$userInfo->subscribed('main') || $userInfo->subscription('main')->cancelled()) {
                    throw new Exception('No information found with phone code: ' . $phoneCode);
                }
            }*/

            flash()->success('User found having pet code: ' . $petCode);

        } catch (Exception $e) {
            logger()->error($e);
            flash()->error('No information found with pet code: ' . $petCode);
        }

        return view('front.modules.return-found-pet', ['petCode' => $petCode, 'contactInfo' => $contactInfo]);
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
        $valid['name'] = $request->first_name.' '.$request->last_name;
        $valid['password'] = bcrypt('secret' . rand(1000, 9999));
        $user = $userRepository->create($valid);
        if (!$user)
            return redirect()->back()->with('success', 'Failed to submit information');
        $input['user_id'] = $user->id;
        $user->roles()->sync([2]);
         // Create contact info
        $contactInfo = ContactInfo::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone1' => '',
            'phone2' => '',
            'reward' => 0,
            'message' => '',
        ]);
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

        $playStore = 'https://play.google.com/store/apps/details?id=com.smartcode.pet_id';
        $appStore = 'https://apps.apple.com/us/app/petid-pet-identification/id1480578425?ls=1';

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
        return view('tag.downloadpdf');
    }

    public function front_pdf()
    {
        
        $users = UserPet::whereDate('created_at', Carbon::parse(request()->get('date')))->get();
        
        $customPaper = array(0,0,1440,910);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
        ->loadHTML(view('tag.frontpdf', ['myusers' => $users])->render())->setPaper($customPaper, 'portrait');
        //download('invoice.pdf')
        return $pdf->download('Front.pdf');


        // $pdf = PDF::loadView('tag.demo-tag'); //load view page
        // return $pdf->stream('test.pdf'); // download pdf file
    }
    
    public function back_pdf()
    {

        $users = UserPet::whereDate('created_at', Carbon::parse(request()->get('date')))->get();
        
        $customPaper = array(0,0,1440,910);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
        ->loadHTML(view('tag.backpdf', ['myusers' => $users])->render())->setPaper($customPaper, 'portrait');
        //download('invoice.pdf')
        return $pdf->download('Back.pdf');


        // $pdf = PDF::loadView('tag.demo-tag'); //load view page
        // return $pdf->stream('test.pdf'); // download pdf file
    }

    public function getRate(){
        $ss = app(\LaravelShipStation\ShipStation::class);
        $weight = new \LaravelShipStation\Models\Weight();
        $weight->units = 'ounces';
        $weight->value = 2;
        $shipmentInfo = [
            'carrierCode' => 'stamps_com',
            'fromPostalCode' => 85087,
            'toCountry' => 'NP',
            'toPostalCode' => '44600',
            'weight' => $weight
        ];

        $rates = $ss->shipments->post(
            $shipmentInfo,
            'getrates'
        );
      
        $shippingCharge = $rates[0]->shipmentCost;

        return $shippingCharge;
    }


    public function imageTest(){
        $im = imagecreate(1920, 1152);
        $img1 = Image::make($im);
        $j = 29;
        $leftPadding = 40;
        for($i = 1; $i < $j; $i++){
            if($i > 0 && $i < 15){
                $topPadding = 25;
                $backImage = url('images/code1.jpg');
                $insertQr = Image::make($backImage)->resize(120, 120);
                $img1->insert($insertQr, 'top-left', $leftPadding, $topPadding);
                $leftPadding = $leftPadding + 125;
                if($i == 14){
                    $leftPadding = 40;
                }
            } else if($i > 14 && $i < 29){
                $topPadding = 175;
                $backImage = url('images/code1.jpg');
                $insertQr = Image::make($backImage)->resize(120, 120);
                $img1->insert($insertQr, 'top-left', $leftPadding, $topPadding);
                $leftPadding = $leftPadding + 125;
            }
        }
        $fileName = uniqid('', true);
        $saveimg = storage_path('app/public/tag/image/' . $fileName . '.jpg');
        $img1->save($saveimg);
        $customPaper = array(0,0,1440,864);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
        ->loadHTML("<img src='" . $saveimg . "'>")->setPaper($customPaper, 'portrait');
        return $pdf->stream('test.pdf');
        // $customPaper = array(0,0,1440,864);
        // $savepdf = storage_path('app/public/wallpaper/' . $fileName . '.pdf');
        // PDF::loadHTML("<img src='" . $saveimg . "'>")->stream($savepdf);
        // echo 'done';
    }

    public function getTax()
    {

        $client = new \GuzzleHttp\Client;

        $headers = [
            "Authorization" => "Bearer fc977b602fbdb797b424e5e059e0f85e",
            "Accept" => "application/json"
        ];

        $response = $client->request('POST','https://api.taxjar.com/v2/taxes', [
            'headers' => $headers,
            'form_params' => [
                'from_country' => 'US',
                'from_zip' => '85087',
                "from_state" => "AZ",
                "from_city" => "New River",
                "from_street" => "826 w Jenny Lin rd.",
                "to_country" => "US",
                "to_zip" => "90002",
                "to_state" => "CA",
                "to_city" => "Los Angeles",
                "to_street" => "1335 E 103rd St",
                "amount" => 15.00,
                "shipping" => 1.50,
                "nexus_addresses[][country]" => 'US',
                "nexus_addresses[][zip]" => '85087',
                "nexus_addresses[][state]" => 'AZ',
                "nexus_addresses[][city]" => 'New River',
                "nexus_addresses[][street]" => '826 w Jenny Lin rd.',
                "line_items[][quantity]" => 1,
                "line_items[][product_tax_code]" => "20010",
                "line_items[][unit_price]" => 15.00,
                "line_items[][discount]" => 0
            ],
        ]);
        
        // $statusCode = $response->getStatusCode();
        return $response->getBody();
    }

    public function deleteOrderFromStation(){
        $shipStation = app(\LaravelShipStation\ShipStation::class);
        $shipStation->orders->delete('53b20e');
        echo 'done';
    }

    public function salesView($code)
    {
        if(DiscountCode::where('discount_code',$code)->count() > 0){
            $orders = OrderTag::where('discount',$code)->get();
            $usedCount = OrderTag::where('discount',$code)->count();
            return view('front.modules.sales-by-code', compact('orders','code','usedCount'));
        }
        return 404;
       
    }
}
