@extends('front.layouts.app')

@section('title', 'Register')

@section('content')
    <section class="section section-auth">
        <div class="container">
            @if($disableRegistration)
                <div class="row">
                    <div class="col-md-6 float-none mx-auto">
                        <div class="form-container">
                            <div class="auth-title text-center">
                                <h3>{{ __('Register') }}</h3>
                            </div>
                            <div class="alert alert-warning">
                                Please download the app to register and use fownd.
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-md-6 float-none mx-auto">
                        <div class="form-container">
                            <div class="auth-title text-center">
                                <h3>{{ __('7 Days Free Then $2.99 Monthly') }}</h3>
                            </div>

                        @include('flash::message')

                        <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>

                            <form method="POST" action="{{ route('register') }}" id="form-register" data-toggle="validator">
                                @csrf

                                <input id="full_phone" type="hidden" name="full_phone"
                                       value="{{ old('full_phone') }}">

                                <div id="smartwizard-register">
                                    <ul>
                                        <li><a href="#step-1">Account Setup</a></li>
                                        <li><a href="#step-2">Profile Setup</a></li>
                                        <li><a href="#step-3">Billing Setup</a></li>
                                        <li><a href="#step-4">Agreement</a></li>
                                    </ul>

                                    <div>
                                        <div id="step-1">
                                            <div id="form-step-0" role="form" data-toggle="validator">
                                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                    <label for="email">{{ __('E-Mail Address*') }}</label>
                                                    <input id="email" type="email" class="form-control" name="email"
                                                           value="{{ old('email') }}" required>

                                                    @if ($errors->has('email'))
                                                        <span class="help-block">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>

                                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                    <label for="password">{{ __('Password*') }}</label>
                                                    <input id="password" type="password" class="form-control"
                                                           name="password" required>

                                                    @if ($errors->has('password'))
                                                        <span class="help-block">{{ $errors->first('password') }}</span>
                                                    @endif
                                                </div>

                                                <div class="form-group">
                                                    <label for="password-confirm">{{ __('Confirm Password*') }}</label>
                                                    <input id="password-confirm" type="password" class="form-control"
                                                           name="password_confirmation" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="step-2">
                                            <div id="form-step-1" role="form" data-toggle="validator">
                                                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                                    <label for="first_name">{{ __('First Name*') }}</label>

                                                    <input id="first_name" type="text" class="form-control"
                                                           name="first_name" value="{{ old('first_name') }}" required>

                                                    @if ($errors->has('first_name'))
                                                        <span class="help-block">{{ $errors->first('first_name') }}</span>
                                                    @endif
                                                </div>

                                                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                                    <label for="last_name">{{ __('Last Name*') }}</label>

                                                    <input id="last_name" type="text" class="form-control" name="last_name"
                                                           value="{{ old('last_name') }}" required>

                                                    @if ($errors->has('last_name'))
                                                        <span class="help-block">{{ $errors->first('last_name') }}</span>
                                                    @endif
                                                </div>

                                                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                                    <label for="phone">{{ __('Phone*') }}</label>

                                                    <input id="phone" type="text" class="form-control" name="phone"
                                                           value="{{ old('phone') }}" required>

                                                    @if ($errors->has('phone'))
                                                        <span class="help-block">{{ $errors->first('phone') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div id="step-3">
                                            <h4>Provide your billing and credit card details</h4>

                                            <div id="form-step-2" role="form" data-toggle="validator">
                                                <div class="form-group{{ $errors->has('card_name') ? ' has-error' : '' }}">
                                                    <label for="card_name">{{ __('Card Holder Name*') }}</label>
                                                    <input id="card_name" type="text" class="form-control" name="card_name"
                                                           value="{{ old('card_name') }}" required>

                                                    @if ($errors->has('card_name'))
                                                        <span class="help-block">{{ $errors->first('card_name') }}</span>
                                                    @endif
                                                </div>

                                                <div class="form-group{{ $errors->has('card_number') ? ' has-error' : '' }}">
                                                    <label for="card_number">{{ __('Card Number*') }}</label>
                                                    <input id="card_number" type="text" class="form-control"
                                                           name="card_number" value="{{ old('card_number') }}"
                                                           data-stripe="number" data-mask="9999 9999 9999 9999" required>

                                                    @if ($errors->has('card_number'))
                                                        <span class="help-block">{{ $errors->first('card_number') }}</span>
                                                    @endif
                                                </div>

                                                <div class="form-group{{ $errors->has('card_cvc') ? ' has-error' : '' }}">
                                                    <label for="card_cvc">{{ __('CVC*') }}</label>
                                                    <input id="card_cvc" type="text" class="form-control" name="card_cvc"
                                                           value="{{ old('card_cvc') }}" data-stripe="cvc"
                                                           data-mask="9999" required>

                                                    @if ($errors->has('card_cvc'))
                                                        <span class="help-block">{{ $errors->first('card_cvc') }}</span>
                                                    @endif
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group{{ $errors->has('card_exp_month') ? ' has-error' : '' }}">
                                                            <label for="card_exp_month">{{ __('Expiration Month*') }}</label>
                                                            <input id="card_exp_month" type="text" class="form-control"
                                                                   name="card_exp_month" value="{{ old('card_exp_month') }}"
                                                                   data-stripe="exp-month" data-mask="99" required>

                                                            @if ($errors->has('card_exp_month'))
                                                                <span class="help-block">{{ $errors->first('card_exp_month') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group{{ $errors->has('card_exp_year') ? ' has-error' : '' }}">
                                                            <label for="card_exp_year">{{ __('Expiration Year*') }}</label>
                                                            <input id="card_exp_year" type="text" class="form-control"
                                                                   name="card_exp_year" value="{{ old('card_exp_year') }}"
                                                                   data-stripe="exp-year" data-mask="9999" required>

                                                            @if ($errors->has('card_exp_year'))
                                                                <span class="help-block">{{ $errors->first('card_exp_year') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="step-4">
                                            <h4>Agreement</h4>
                                            <div id="form-step-3" role="form" data-toggle="validator">
                                                <p>By checking the checkbox below, you agree to our Terms of Use, Privacy
                                                    Statement. You may cancel at any time in your free trial and will not be
                                                    charged. Fownd will automatically continue your membership at the end of
                                                    your free trial and charge the membership fee of $2.99 to your
                                                    payment method on a monthly basis until you cancel.</p>

                                                <div class="form-group">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="terms" {{ old('terms') ? 'checked' : '' }} required>{{ __('I agree') }}<a href="{{ url('/tos') }}" target="_blank">{{ __(' terms & conditions.') }}</a>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <p class="text-center">Already have an account? <a href="{{ route('login') }}">Login here</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
