<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Cloudsa9\Entities\Models\User\DiscountCode;
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
            'discount_code'=>'required|min:6|max:10|unique:discount_codes'
        ]);
        DiscountCode::create([
            'discount_code'=>$request->discount_code
        ]);
        return redirect()->back()->with('success', 'Information updated successfully');
    }
}
