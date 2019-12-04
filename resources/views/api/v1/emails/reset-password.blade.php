@component('mail::message')
# Hello!

You are receiving this email because we received a password reset request for your account.

Token: {{ $userData['token'] }}<br>

If you did not request a password reset, no further action is required.

Regards,<br>
{{ config('app.name') }}
@endcomponent
