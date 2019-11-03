@extends('admin.layouts.app')

@section('title', 'Influencers')

@push('styles')

@endpush

@section('breadcrumb')
    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
        <li class="m-nav__item m-nav__item--home">
            <a href="{{ route('admin.dashboard') }}" class="m-nav__link m-nav__link--icon">
                <i class="m-nav__link-icon la la-home"></i>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="{{ route('admin.influencer.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Influencer</span>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        @include('flash::message')

        <div class="m-portlet__body">

            @if(session('success'))
                <div class="alert alert-success"><i class="fa fa-check-circle"></i> {{session('success')}}</div>
            @endif


            <form method="POST" action="{{route('admin.influencer.update',$inf->id)}}">

                @csrf

                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label>First name</label>

                            <input type="text" class="form-control" name="first_name"
                                   value="{{ $inf->first_name }}"

                                   placeholder="First Name*" required>

                            @if ($errors->has('first_name'))

                                <span class="help-block">{{ $errors->first('first_name') }}</span>

                            @endif

                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label>Last name</label>

                            <input type="text" class="form-control" name="last_name"
                                   value="{{ $inf->last_name }}"

                                   placeholder="Last Name*" required>

                            @if ($errors->has('last_name'))

                                <span class="help-block">{{ $errors->first('last_name') }}</span>

                            @endif

                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label>Email</label>

                            <input type="text" class="form-control" name="email"
                                   value="{{ $inf->email }}"

                                   placeholder="Email*" required>

                            @if ($errors->has('email'))

                                <span class="help-block">{{ $errors->first('email') }}</span>

                            @endif

                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                            <label>birthday</label>

                            <input type="text" class="form-control" name="birthday"
                                   value="{{ $inf->birthday }}"

                                   placeholder="birthday" required>

                            @if ($errors->has('birthday'))

                                <span class="help-block">{{ $errors->first('birthday') }}</span>

                            @endif

                        </div>
                    </div>


                    <div class="col-md-4">

                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label>city</label>

                            <input type="text" class="form-control" name="city"
                                   value="{{ $inf->city }}"

                                   placeholder="city" required>

                            @if ($errors->has('city'))

                                <span class="help-block">{{ $errors->first('city') }}</span>

                            @endif

                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="form-group{{ $errors->has('street') ? ' has-error' : '' }}">
                            <label>street</label>

                            <input type="text" class="form-control" name="street"
                                   value="{{ $inf->street }}"

                                   placeholder="street" required>

                            @if ($errors->has('street'))

                                <span class="help-block">{{ $errors->first('street') }}</span>

                            @endif

                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="form-group{{ $errors->has('zip_code') ? ' has-error' : '' }}">
                            <label>zip code</label>

                            <input type="text" class="form-control" name="zip_code"
                                   value="{{ $inf->zip_code }}"

                                   placeholder="zip_code" required>

                            @if ($errors->has('zip_code'))

                                <span class="help-block">{{ $errors->first('zip_code') }}</span>

                            @endif

                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group{{ $errors->has('facebook_url') ? ' has-error' : '' }}">
                            <label>facebook url</label>

                            <input type="text" class="form-control" name="facebook_url"
                                   value="{{ $inf->facebook_url }}"

                                   placeholder="facebook_url" required>

                            @if ($errors->has('facebook_url'))

                                <span class="help-block">{{ $errors->first('facebook_url') }}</span>

                            @endif

                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group{{ $errors->has('facebook_followers') ? ' has-error' : '' }}">
                            <label>facebook followers</label>

                            <input type="text" class="form-control" name="facebook_followers"
                                   value="{{ $inf->facebook_followers }}"

                                   placeholder="facebook_followers" required>

                            @if ($errors->has('facebook_followers'))

                                <span class="help-block">{{ $errors->first('facebook_followers') }}</span>

                            @endif

                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group{{ $errors->has('twitter_url') ? ' has-error' : '' }}">
                            <label>twitter url</label>

                            <input type="text" class="form-control" name="twitter_url"
                                   value="{{ $inf->twitter_url }}"

                                   placeholder="twitter_url" required>

                            @if ($errors->has('twitter_url'))

                                <span class="help-block">{{ $errors->first('twitter_url') }}</span>

                            @endif

                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group{{ $errors->has('twitter_followers') ? ' has-error' : '' }}">
                            <label>twitter followers</label>

                            <input type="text" class="form-control" name="twitter_followers"
                                   value="{{ $inf->twitter_followers }}"

                                   placeholder="twitter_followers" required>

                            @if ($errors->has('twitter_followers'))

                                <span class="help-block">{{ $errors->first('twitter_followers') }}</span>

                            @endif

                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group{{ $errors->has('instagram_url') ? ' has-error' : '' }}">
                            <label>instagram url</label>

                            <input type="text" class="form-control" name="instagram_url"
                                   value="{{ $inf->instagram_url }}"

                                   placeholder="instagram_url" required>

                            @if ($errors->has('instagram_url'))

                                <span class="help-block">{{ $errors->first('instagram_url') }}</span>

                            @endif

                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group{{ $errors->has('instagram_followers') ? ' has-error' : '' }}">
                            <label>instagram followers</label>

                            <input type="text" class="form-control" name="instagram_followers"
                                   value="{{ $inf->instagram_followers }}"

                                   placeholder="instagram_followers" required>

                            @if ($errors->has('instagram_followers'))

                                <span class="help-block">{{ $errors->first('instagram_followers') }}</span>

                            @endif

                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group{{ $errors->has('tiktok_url') ? ' has-error' : '' }}">
                            <label>tiktok url</label>

                            <input type="text" class="form-control" name="tiktok_url"
                                   value="{{ $inf->tiktok_url }}"

                                   placeholder="tiktok_url" required>

                            @if ($errors->has('tiktok_url'))

                                <span class="help-block">{{ $errors->first('tiktok_url') }}</span>

                            @endif

                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group{{ $errors->has('tiktok_followers') ? ' has-error' : '' }}">
                            <label>tiktok followers</label>

                            <input type="text" class="form-control" name="tiktok_followers"
                                   value="{{ $inf->tiktok_followers }}"

                                   placeholder="tiktok_followers" required>

                            @if ($errors->has('tiktok_followers'))

                                <span class="help-block">{{ $errors->first('tiktok_followers') }}</span>

                            @endif

                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group{{ $errors->has('website_url') ? ' has-error' : '' }}">
                            <label>website url</label>

                            <input type="text" class="form-control" name="website_url"
                                   value="{{ $inf->website_url }}"

                                   placeholder="website_url" required>

                            @if ($errors->has('website_url'))

                                <span class="help-block">{{ $errors->first('website_url') }}</span>

                            @endif

                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="form-group{{ $errors->has('website_visitors') ? ' has-error' : '' }}">
                            <label>website visitors</label>

                            <input type="text" class="form-control" name="website_visitors"
                                   value="{{ $inf->website_visitors }}"

                                   placeholder="website_visitors" required>

                            @if ($errors->has('website_visitors'))

                                <span class="help-block">{{ $errors->first('website_visitors') }}</span>

                            @endif

                        </div>
                    </div>
                    <div class="col col-sm-12 text-center">

                        <button type="submit" class="btn btn-info btn-block btn-style hvr-bounce-to-right">Update

                        </button>

                    </div>

                </div>
            </form>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $(".m-btn-delete").on("click", function (e) {
                e.preventDefault();
                let $this = $(this);

                swal({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    type: "error",
                    showCancelButton: !0,
                    confirmButtonText: "Yes, delete it!"
                }).then(function () {
                    $this.find('form').submit();
                });
            });
        });
    </script>
@endpush
