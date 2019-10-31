@extends('front.layouts.app')

@section('title', 'Verify Email')

@section('content')
    <section class="section section-auth">
        <div class="container">
            <div class="row">
                <div class="col-md-5 float-none mx-auto">
                    <div class="form-container">
                        <div class="auth-title text-center">
                            <h3>
                                @if (session('resent'))
                                    {{ __('Verify Your Email Address') }}
                                @else
                                    {{ __('Register Success') }}
                                @endif
                            </h3>
                        </div>

                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @else
                            <div class="alert alert-success" role="alert">
                                {{ __('Successfully created a new account. Please check your email and verify your account.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
