<?php

namespace App\Http\Controllers\Api\V1\Pet;

use Illuminate\Http\Request;
use App\Cloudsa9\Entities\Models\User\UserPet;
use App\Cloudsa9\Entities\Models\User\DiscountCode;
use App\Cloudsa9\Entities\Models\User\ContactInfo;
use App\Cloudsa9\Entities\Models\User\Country;
use App\Cloudsa9\Entities\Models\User\OrderTag;
use App\Http\Controllers\Controller;
use \Carbon\Carbon;
use File;
use Image;

class TagController extends Controller
{
    public function user()
    {
        return currentUser();
    }

    public function getCountry(){
        $countries = Country::select('id','name','code')->get();
        return response()->json([
            'status'=>true,
            'message'=>'Country array with codes',
            'data'=>$countries
        ]);
    }

    public function calculateRate(Request $request)
    {
        $tagCost = 19.99;
        $shippingCharge = 3.04;
        $discount = 0;
        $this->validate($request,[
            'toCountry' => 'required',
            'toPostalCode' => 'required',
        ]);
        $toCountry = $request->toCountry;
        $toPostalCode = $request->toPostalCode;
        if($request->toCountry != 'US'){
            try{
                $ss = app(\LaravelShipStation\ShipStation::class);
                $weight = new \LaravelShipStation\Models\Weight();
                $weight->units = 'ounces';
                $weight->value = 2;
                $shipmentInfo = [
                    'carrierCode' => 'stamps_com',
                    'fromPostalCode' => 85087,
                    'toCountry' => $toCountry,
                    'toPostalCode' =>$toPostalCode,
                    'weight' => $weight
                ];
        
                $rates = $ss->shipments->post(
                    $shipmentInfo,
                    'getrates'
                );
              
                $shippingCharge = $rates[0]->shipmentCost;
            } catch(Exception $e){
                logger()->error($e);
                return response()->json([
                    'error' => true,
                    'message' => 'Unable to fetch shipping charge. Check message:' + $e,
                ]);
            } 
        }

       
        if($request->discount_code){
            $discount = DiscountCode::where('discount_code',$request->discount_code)->first();
            if(!$discount){
                return response()->json([
                    'error' => true,
                    'message' => 'Unable to fetch discount from code. Please try again',
                ]);
            }
            $total = $tagCost + $shippingCharge - $discount->discount;
            return response()->json([
                'status' => true,
                'tag_price'=> number_format((float)$tagCost,2,'.',''),
                'shipping_charge' => number_format((float)$shippingCharge,2,'.',''),
                'discount' => number_format((float)$discount->discount,2,'.',''),
                'tax' => 0,
                'total_charge'=> number_format((float)$total,2,'.','')
            ]);
        } else {
            $total = $tagCost + $shippingCharge;
            return response()->json([
                'status' => true,
                'tag_price'=> number_format((float)$tagCost,2,'.',''),
                'shipping_charge' => number_format((float)$shippingCharge,2,'.',''),
                'discount' => number_format((float)$discount,2,'.',''),
                'tax' => 0,
                'total_charge'=> number_format((float)$total,2,'.','')
            ]);
        }

      
    }

    public function orderTag(Request $request)
    {
        
        $this->validate($request,[
            'name'=>'required',
            'pet_id'=>'required',
            'total_price'=>'required',
            'tag_price'=>'required',
            'discount'=>'required',
            'shipping_charge'=>'required',
            'address1'=>'required',
            // 'address2'=>'required',
            'city'=>'required',
            'state'=>'required',
            'zip_code'=>'required',
            'country_code'=>'required',
        ]);
        $pet = UserPet::find($request->pet_id);
        $petCode = $pet->pet_code;
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

        $client = new \GuzzleHttp\Client;

        $headers = [
            "Authorization" => "Bearer key",
        ];

        $response = $client->request('POST','https://api.stripe.com/v1/charges', [
            'headers' => $headers,
            'form_params' => [
                'amount' => (number_format($request->total_price, 2, '.', '') * 100),
                'currency' => 'usd',
                'source' => $request->stripe_token,
                'description' => 'Payment complete for:'. $request->name . ' - PETid ' . $petCode ,
                'receipt_email' => $request->email
            ],
        ]);

        $shipStation = app(\LaravelShipStation\ShipStation::class);

        $address = new \LaravelShipStation\Models\Address();
    
        $address->name = ucwords($request->name);
        $address->street1 = ucwords($request->address1);
        $address->city = ucwords($request->city);
        $address->state = ucwords($request->state);
        $address->postalCode = $request->zip_code;
        $address->country = $request->country_code;
        $address->phone = currentUser()->contactInfo->phone1;
    
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
            'user_id' => currentUser()->id,
            'email' => $request->email,
            'pet_id' => $request->pet_id,
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
            'stripe_token'=>$request->stripe_token
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Order created successfully',
            'data'=>$order
        ]);
    }

    public function orderAtShipStation(Request $request)
    {
        $shipStation = app(\LaravelShipStation\ShipStation::class);
        $shipStation->orders->delete('53b20e');
        // This will var_dump the newly created order, and order should be wrapped in an array.
        // var_dump($shipStation->orders->post($order, 'createorder'));
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
