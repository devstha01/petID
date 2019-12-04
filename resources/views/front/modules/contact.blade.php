@extends('front.layouts.app')

@section('title', 'Contact')

@section('content')
    <!--== Contact Section Start ==-->
    <section class="section section-ptb">
        <div class="container">
            <div class="row">
                <div class="text-center">
                    <h2 class="heading-center">Contact <span>Us</span></h2>
                    <p class="heading-text col-md-10 col-md-offset-1">Please use the below form to send us a message.
                        Our typical response time is 24 hours.</p>
                </div>

                <div class="col-md-12 contact-form">
                    @include('flash::message')

                    <form method="POST" action="{{ route('contact.store') }}" id="form-contact">
                        @csrf

                        <input type="hidden" id="full_phone" name="full_phone" value="{{ old('full_phone') }}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                           placeholder="Name*" required>
                                    @if ($errors->has('name'))
                                        <span class="help-block">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                           placeholder="E-mail*"
                                           required>
                                    @if ($errors->has('email'))
                                        <span class="help-block">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <input type="text" id="phone" class="form-control" name="phone"
                                           value="{{ old('phone') }}" placeholder="Phone*"
                                           required>
                                    @if ($errors->has('phone'))
                                        <span class="help-block">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                                    <input type="text" class="form-control" name="subject" value="{{ old('subject') }}"
                                           placeholder="Subject*"
                                           required>
                                    @if ($errors->has('subject'))
                                        <span class="help-block">{{ $errors->first('subject') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                                    <textarea class="form-control" name="message" placeholder="Message*">{{ old('message') }}</textarea>
                                    @if ($errors->has('message'))
                                        <span class="help-block">{{ $errors->first('message') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col col-sm-12 text-center">
                                <button type="submit" class="btn btn-default btn-style hvr-bounce-to-right">Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
