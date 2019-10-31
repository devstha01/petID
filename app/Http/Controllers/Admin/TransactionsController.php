<?php

namespace App\Http\Controllers\Admin;

use App\Cloudsa9\Constants\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stripe\Charge;
use Stripe\Error\Api;
use Stripe\Stripe;

class TransactionsController extends Controller
{
    /**
     * TransactionsController constructor.
     */
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }


    /**
     * Show all transactions
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = [
            'limit' => 100,
//            'plan' => config('services.stripe.plan'),
        ];

        if ($request->has('starting_after')) {
            $params['starting_after'] = $request->input('starting_after');
        }

        if ($request->has('ending_before')) {
            $params['ending_before'] = $request->input('ending_before');
        }

        $charges = [];

        try {
            $charges = Charge::all($params);
        } catch (Api $e) {
            logger()->error($e);
        }

//        dd($charges['data']);
        return view('admin.modules.transaction.index', ['charges' => $charges]);
    }
}
