<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Cloudsa9\Entities\Models\User\User;
use App\Domain\Api\V1\Requests\Auth\ResetPasswordRequest;
use App\Http\Controllers\Controller;
use DB;
use Tymon\JWTAuth\JWTAuth;

class ResetPasswordController extends Controller
{
    public function resetPassword(ResetPasswordRequest $request, JWTAuth $JWTAuth)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $token = $request->input('token');

        $token = DB::table('password_resets')
            ->where('email', $email)
            ->where('token', $token)
            ->first();

        if ($token) {
            $user = User::where('email', '=', $email)->first();
            $this->reset($user, bcrypt($password));

            $this->destroyToken(['email' => $email, 'token' => $token]);

            return response()->json([
                'error' => false,
                'token' => $JWTAuth->fromUser($user),
                'message' => 'Password successfully changed.',
            ]);
        }

        return response()->json([
            'error' => true,
            'message' => 'Something went wrong. Please try again.'
        ]);
    }

    /**
     * Reset the given user's password.
     *
     * @param $user
     * @param $password
     */
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
}
