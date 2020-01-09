@component('mail::message')
# Hello!

You are receiving this email because we received a password reset request for your account.

Reset Link: <a type="button" class="btn btn-primary" href="{{ route('password-reset.token',['token' => $userData['token']]) }}">Reset Password</a><br>

If you did not request a password reset, no further action is required.

Regards,<br>
{{ config('app.name') }}
@endcomponent
