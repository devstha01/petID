@extends('front.layouts.app')

@section('title', 'Promo')

@section('content')




    <section class="section section-auth">
        <div class="container">
            <div class="row">
                <div class="col-md-6 float-none mx-auto">
                    <div class="form-container">
                        <div class="auth-title text-center">
                            <h3>{{ __('Lifetime Free Account Signup') }}</h3>
                        </div>

                        @include('flash::message')

                        <form method="POST" action="{{ route('promo') }}" id="form-promo">
                            @csrf

                            <input id="full_phone" type="hidden" name="full_phone"
                                   value="{{ old('full_phone') }}">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                        <label for="first_name">{{ __('First Name*') }}</label>

                                        <input id="first_name" type="text" class="form-control"
                                               name="first_name" value="{{ old('first_name') }}" required>

                                        @if ($errors->has('first_name'))
                                            <span class="help-block">{{ $errors->first('first_name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                        <label for="last_name">{{ __('Last Name*') }}</label>

                                        <input id="last_name" type="text" class="form-control" name="last_name"
                                               value="{{ old('last_name') }}" required>

                                        @if ($errors->has('last_name'))
                                            <span class="help-block">{{ $errors->first('last_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email">{{ __('E-Mail Address*') }}</label>
                                        <input id="email" type="email" class="form-control" name="email"
                                               value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                        <label for="phone">{{ __('Phone*') }}</label>

                                        <input id="phone" type="text" class="form-control" name="phone"
                                               value="{{ old('full_phone') }}" required>

                                        @if ($errors->has('phone'))
                                            <span class="help-block">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password">{{ __('Password*') }}</label>
                                        <input id="password" type="password" class="form-control"
                                               name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password-confirm">{{ __('Confirm Password*') }}</label>
                                        <input id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="terms" {{ old('terms') ? 'checked' : '' }} required>{{ __('I agree') }}<a href="{{ url('/tos') }}" target="_blank">{{ __(' terms & conditions.') }}</a>
                                </label>
                            </div>

                            <button type="submit" class="btn btn-default btn-style hvr-bounce-to-right">Register</button>

                            <hr>

                            <p class="text-center">Already have an account? <a href="{{ route('login') }}">Login here</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
	
	
@endsection
