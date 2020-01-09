<?php

namespace App\Http\Controllers\Auth;

use App\Cloudsa9\Constants\Config;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Cloudsa9\Entities\Models\User\User;
use Illuminate\Http\Request;
use DB;
use \Carbon\Carbon;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/' . Config::SUBSCRIBER_DASHBOARD_ROUTE_PREFIX;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        $isTokenAvailable = DB::table('password_resets')
            ->where('token', $token)
//            ->where('token', $inputs['token'])
            ->first();
        if($isTokenAvailable){
            $now = Carbon::now()->toDateString();
            $expiryDate = Carbon::parse($isTokenAvailable->created_at)->addDays(1);
            if($expiryDate < $now){
                return view('auth.modules.passwords.reset-expire')->with(
                    ['token' => $token, 'email' => $request->email]
                );
            }
            return view('auth.modules.passwords.reset')->with(
                ['token' => $token, 'email' => $request->email]
            );
        } else {
            return view('auth.modules.passwords.reset-expire')->with(
                ['token' => $token, 'email' => $request->email]
            );
        }
       
    }

    public function resetPassword(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

        $user = User::where('email', '=', $request->email)->first();
        $this->reset($user, bcrypt($request->password));

        $this->destroyToken(['email' => $request->email, 'token' => $request->reset_token]);
        return redirect('reset-success');
   
    }

    protected function reset($user, $password)
    {
        $user->password = $password;
        $user->save();
    }

    /**
     * Destroy token
     *
     * @param $inputs
     */
    public function destroyToken(array $inputs)
    {
        DB::table('password_resets')
            ->where('email', $inputs['email'])
//            ->where('token', $inputs['token'])
            ->delete();
    }

    public function resetSuccess(){
        return view('auth.modules.passwords.reset-success');
    }
}
