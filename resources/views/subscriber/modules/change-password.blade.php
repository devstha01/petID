@extends('front.layouts.app')

@section('title', 'Change Password')

@section('content')
    <section class="section section-dashboard">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('subscriber.partials.sidebar')
                </div>
                <div class="col-md-9">
                    <div class="panel panel-default mb-0">
                        <div class="panel-heading">Change Password</div>

                        <div class="panel-body">
                            @include('flash::message')

                            <form method="POST" action="{{ route('subscriber.account.change-password.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label for="password">{{ __('Password') }}</label>
                                            <input id="password" type="password" class="form-control" name="password"
                                                   required>

                                            @if ($errors->has('password'))
                                                <span class="help-block">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                            <input id="password-confirm" type="password" class="form-control"
                                                   name="password_confirmation" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-right">
                                        <button type="submit" class="btn btn-default btn-style hvr-bounce-to-right">
                                            Update Password
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
