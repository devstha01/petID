@extends('front.layouts.app')

@section('title', 'influencer')

@section('content')
    <!--== About Section Start ==-->
    <section class="section-padding-tb">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-team">
                        <div class="team-img">
                            <!--== Change Image here ==-->
                            <img src="/dev/public/images/influencer.png" alt="" class="">
                        </div>

                        <div class="team-content">
                            <div class="team-info">
                                <h3>We want you!</h3>
                                <p>Are you ready to join our team?</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-7 col-md-offset-1">
                    <div class="single-team-title">
                        <h3>PETiD Influencer Program</h3>
                    </div>

                    <div class="single-team-text"><br>
                        <p>We are always looking to work with social influencers who produce great content, inspire
                            others and embody safe pet ownership. Whether you have 500 or 500K followers, we are
                            actively looking to build meaningful relationships with pet influencers who want to work
                            with us and share our brand!
                            <br><br>
                            Pet id was sprouted by our love for our little furry friends. We provide a platform that
                            allows any pet to be tracked and returned home to their owners as soon as possible using our
                            in house designed tags and mobile applications. Whether in your neighborhood or across seas,
                            Pet id has your pet covered.
                            <br><br>
                            PETiD offers heavily discounted plans, FREE plans, paid posts, FREE merch, and community
                            giveaways. Please fill out the form below and we will be back with you as soon as possible.
                            We look forward to working with you! <br><br>

                            -The PETiD team

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== About Section End ==-->

    <section class="section section-ptb">

        <div class="container">

            <div class="row">

                <div class="col-md-12 contact-form">

                    {{--<h3>Fill out the form below to get started</h3>--}}

                    @include('flash::message')
                    @if(session('success'))
                    <div class="alert alert-success"><i class="fa fa-check-circle"></i> {{session('success')}}</div>
                    @endif


                    <form method="POST" action="{{route('influencer.post')}}">

                        @csrf

                        <div class="row">

                            <div class="col-md-12">

                                <div class="col-md-6">

                                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">

                                        <input type="text" class="form-control" name="first_name"
                                               value="{{ old('first_name') }}"

                                               placeholder="First Name*" required>

                                        @if ($errors->has('first_name'))

                                            <span class="help-block">{{ $errors->first('first_name') }}</span>

                                        @endif

                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">

                                        <input type="text" class="form-control" name="last_name"
                                               value="{{ old('last_name') }}"

                                               placeholder="Last Name*" required>

                                        @if ($errors->has('last_name'))

                                            <span class="help-block">{{ $errors->first('last_name') }}</span>

                                        @endif

                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}"

                                               placeholder="E-mail*"

                                               required>

                                        @if ($errors->has('email'))

                                            <span class="help-block">{{ $errors->first('email') }}</span>

                                        @endif

                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <input type="text" class="form-control date" name="birthday"
                                               id='datetimepicker1'
                                               value="{{ old('birthday') }}"

                                               placeholder="Birthday"
                                        >

                                    </div>
                                </div>

                                <div class="col-md-4">

                                    <div class="form-group">

                                        <input type="text" class="form-control date" name="city"
                                               value="{{ old('city') }}"

                                               placeholder="City"
                                        >

                                    </div>
                                </div>

                                <div class="col-md-4">

                                    <div class="form-group">

                                        <input type="text" class="form-control" name="street"
                                               value="{{ old('street') }}"

                                               placeholder="Street"
                                        >

                                    </div>
                                </div>

                                <div class="col-md-4">

                                    <div class="form-group">

                                        <input type="text" class="form-control" name="zip_code"
                                               value="{{ old('zip_code') }}"

                                               placeholder="Zip Code"
                                        >

                                    </div>
                                </div>


                                <div class="col-md-6">

                                    <div class="form-group">

                                        <input type="text" class="form-control" name="facebook_url"
                                               value="{{ old('facebook_url') }}"

                                               placeholder="Facebook URL"
                                        >

                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <input type="text" class="form-control" name="facebook_followers"
                                               value="{{ old('facebook_followers') }}"

                                               placeholder="Facebook Followers"
                                        >

                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <input type="text" class="form-control" name="twitter_url"
                                               value="{{ old('twitter_url') }}"

                                               placeholder="Twitter URL"
                                        >

                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <input type="text" class="form-control" name="twitter_followers"
                                               value="{{ old('twitter_followers') }}"

                                               placeholder="Twitter Followers"
                                        >

                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <input type="text" class="form-control" name="instagram_url"
                                               value="{{ old('instagram_url') }}"

                                               placeholder="Instagram URL"
                                        >

                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <input type="text" class="form-control" name="instagram_followers"
                                               value="{{ old('instagram_followers') }}"

                                               placeholder="Instagram Followers"
                                        >

                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <input type="text" class="form-control" name="tiktok_url"
                                               value="{{ old('tiktok_url') }}"

                                               placeholder="Tiktok URL"
                                        >

                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <input type="text" class="form-control" name="tiktok_followers"
                                               value="{{ old('tiktok_followers') }}"

                                               placeholder="Tiktok Followers"
                                        >

                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <input type="text" class="form-control" name="website_url"
                                               value="{{ old('website_url') }}"

                                               placeholder="Website URL"
                                        >

                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <input type="text" class="form-control" name="website_visitors"
                                               value="{{ old('website_visitors') }}"

                                               placeholder="Website Visitors/ Month"
                                        >

                                    </div>
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



