<?php

namespace App\Http\Controllers\Admin;

use App\Cloudsa9\Entities\Models\User\OrderTag;
use App\Cloudsa9\Entities\Models\User\UserPet;
use App\Cloudsa9\Entities\Models\User\User;
use App\Cloudsa9\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderTagController extends Controller
{
    public function index()
    {
        $orders = OrderTag::latest()->get();
        return view('admin.modules.orders.index', compact('orders'));
    }

    public function downloadTagView()
    {
        return view('admin.modules.orders.download');
    }

    public function front_pdf()
    {
        
        $users = UserPet::whereDate('created_at', Carbon::parse(request()->get('date')))->get();
        $customPaper = array(0,0,1440,910);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
        ->loadHTML(view('tag.frontpdf', ['myusers' => $users])->render())->setPaper($customPaper, 'portrait');
        return $pdf->download('Front.pdf');
    }

    public function back_pdf()
    {

        $users = UserPet::whereDate('created_at', Carbon::parse(request()->get('date')))->get();
        $customPaper = array(0,0,1440,910);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
        ->loadHTML(view('tag.backpdf', ['myusers' => $users])->render())->setPaper($customPaper, 'portrait');
        return $pdf->download('Back.pdf');
    }

}
