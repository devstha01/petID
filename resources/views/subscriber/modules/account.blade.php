@extends('front.layouts.app')

@section('title', 'Account')

@section('content')
    <section class="section section-dashboard">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('subscriber.partials.sidebar')
                </div>
                <div class="col-md-9">
                    <div class="panel panel-default mb-0">
                        <div class="panel-heading">My Account</div>

                        <div class="panel-body">

                            @include('flash::message')

                            <form method="POST" action="{{ route('subscriber.account.store') }}" id="form-account-info">
                                @csrf

                                <input type="hidden" id="full_phone" name="full_phone" value="{{ old('full_phone') }}">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                            <label for="first_name">{{ __('First Name*') }}</label>

                                            <input id="first_name" type="text" class="form-control" name="first_name"
                                                   value="{{ $user->first_name }}" required>

                                            @if ($errors->has('first_name'))
                                                <span class="help-block">{{ $errors->first('first_name') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                            <label for="last_name">{{ __('Last Name*') }}</label>
                                            <input id="last_name" type="text" class="form-control" name="last_name"
                                                   value="{{ $user->last_name }}" required>

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
                                                   value="{{ $user->email }}" required>

                                            @if ($errors->has('email'))
                                                <span class="help-block">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                            <label for="phone">{{ __('Phone*') }}</label>

                                            <input id="phone" type="text" class="form-control" name="phone"
                                                   value="{{ $user->phone }}" required>

                                            @if ($errors->has('phone'))
                                                <span class="help-block">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button type="submit" class="btn btn-default btn-style hvr-bounce-to-right">
                                            Update
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
