<?php

namespace App\Http\Controllers\Auth;

use App\Cloudsa9\Constants\Config;
use App\Domain\Front\Requests\Auth\PromoRequest;
use App\Domain\Front\Requests\Auth\RegisterRequest;
use App\Domain\Front\Services\User\UserService;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Stripe\Customer;
use Stripe\Error\Card;
use Stripe\Stripe;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/' . Config::SUBSCRIBER_DASHBOARD_ROUTE_PREFIX;
    /**
     * @var UserService
     */
    private $userService;

    /**
     * Create a new controller instance.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->middleware('guest');
        $this->userService = $userService;

        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $disableRegistration = true;

        return view('auth.modules.register', compact('disableRegistration'));
    }

    /**
     * Handle a registration request for the application.
     *
     * @param RegisterRequest $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        try {
            $user = $this->userService->create(array_merge($request->all(), ['account_type' => 'paid']));

            // Grab the credit card token
            $stripeToken = $request->input('stripeToken');
            $plan = config('services.stripe.plan');

            // Create the users subscription
            $subscriptionBuilder = $user->newSubscription('main', $plan)->trialDays(7);

            try {
                $subscriptionBuilder->create($stripeToken);
            } catch (Exception $e) {
                // Remove user from Stripe upon charge failure
                $user->asStripeCustomer()->delete();
                // Remove user from DB
                $this->userService->delete($user->id);
            }

            // Send email verify link
            event(new Registered($user));

            flash()->success('Successfully created a new account. Please check your email and verify your account.');

            $this->guard()->login($user);

            return $this->registered($request, $user) ?: redirect($this->redirectPath());
        } catch (Exception $e) {
            logger()->error($e);
            flash()->error('Unable to create new account.');
        }

        return redirect()->back()->withInput();
    }

    /**
     * Show the application promo form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPromo()
    {
        return view('auth.modules.promo');
    }

    /**
     * Handle a promo registration request for the application.
     *
     * @param PromoRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postPromo(PromoRequest $request)
    {
        try {
            $user = $this->userService->create(array_merge($request->all(), ['account_type' => 'free']));
            // Send email verify link
            event(new Registered($user));

            $this->guard()->login($user);

            return $this->registered($request, $user) ?: redirect($this->redirectPath());
        } catch (Exception $e) {
            logger()->error($e);
            flash()->error('Unable to create new account.');
        }

        return redirect()->back()->withInput();
    }
}
