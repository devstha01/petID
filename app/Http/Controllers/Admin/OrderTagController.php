<?php

namespace App\Http\Controllers\Admin;

use App\Cloudsa9\Entities\Models\User\OrderTag;
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
}
