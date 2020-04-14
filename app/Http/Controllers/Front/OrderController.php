<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\Api\V1\Services\Subscriber\ContactInfoService;
use App\Domain\Api\V1\Services\User\UserService;
use App\Cloudsa9\Entities\Models\User\Country;
use App\Cloudsa9\Entities\Models\User\UserPet;
use App\Cloudsa9\Entities\Models\User\DiscountCode;
use App\Cloudsa9\Entities\Models\User\ContactInfo;
use App\Cloudsa9\Entities\Models\User\OrderTag;
use Stripe;
use LaravelShipStation;
use File;
use Image;
use \Carbon\Carbon;

class OrderController extends Controller
{
    private $unitPrice      = 19.99;
    private $orderItem      = 'PETID TAG';
    private $sku            = 'PETID-TAG';
	 /**
     * @var UserService
     */
    private $userService;
    /**
     * @var ContactInfoService
     */
    private $contactInfoService;

	public function __construct(UserService $userService, ContactInfoService $contactInfoService)
    {
        $this->userService = $userService;
        $this->contactInfoService = $contactInfoService;
    }
    public function checkout(){
        $countries = Country::pluck('name','code');
    	return view('front.checkout.index',compact('countries'));
    }

    public function order(Request $request){
         
        $this->validate( $request, [
            'name'          => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users',
            'password'      => 'required|string|min:6|confirmed',
            'address'       => 'required|min:3',
            'city'          => 'required|min:3',
            'state'         => 'required|min:2',
            'zip_code'      => 'required|min:3',
            'country'       => 'required|min:2',
            'phone'         => 'required|numeric|min:10',
            'reward'        => 'required',
        
        ]);

        $petsInput      =  [];
        parse_str($request->pets, $petsInput);
        $totalPets      = count($petsInput);

        try{
            $shippingCharge       = $this->_calculateCharge($request->country,$request->zip_code);
            $totalAmount          = $totalPets * $this->unitPrice + $shippingCharge;
        }catch (\Exception $e) {
            dd($e->getMessage()); 
        }
       

    	// Create new user 
        $request['name']    = ucwords($request->name);
        $user               = $this->userService->create(array_merge($request->all(), ['account_type' => 'paid']));

        // Create contact info
        $contactInfo = $this->contactInfoService->create([
            'user_id'       => $user->id,
            'name'          => ucwords($user->name),
            'email'         => $user->email,
            'address1'      => ucwords($request->address),
            'address2'      => ucwords($request->address_2),
            'city'          => ucwords($request->city),
            'state'         => ucwords($request->state),
            'zip'           => $request->zip_code,
            'country'       => ucwords($request->country),
            'phone1'        => $request->phone,
            'phone2'        => $request->s_phone,
            'reward'        => ($request->reward == 'yes' ? 1 : 0),
            'message'       => '',
        ]);

      
        
        $petsArr        = [];
        $orderNotes     = '';
        $i = 1;
        foreach ($petsInput as $key => $input) {
    
        	$pet = UserPet::create([
	            'user_id'      => $user->id,
	            'name'         => ucwords($input[$i]['name']),
	            'pet_code'     => $this->unique_pet_code(),
	            'qr_code'      => str_shuffle(substr(uniqid(), 0, 10)),
	            'gender'       => $input[$i]['gender'],
	            'color'        => ucwords($input[$i]['color']),
	            'breed'        => ucwords($input[$i]['breed']),
	            'image1'       => @$input[$i]['image1'],
	            'image2'       => @$input[$i]['image2'],
	            'status_verified_at' => Carbon::now()->toDateTimeString()
	        ]);
            $petsArr[]          = $pet;
            $orderNotes         .= $pet->pet_code . ' user: '.$pet->name. " - ";
            $this->_orderTag($contactInfo,$pet);
            $i++;
        }

        try {
            $stripe_token   = $request->get('stripe_token');

            $stripe = Stripe::charges()->create([
                'source'    => $stripe_token,
                'currency'  => 'USD',
                'amount'    => $totalAmount
            ]);

            $shipStation    = app(LaravelShipStation\ShipStation::class);

            $address        = new LaravelShipStation\Models\Address();

            $address->name          = ucwords($request->get('name'));
            $address->street1       = ucwords($request->get('address'));
            $address->city          = ucwords($request->get('city'));
            $address->state         = ucwords($request->get('state'));
            $address->postalCode    = $request->get('zip_code');
            $address->country       = $request->country;
            $address->phone         = $request->phone;

            $item = new LaravelShipStation\Models\OrderItem();

            $item->lineItemKey          = '1';
            $item->sku                  = $this->sku;
            $item->name                 = $this->orderItem;
            $item->quantity             = $totalPets;
            $item->unitPrice            = $this->unitPrice;
            $item->warehouseLocation    = 'Warehouse A';

            $order = new LaravelShipStation\Models\Order();

            $order->orderNumber         = '1';
            $order->orderDate           = Carbon::now()->format('Y-m-d');
            $order->orderStatus         = 'awaiting_shipment';
            $order->amountPaid          = $totalAmount;
            $order->taxAmount           = '0.00';
            $order->shippingAmount      = $shippingCharge;
            $order->internalNotes       = 'Order created for PETid: '. $orderNotes;
            $order->billTo              = $address;
            $order->shipTo              = $address;
            $order->items[]             = $item;
            
            $shipStation->orders->create($order);

            foreach ($petsArr as $key=>$pet) { 

                $order =  OrderTag::create([
                    'user_id'           => $user->id,
                    'email'             => $user->email,
                    'pet_id'            => $pet->id,
                    'total_price'       => $totalAmount,
                    'tag_price'         => $this->unitPrice,
                    'discount'          => 0,
                    'shipping_charge'   => $shippingCharge,
                    'discount_code'     => '',
                    'address1'          => ucwords($contactInfo->address1),
                    'address2'          => ucwords($contactInfo->address2),
                    'city'              => ucwords($contactInfo->city),
                    'state'             => ucwords($contactInfo->state),
                    'zip_code'          => $contactInfo->zip_code,
                    'country_code'      => $contactInfo->country,
                    'stripe_token'      => $stripe_token
                ]);
            }

            return ['status'=>'success'];
            
        } catch(\Stripe\Error\Card $e) {
           dd($e->getMessage()); 
        } catch (\Exception $e) {
          dd($e->getMessage()); 
        }

    }

    private function _orderTag($contacInfo,$pet){
     
        $petCode        = $pet->pet_code;
        $contacInfo     = ContactInfo::where('user_id', $pet->user_id)->first();
        $qrCode = storage_path('app/public/qrcode/' . $pet->qr_code . '.jpg');

        generateQRCode('www.pet-id.app/rfp/' . $pet->pet_code, $qrCode);
        
        $backTag = $this->makeCurveQrImage($pet->qr_code, $pet->pet_code);  
        $pet->update([
            'back_tag'=> $backTag,
        ]);

        $frontTag = $this->makeCurveImageWithPetName($pet->pet_code, $pet->name, $contacInfo->phone1, $contacInfo->phone2);
        $pet->update([
            'front_tag'=> $frontTag
        ]);
        
    }

   

    public function calculateCharge(Request $request){
        try{
            $shippingCharge = $this->_calculateCharge($request->country,$request->zip_code);
            $totalCharge          = $request->totalPets* $this->unitPrice + $shippingCharge;
            return ['status'=>'success','data'=>$totalCharge];
        } catch(\Exception $e){
            return ['status'=>'failure','message'=>'Shipping not available for the selected address'];
        }
    }

    private function _calculateCharge($country,$zip_code){
	 	try{
            $ss = app(\LaravelShipStation\ShipStation::class);
            $weight = new \LaravelShipStation\Models\Weight();
            $weight->units = 'ounces';
            $weight->value = 2;
            $shipmentInfo = [
                'carrierCode'       => 'stamps_com',
                'fromPostalCode'    => 85087,
                'toCountry'         => $country,
                'toPostalCode'      =>$zip_code,
                'weight'            => $weight
            ];
    
            $rates = $ss->shipments->post(
                $shipmentInfo,
                'getrates'
            );
          
            $shippingCharge = $rates[0]->shipmentCost;
            return $shippingCharge;
        } catch(\Exception $e){
            logger()->error($e);
            return response()->json([
                'error' => true,
                'message' => 'Unable to fetch shipping charge. Check message:' + $e,
            ]);
        }
    }

    private function unique_pet_code()
    {
        $seed = str_split('0123456789');
        $seedalpha = str_split('abcdefghijlnoprstuvy');
                     
        shuffle($seed);
        shuffle($seedalpha);
        
        $rand = '';
        foreach (array_rand($seed, 6) as $key => $k){
            if($key === 0)
            {
                $rand .= $seedalpha[$key];
            }
            else
            {
                $rand .= $seed[$k];
            }
            
            
        };
        
        return $rand;
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
            $ch = $txt[$i];
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
            $ch = $txt[$i];
            $tx = $cx + $r * cos($theta);
            $ty = $cy + $r * sin($theta);
            $dtheta = ($this->textWidth($ch, $font, $size) + $pad) / $r;
            $angle = rad2deg(M_PI / 2 - ($theta - $dtheta / 2));
            imagettftext($im, $size, $angle, $tx, $ty, $txtcol, $font, $ch);
            $theta -= $dtheta;
        }
    }
}
