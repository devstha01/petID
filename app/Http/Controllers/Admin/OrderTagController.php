<?php

namespace App\Http\Controllers\Admin;

use App\Cloudsa9\Entities\Models\User\OrderTag;
use App\Cloudsa9\Entities\Models\User\UserPet;
use App\Cloudsa9\Entities\Models\User\User;
use App\Cloudsa9\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Carbon\Carbon;
use Response;

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
        // $users = UserPet::whereDate('created_at', Carbon::parse(request()->get('date')))->get();
        $users = UserPet::join('order_tags','order_tags.pet_id','=','user_pets.id')->whereDate('order_tags.created_at', Carbon::parse(request()->get('date')))->get();
        if(count($users) <= 0){
            flash()->success('No any orders available for the date you have selected');
            return redirect('admin/download-template');
        }
        $customPaper = array(0,0,1440,910);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
        ->loadHTML(view('tag.frontpdf', ['myusers' => $users])->render())->setPaper($customPaper, 'portrait');
        return $pdf->download(Carbon::now()->toDateString().'-front.pdf');
    }

    public function back_pdf()
    {
        // $users = UserPet::whereDate('created_at', Carbon::parse(request()->get('date')))->get();
        $users = UserPet::join('order_tags','order_tags.pet_id','=','user_pets.id')->whereDate('order_tags.created_at', Carbon::parse(request()->get('date')))->get();
        if(count($users) <= 0){
            flash()->success('No any orders available for the date you have selected');
            return redirect('admin/download-template');
        }
        $customPaper = array(0,0,1440,910);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
        ->loadHTML(view('tag.backpdf', ['myusers' => $users])->render())->setPaper($customPaper, 'portrait');
        return $pdf->download(Carbon::now()->toDateString().'-back.pdf');
    }

    public function getCSVReport()
    {
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=file.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );
    
        $orderTags = OrderTag::whereDate('created_at', Carbon::parse(request()->get('date')))->get();
        if(count($orderTags) <= 0){
            flash()->success('No any orders available for the date you have selected');
            return redirect('admin/download-template');
        }
        $columns = array('UserId','Pet Owner','Petcode', 'Pet Name','Total Price','Address1','Address2','City','State','Zip Code','Country Code','Stripe Token');
    
        $callback = function() use ($orderTags, $columns)
        {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
    
            foreach($orderTags as $tag) {
                fputcsv($file, array($tag->user_id,$tag->user->name, $tag->pet->pet_code, $tag->pet->name, $tag->total_price, $tag->address1, $tag->address2,$tag->city,$tag->state,$tag->zip_code,$tag->country_code,$tag->stripe_token));
            }
            fclose($file);
        };
        return Response::stream($callback, 200, $headers);
    }

}
