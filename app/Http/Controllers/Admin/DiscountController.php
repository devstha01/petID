<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Cloudsa9\Entities\Models\User\DiscountCode;
use App\Cloudsa9\Entities\Models\User\OrderTag;
use App\Http\Controllers\Controller;

class DiscountController extends Controller
{
    public function index()
    {
        $codes = DiscountCode::all();
        return view('admin.modules.discount.index', compact('codes'));
    }

    public function create(Request $request){
        $this->validate($request,[
            'discount_code'=>'required|min:6|max:10|unique:discount_codes',
            'discount'=>'required|numeric'
        ]);
        DiscountCode::create([
            'discount_code'=>$request->discount_code,
            'discount'=>$request->discount
        ]);
        return redirect()->back()->with('success', 'Information updated successfully');
    }

    public function codeUsedBy($code)
    {
        $orders = OrderTag::where('discount',$code)->get();
        $usedCount = OrderTag::where('discount',$code)->count();
        return view('admin.modules.discount.used', compact('orders','code','usedCount'));
    }
}
