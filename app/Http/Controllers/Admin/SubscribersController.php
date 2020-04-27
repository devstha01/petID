<?php

namespace App\Http\Controllers\Admin;

use App\Cloudsa9\Constants\AccountType;
use App\Cloudsa9\Constants\DeviceType;
use App\Cloudsa9\Constants\StatusType;
use App\Cloudsa9\Entities\Models\User\User;
use App\Cloudsa9\Entities\Models\User\Country;
use App\Cloudsa9\Entities\Models\User\ContactInfo;
use App\Cloudsa9\Entities\Models\User\OrderTag;
use App\Cloudsa9\Entities\Models\User\UserPet;
use App\Domain\Admin\Requests\Subscriber\SubscriberCreateRequest;
use App\Domain\Admin\Requests\Subscriber\SubscriberRequest;
use App\Domain\Admin\Requests\Subscriber\SubscriberUpdateRequest;
use App\Domain\Admin\Services\Subscriber\AccountService;
use App\Domain\Admin\Services\Subscriber\ContactInfoService;
use App\Http\Controllers\Controller;
use Exception;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use \Carbon\Carbon;
use File;
use Image;
use DB;


class SubscribersController extends Controller
{
    /**
     * @var AccountService
     */
    private $accountService;
    /**
     * @var ContactInfoService
     */
    private $contactInfoService;

    /**
     * SubscribersController constructor.
     * @param AccountService $accountService
     * @param ContactInfoService $contactInfoService
     */
    public function __construct(AccountService $accountService, ContactInfoService $contactInfoService)
    {
        $this->accountService = $accountService;
        $this->contactInfoService = $contactInfoService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscribers = $this->accountService->all();

        return view('admin.modules.subscriber.index', ['subscribers' => $subscribers]);
    }

    public function usersWithNoTag(){
        $subscribers = \DB::table('users')
        ->select(
            'users.id',
            'name',
            'email',
            'created_at'
        )
        ->whereNotExists( function ($query) {
            $query->select(DB::raw(1))
            ->from('order_tags')
            ->whereRaw('users.id = order_tags.user_id');
        })->paginate(20);
   
        return view('admin.modules.subscriber.notag', ['subscribers' => $subscribers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accountInfo = [];
        $contactInfo = [];
        $accountType = AccountType::all();
        $status = StatusType::all();
        $device = DeviceType::all();

        return view('admin.modules.subscriber.create', [
            'accountInfo' => $accountInfo,
            'contactInfo' => $contactInfo,
            'accountType' => $accountType,
            'status' => $status,
            'device' => $device
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SubscriberCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SubscriberCreateRequest $request)
    {
        try {
            $subscriber = $this->accountService->create($request->all());
            $this->contactInfoService->updateOrCreate(array_merge($request->all(), ['user_id' => $subscriber->id]));

            flash()->success('Subscriber successfully created.');
        } catch (Exception $e) {
            logger()->error($e);
            flash()->error('Unable to create subscriber.');
            return redirect()->back()->withInput();
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $accountInfo = $this->accountService->find($id);

        $contactInfo = $this->contactInfoService->findBySubscriber($accountInfo->id);
        $accountType = AccountType::all();
        $status = StatusType::all();

        return view('admin.modules.subscriber.edit', [
            'accountInfo' => $accountInfo,
            'contactInfo' => $contactInfo,
            'status' => $status,
            'accountType' => $accountType
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SubscriberUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SubscriberUpdateRequest $request, $id)
    {
        try {
            $this->accountService->update($request->all(), $id);
            $this->contactInfoService->updateOrCreate(array_merge($request->all(), ['id' => 'contact_info_id', 'user_id' => $id]));

            flash()->success('Subscriber successfully updated.');
        } catch (Exception $e) {
            logger()->error($e);
            flash()->error('Unable to update subscriber.');
        }

        return redirect()->back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->accountService->delete($id);
//            $this->contactInfoService->delete($id);
            flash()->success('Subscriber successfully deleted.');
        } catch (Exception $e) {
            logger()->error($e);
            flash()->error('Unable to delete subscriber.');
        }

        return redirect()->back();
    }

    public function editPass($id)
    {
        $inf = $this->accountService->find($id);
        return view('admin.modules.subscriber.editpass', compact('inf'));
    }

    function updatePass($id, Request $request)
    {
        $inf = $this->accountService->find($id);
        $this->validate($request, [
            'password' => 'required|string|min:6|same:confirm_password',
            'confirm_password' => 'required|string|min:6',
        ]);
        $inf->update(['password'=>bcrypt($request->password)]);
        return redirect()->back()->with('success', 'Password updated successfully');
    }

    public function getPets($id)
    {
        $pets = UserPet::where('user_id',$id)->get();
        return view('admin.modules.subscriber.pets',compact('pets','id'));
    }

    public function getPetTag($id){
        $pet = UserPet::find($id);
        $countries = Country::select('name','code')->get();
        return view('admin.modules.subscriber.order-tag',compact('pet','countries'));
    }

    public function orderPetTag(Request $request,$id){
        $this->validate($request,[
            'name'=>'required',
            'total_price'=>'required|numeric',
            'tag_price'=>'required|numeric',
            'discount'=>'required|numeric',
            'shipping_charge'=>'required|numeric',
            'address1'=>'required',
            // 'address2'=>'required',
            'city'=>'required',
            'state'=>'required',
            'zip_code'=>'required',
            'country_code'=>'required',
        ]);
        
        $pet = UserPet::find($id);
        $petCode = $pet->pet_code;
        $userOwner = UserPet::find($id)->user;
        $contacInfo = ContactInfo::where('user_id', $pet->user_id)->first();
        
        $qrCode = storage_path('app/public/qrcode/' . $pet->qr_code . '.jpg');
        // generateQRCode('petid.app/rfp/' . $user->pet_code, $qrCode, $lockscreenInfo->lockscreen_color);
        generateQRCode('www.pet-id.app/rfp/' . $pet->pet_code, $qrCode);
        
        $backTag = $this->makeCurveQrImage($pet->qr_code, $pet->pet_code);  
        $pet->update([
            'back_tag'=> $backTag,
        ]);

        $frontTag = $this->makeCurveImageWithPetName($pet->pet_code, $pet->name, $contacInfo->phone1, $contacInfo->phone2);
        $pet->update([
            'front_tag'=> $frontTag
        ]);

        $shipStation = app(\LaravelShipStation\ShipStation::class);

        $address = new \LaravelShipStation\Models\Address();
    
        $address->name = ucwords($request->name);
        $address->street1 = ucwords($request->address1);
        $address->city = ucwords($request->city);
        $address->state = ucwords($request->state);
        $address->postalCode = $request->zip_code;
        $address->country = $request->country_code;
        $address->phone = $request->phone1;
    
        $item = new \LaravelShipStation\Models\OrderItem();
    
        $item->sku = 'PETID-TAG';
        $item->name = "PETID TAG";
        $item->quantity = '1';
        $item->unitPrice  = $request->tag_price;
    
        $order = new \LaravelShipStation\Models\Order();

        $order->orderNumber = $petCode;
        $order->orderDate = Carbon::now()->format('Y-m-d');
        $order->orderStatus = 'awaiting_shipment';
        $order->amountPaid = $request->total_price;
        $order->taxAmount = 0;
        $order->shippingAmount = $request->shipping_charge;
        $order->internalNotes = 'Order created for PETid: '. $petCode . ' user: '.$request->name;
        $order->billTo = $address;
        $order->shipTo = $address;
        $order->items[] = $item;

        $data = $shipStation->orders->post($order, 'createorder');

        $order =  OrderTag::create([
            'user_id' => $userOwner->id,
            'email' => $request->email,
            'pet_id' => $id,
            'total_price' => $request->total_price,
            'tag_price'=> $request->tag_price,
            'discount'=>$request->discount,
            'shipping_charge'=>$request->shipping_charge,
            'discount_code' => $request->discount_code,
            'address1'=>ucwords($request->address1),
            'address2'=>ucwords($request->address2),
            'city'=>ucwords($request->city),
            'state'=>ucwords($request->state),
            'zip_code'=>$request->zip_code,
            'country_code'=>$request->country_code,
        ]);
        flash()->success('Order Tag Created');
        return redirect('admin/subscriber-pets/'.$userOwner->id);
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
         $txt1 = ' * P E T - I D . A P P / R F P / '.implode(' ',str_split(strtoupper($pet_code))) . ' * P E T - I D . A P P / R F P / ' . implode(' ',str_split(strtoupper($pet_code)));
        //$txt1 = '* PET-ID.APP/RFP/'.implode('',str_split(strtoupper($pet_code))) . ' * PET-ID.APP/RFP/' . implode('',str_split(strtoupper($pet_code)));
        $txt2 = '';
        // $font1 = public_path('fonts/squada-one/SquadaOne-Regular.ttf');
        $font1 = public_path('fonts/dejavu-sans/DejaVuSans-Bold.ttf');


        $size = 14;
        $s = 200;
        $e = 120;
        imagearc($im, $cx, $cy, $r * 2, $r * 2, $s, $e, $grey);
        $pad = 2;

        $this->textOnArc($im, $cx, $cy, $r, $s, $e, $txtcol, $txt1, $font1, $size, $pad);
        $pad = 6;
        $s = 10;
        $e = 55;
        $this->textInsideArc($im, $cx, $cy, $r, $s, $e, $txtcol, $txt2, $font1, $size, $pad);

        $img1 = Image::make($im);


        $qrCode = storage_path('app/public/qrcode/' . $qr_code . '.jpg');

        $insertQr = Image::make($qrCode)->resize(150, 150);
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
        $txt1 = ' * P E T - I D . A P P / R F P / '.implode(' ',str_split(strtoupper($pet_code))) . ' * P E T - I D . A P P / R F P / ' . implode(' ',str_split(strtoupper($pet_code)));
        
        $txt2 = '';
      
        $font1 = public_path('fonts/dejavu-sans/DejaVuSans-Bold.ttf');

        $size = 14;
        $s = 200;
        $e = 120;
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
            $font->size(30);
            $font->color($textColor);
            $font->align('center');
        });
        $img2->text($contct_no1, 150, 160, function ($font) use ($textColor, $font1) {
            $font->file($font1);
            $font->size(24);
            $font->color($textColor);
            $font->align('center');
        });
        $img2->text($contct_no2, 150, 190, function ($font) use ($textColor, $font1) {
            $font->file($font1);
            $font->size(24);
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
