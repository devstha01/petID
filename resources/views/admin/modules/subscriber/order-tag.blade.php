@extends('admin.layouts.app')

@section('title', 'Order Tag')

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
            <a href="{{ route('admin.subscribers.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Subscribers</span>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">

            <!--begin::Portlet-->
            <div class="m-portlet">
                @include('flash::message')
                <!--begin::Form-->
                <form method="POST" action="{{ route('admin.subscribers.post-order-tag', $pet->id) }}"
                      class="m-form m-form--label-align-right">
                    @csrf()
                    <div class="m-portlet__body">
                        <div class="m-form__section m-form__section--first">
                            <div class="m-form__heading">
                                <h3 class="m-form__heading-title">Order Tag:</h3>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group m-form__group">
                                        <label for="pet_name">Pet Name</label>
                                        <input type="text" id="pet_name" class="form-control m-input"
                                               name="pet_name" value="{{ $pet->name }}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group m-form__group">
                                        <label for="name">Owner Name</label>
                                        <input type="text" id="name" class="form-control m-input"
                                               name="name" value="{{ $pet->user->name?? ''}}" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group m-form__group">
                                        <label for="phone">Phone</label>
                                        <input type="text" id="phone" class="form-control m-input"
                                               name="phone1" value="{{ old('phone1', $pet->user->contactInfo->phone1) }}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group m-form__group">
                                        <label for="email">Email</label>
                                        <input type="text" id="email" class="form-control m-input"
                                               name="email" value="{{ old('email', $pet->user->contactInfo->email) }}">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group m-form__group">
                                        <label for="address1">Address 1</label>
                                        <input type="text" id="address1" class="form-control m-input"
                                             name="address1" value="{{ old('address1', $pet->user->contactInfo->address1) }}">
                                             @if ($errors->has('address1'))
                                                <span class="form-control-feedback">{{ $errors->first('address1') }}</span>
                                             @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group m-form__group">
                                        <label for="address2">Address 2</label>
                                        <input type="text" id="name" class="form-control m-input"
                                               name="address2" value="{{ old('address2', $pet->user->contactInfo->address2) }}" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group m-form__group">
                                        <label for="city">City</label>
                                        <input type="text" id="city" class="form-control m-input"
                                             name="city" value="{{ old('city', $pet->user->contactInfo->city) }}">
                                        @if ($errors->has('city'))
                                          <span class="form-control-feedback">{{ $errors->first('city') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group m-form__group">
                                        <label for="state">State</label>
                                        <input type="text" id="state" class="form-control m-input"
                                               name="state" value="{{ old('state', $pet->user->contactInfo->state) }}" >
                                        @if ($errors->has('state'))
                                          <span class="form-control-feedback">{{ $errors->first('state') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group m-form__group">
                                        <label for="zip_code">Zip Code</label>
                                        <input type="text" id="zip_code" class="form-control m-input"
                                             name="zip_code" value="{{ old('zip_code', $pet->user->contactInfo->zip) }}">
                                        @if ($errors->has('zip_code'))
                                             <span class="form-control-feedback">{{ $errors->first('zip_code') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group m-form__group">
                                        <label for="country_code">Country</label>
                                        <select name="country_code" id="country_code" class="form-control m-input">Select Country
                                            <option value="">Choose Country</option>
                                            @foreach($countries as $country)
                                            <option value="{{$country->code}}">{{ $country->name }}</option>
                                            @endforeach
                                         </select>
                                        @if ($errors->has('country_code'))
                                               <span class="form-control-feedback">{{ $errors->first('country_code') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group m-form__group">
                                        <label for="total_price">Total Price</label>
                                        <input type="text" id="city" class="form-control m-input"
                                             name="total_price" value="{{ old('total_price') }}">
                                        @if ($errors->has('total_price'))
                                             <span class="form-control-feedback">{{ $errors->first('total_price') }}</span>
                                       @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group m-form__group">
                                        <label for="tag_price">Tag Price</label>
                                        <input type="text" id="state" class="form-control m-input"
                                               name="tag_price" value="{{ old('tag_price') }}" >
                                        @if ($errors->has('tag_price'))
                                             <span class="form-control-feedback">{{ $errors->first('tag_price') }}</span>
                                       @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group m-form__group">
                                        <label for="shipping_charge">Shipping Charge</label>
                                        <input type="text" id="shipping_charge" class="form-control m-input"
                                             name="shipping_charge" value="{{ old('shipping_charge') }}">
                                        @if ($errors->has('shipping_charge'))
                                             <span class="form-control-feedback">{{ $errors->first('shipping_charge') }}</span>
                                       @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group m-form__group">
                                        <label for="discount">Discount</label>
                                        <input type="text" id="discount" class="form-control m-input"
                                               name="discount" value="{{ old('discount') }}" >
                                        @if ($errors->has('discount'))
                                               <span class="form-control-feedback">{{ $errors->first('discount') }}</span>
                                         @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions m-form__actions">
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary">Order Tag</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <!--end::Form-->
            </div>
            <!--end::Portlet-->
        </div>
    </div>
@endsection

@push('scripts')

@endpush