@extends('front.layouts.app')

@section('title', 'Login')

@section('content')
    <section class="section section-auth">
        <div class="container">
            <div class="row">
                <div class="col-md-5 float-none mx-auto">
                    <div class="form-container">
                        <div class="auth-title text-center">
                            <h3>{{ __('Login') }}</h3>
                        </div>

                        @include('flash::message')

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">{{ __('E-Mail Address') }}</label>

                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="password">{{ __('Password') }}</label>

                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="checkbox-inline">
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>{{ __('Remember Me') }}
                                </label>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-default btn-style hvr-bounce-to-right">{{ __('Login') }}</button>

                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                            </div>

                            <hr>

                            <p class="text-center">Don't have an account yet? <a href="{{ route('register') }}">Register here</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
