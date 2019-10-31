<?php

namespace App\Http\Controllers\Api\V1\Subscriber;

use Exception;
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller
{
    /**
     * Show the current subscription.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('subscriber.modules.subscription');
    }

    /**
     * Cancel subscription
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancelSubscription()
    {
        try {
            currentUser()->subscription('main')->cancel();
            flash()->success('Subscription successfully cancelled.');
        } catch (Exception $e) {
            logger()->error($e);
            flash()->error('Unable to cancel subscription.');
        }

        return redirect()->back();
    }

    /**
     * Resume subscription
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resumeSubscription()
    {
        try {
            currentUser()->subscription('main')->resume();
            flash()->success('Subscription successfully reactivated.');
        } catch (Exception $e) {
            logger()->error($e);
            flash()->error('Unable to reactivate subscription.');
        }

        return redirect()->back();
    }
}
