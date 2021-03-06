<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Cloudsa9\Entities\Models\User\User;
use App\Domain\Api\V1\Requests\Auth\ForgotPasswordRequest;
use App\Http\Controllers\Controller;
use App\Mail\Api\V1\ResetPassword;
use DB;
use Illuminate\Http\Request;
use Mail;
use \Carbon\Carbon;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ForgotPasswordController extends Controller
{
    public function sendResetEmail(ForgotPasswordRequest $request)
    {
        $user = User::where('email', '=', $request->get('email'))->first();

        if (!$user) {
            // throw new NotFoundHttpException();
            return response()->json([
                'error' => true,
                'message' => 'User email not found',
            ], 404);
        } else {
            try{
                $token = str_random(64);
                
                DB::table(config('auth.passwords.users.table'))->insert([
                    'email' => $user->email,
                    'token' => $token,
                    'created_at'=> Carbon::now()
                ]);
                    
                Mail::to($request->input('email'))->send(new ResetPassword([
                    'subject' => 'Reset Password Notification',
                    'token' => $token
                ]));

                return response()->json([
                    'error' => false,
                    'message' => trans('api.messages.forgot_password.success'),
                ], 200);

            }catch (Exception $e){

                logger()->error($e);

                $response = [
                    'error' => true,
                    'message' => 'Unable to send email. Please verify your email is valid or not.',
                ];
            }
        }
    }

    public function verifyToken(Request $request)
    {
        $token = DB::table('password_resets')->where('token', $request->input('token'))->exists();

        if ($token) {
            return response()->json([
                'error' => false,
                'token' => $request->input('token'),
                'message' => 'User with this token found.',
            ], 200);
        }

        return response()->json([
            'error' => true,
            'token' => $request->input('token'),
            'message' => 'User with this token not found.',
        ], 404);
    }
}
