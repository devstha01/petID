@extends('front.layouts.app')

@section('title', 'Recovery Info')

@section('content')
    <section class="section section-dashboard">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('subscriber.partials.sidebar')
                </div>
                <div class="col-md-9">
                    <div class="panel panel-default panel-contact-info mb-0">
                        <div class="panel-heading">Recovery Info</div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    @include('flash::message')

                                    <p>Use the below settings to configure your contact options if your phone is
                                        found. *Secondary phone numbers are not for your own number. Use friends and family members.</p>

                                    <form method="POST" action="{{ route('subscriber.contact-info.store') }}"
                                          id="form-contact-info">
                                        @csrf

                                        <input type="hidden" id="full_phone1" name="full_phone1"
                                               value="{{ old('full_phone1') }}">
                                        <input type="hidden" id="full_phone2" name="full_phone2"
                                               value="{{ old('full_phone2') }}">
                                        <input type="hidden" id="full_phone3" name="full_phone3"
                                               value="{{ old('full_phone3') }}">
                                        <input type="hidden" id="full_phone4" name="full_phone4"
                                               value="{{ old('full_phone4') }}">

                                        @if(!is_null($contactInfo))
                                            <input type="hidden" name="contact_info_id" value="{{ $contactInfo->id }}">
                                        @endif

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                    <label for="name">{{ __('Name*') }}</label>

                                                    <input id="name" type="text" class="form-control" name="name"
                                                           value="{{ old('name', optional($contactInfo)->name) }}"
                                                           required>

                                                    @if ($errors->has('name'))
                                                        <span class="help-block">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                    <label for="email">{{ __('E-Mail Address*') }}</label>
                                                    <input id="email" type="email" class="form-control" name="email"
                                                           value="{{ old('email', optional($contactInfo)->email) }}"
                                                           required>

                                                    @if ($errors->has('email'))
                                                        <span class="help-block">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group{{ $errors->has('phone1') ? ' has-error' : '' }}">
                                                    <label for="phone-1">{{ __('Secondary Phone Number 1*') }}</label>

                                                    <input id="phone-1" type="text" class="form-control" name="phone1"
                                                           value="{{ old('phone1', optional($contactInfo)->phone1) }}"
                                                           required>

                                                    @if ($errors->has('phone1'))
                                                        <span class="help-block">{{ $errors->first('phone1') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group{{ $errors->has('phone2') ? ' has-error' : '' }}">
                                                    <label for="phone-2">{{ __('Secondary Phone Number 2') }}</label>

                                                    <input id="phone-2" type="text" class="form-control" name="phone2"
                                                           value="{{ old('phone2', optional($contactInfo)->phone2) }}">

                                                    @if ($errors->has('phone2'))
                                                        <span class="help-block">{{ $errors->first('phone2') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group{{ $errors->has('phone3') ? ' has-error' : '' }}">
                                                    <label for="phone-3">{{ __('Secondary Phone Number 3') }}</label>

                                                    <input id="phone-3" type="text" class="form-control" name="phone3"
                                                           value="{{ old('phone3', optional($contactInfo)->phone3) }}">

                                                    @if ($errors->has('phone3'))
                                                        <span class="help-block">{{ $errors->first('phone3') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group{{ $errors->has('phone4') ? ' has-error' : '' }}">
                                                    <label for="phone-4">{{ __('Secondary Phone Number 4') }}</label>

                                                    <input id="phone-4" type="text" class="form-control" name="phone4"
                                                           value="{{ old('phone4', optional($contactInfo)->phone4) }}">

                                                    @if ($errors->has('phone4'))
                                                        <span class="help-block">{{ $errors->first('phone4') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                            {{--<div class="col-md-6">--}}
                                                {{--<div class="form-group{{ $errors->has('address1') ? ' has-error' : '' }}">--}}
                                                    {{--<label for="address1">{{ __('Address Line 1*') }}</label>--}}
                                                    {{--<input type="text" id="address1" class="form-control" name="address1"--}}
                                                           {{--value="{{ old('address1', optional($contactInfo)->address1) }}" required>--}}

                                                    {{--@if ($errors->has('address1'))--}}
                                                        {{--<span class="help-block">{{ $errors->first('address1') }}</span>--}}
                                                    {{--@endif--}}
                                                {{--</div>--}}
                                            {{--</div>--}}

                                            {{--<div class="col-md-6">--}}
                                                {{--<div class="form-group{{ $errors->has('address2') ? ' has-error' : '' }}">--}}
                                                    {{--<label for="address2">{{ __('Address Line 2') }}</label>--}}

                                                    {{--<input type="text" id="address2" class="form-control" name="address2"--}}
                                                           {{--value="{{ old('address2', optional($contactInfo)->address2) }}">--}}

                                                    {{--@if ($errors->has('address2'))--}}
                                                        {{--<span class="help-block">{{ $errors->first('address2') }}</span>--}}
                                                    {{--@endif--}}
                                                {{--</div>--}}
                                            {{--</div>--}}

                                            {{--<div class="col-md-6">--}}
                                                {{--<div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">--}}
                                                    {{--<label for="city">{{ __('City*') }}</label>--}}
                                                    {{--<input type="text" id="city" class="form-control" name="city"--}}
                                                           {{--value="{{ old('city', optional($contactInfo)->city) }}" required>--}}

                                                    {{--@if ($errors->has('city'))--}}
                                                        {{--<span class="help-block">{{ $errors->first('city') }}</span>--}}
                                                    {{--@endif--}}
                                                {{--</div>--}}
                                            {{--</div>--}}

                                            {{--<div class="col-md-6">--}}
                                                {{--<div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">--}}
                                                    {{--<label for="state">{{ __('State*') }}</label>--}}

                                                    {{--<input id="state" type="text" class="form-control" name="state"--}}
                                                           {{--value="{{ old('state', optional($contactInfo)->state) }}" required>--}}

                                                    {{--@if ($errors->has('state'))--}}
                                                        {{--<span class="help-block">{{ $errors->first('state') }}</span>--}}
                                                    {{--@endif--}}
                                                {{--</div>--}}
                                            {{--</div>--}}

                                            {{--<div class="col-md-6">--}}
                                                {{--<div class="form-group{{ $errors->has('zip') ? ' has-error' : '' }}">--}}
                                                    {{--<label for="zip">{{ __('Zip*') }}</label>--}}
                                                    {{--<input type="text" id="zip" class="form-control" name="zip"--}}
                                                           {{--value="{{ old('zip', optional($contactInfo)->zip) }}" required>--}}

                                                    {{--@if ($errors->has('zip'))--}}
                                                        {{--<span class="help-block">{{ $errors->first('zip') }}</span>--}}
                                                    {{--@endif--}}
                                                {{--</div>--}}
                                            {{--</div>--}}

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group radio-group">
                                                    <label for="">Reward Offered*</label>
                                                    <div class="radio">
                                                        <label><input type="radio" name="reward" value="1" {{ !is_null($contactInfo) && $contactInfo->reward == 1 ? 'checked' : '' }} required>Yes</label>
                                                    </div>
                                                    <div class="radio">
                                                        <label><input type="radio" name="reward" value="0" {{ !is_null($contactInfo) && $contactInfo->reward == 0 ? 'checked' : '' }} required>No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="message">{{ __('Message') }}</label>
                                                    <textarea id="message" class="form-control" name="message" rows="6"
                                                              placeholder="Custom message to display to person that finds phone.">{{ old('message', optional($contactInfo)->message) }}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-default btn-style hvr-bounce-to-right">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
