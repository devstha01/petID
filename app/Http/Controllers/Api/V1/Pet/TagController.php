<?php

namespace App\Http\Controllers\Api\V1\Pet;

use Illuminate\Http\Request;
use App\Cloudsa9\Entities\Models\User\UserPet;
use App\Cloudsa9\Entities\Models\User\DiscountCode;
use App\Cloudsa9\Entities\Models\User\Country;
use App\Cloudsa9\Entities\Models\User\OrderTag;
use App\Http\Controllers\Controller;

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
                $weight->value = 35.274;
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
            $discount = DiscountCode::where('discount_code',$request->discount_code)->first()->discount;
            if(!$discount){
                return response()->json([
                    'error' => true,
                    'message' => 'Unable to fetch discount from code. Please try again',
                ]);
            }
        }

        $total = $tagCost + $shippingCharge - $discount;
        return response()->json([
            'status' => true,
            'tag_price'=> number_format((float)$tagCost,2,'.',''),
            'shipping_charge' => number_format((float)$shippingCharge,2,'.',''),
            'discount' => number_format((float)$discount,2,'.',''),
            'tax' => 0,
            'total_charge'=> number_format((float)$total,2,'.','')
        ]);
    }

    public function orderTag(Request $request)
    {
        
        $this->validate($request,[
            'pet_id'=>'required',
            'total_price'=>'required',
            'discount_code'=>'required',
            'address1'=>'required',
            // 'address2'=>'required',
            'city'=>'required',
            'state'=>'required',
            'zip_code'=>'required',
            'country_id'=>'required',
        ]);

        $order =  OrderTag::create([
            'user_id' => currentUser()->id,
            'pet_id' => $request->pet_id,
            'total_price' => $request->total_price,
            'discount_code' => $request->discount_code,
            'address1'=>$request->address1,
            'address2'=>$request->address2,
            'city'=>$request->city,
            'state'=>$request->state,
            'zip_code'=>$request->zip_code,
            'country_id'=>$request->country_id
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Order created successfully',
            'data'=>$order
        ]);
    }
}
