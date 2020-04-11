@extends('front.layouts.app')

@section('title', 'Online-Signup')

@section('extra-css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ asset('assets/date-picker/datepicker.min.css')}}">
<!-- <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}"> -->
<link rel="stylesheet" href="{{ asset('slick-1.8.1/slick/slick.css')}}"/>
<link rel="stylesheet" href="{{ asset('slick-1.8.1/slick/slick-theme.css')}}"/>
<link rel="stylesheet" href="{{ asset('assets/css/jquery.steps.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection

@section('content')
<div class="loading-wrapper">
    <div class="inner-spin-wrapper">
        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
        <span>Please Wait...</span>
    </div>
</div>
<div class="body-content">
    <div class="inner-banner" style="background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.92), rgba(217, 207, 207, 0.72)), url(assets/img/carousel/3_.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-md-12"></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="payment-form-wrapper">
                    <form id="contact" class="form-main" method="POST" action="{{ route('payment') }}">
                    @csrf
                        <div>
                            <div class="step-heading">
                                <div class="img-wrapper"><img src="{{ asset('assets/img/user.png') }}" alt=""></div>
                                <div class="title-wrapper">
                                    <h2>Step 1</h2>
                                    <p>Create Account</p>
                                </div>
                            </div>
                            <section>
                            <div class="row form-set">
                                <div class="col-md-6 leftSide">
                                    <div class="pet-img-container">
                                        <img src="{{ asset('assets/img/carousel/1.jpg') }}" class="img-responsive" alt="pets pic">
                                        <div class="small-img-container">
                                            <img src="{{ asset('assets/img/carousel/2.jpg') }}" class="img-responsive" alt="pets pic">
                                            <img src="{{ asset('assets/img/carousel/3.jpg') }}" class="img-responsive" alt="pets pic">
                                        </div>
                                        <img src="{{ asset('assets/img/carousel/4.jpg') }}" class="img-responsive" alt="pets pic">
                                    </div>
                                    <div class="pet-slider">
                                        <div class="item">
                                            <img src="{{ asset('assets/img/carousel/1.jpg') }}" class="img-responsive" alt="pets pic">
                                        </div>
                                        <div class="item">
                                            <img src="{{ asset('assets/img/carousel/2.jpg') }}" class="img-responsive" alt="pets pic">
                                        </div>
                                        <div class="item">
                                            <img src="{{ asset('assets/img/carousel/3.jpg') }}" class="img-responsive" alt="pets pic">
                                        </div>
                                        <div class="item">
                                            <img src="{{ asset('assets/img/carousel/4.jpg') }}" class="img-responsive" alt="pets pic">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 rightSide">
                                    <div class="form-heading">
                                        <h1>Create Account</h1>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email Address *</label>
                                        <input type="text" placeholder="Email Address *" value="{{ old('email') }}" name="email" class="form-control" id="email">
                                         @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password *</label>
                                        <input type="password" placeholder="Password *" name="password" class="form-control controls" id="password">

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm_password">Confirm Password *</label>
                                        <input type="password" placeholder="Confirm Password *" name="password_confirmation" class="form-control controls" id="confirm_password">
                                        @if ($errors->has('confirm_password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('confirm_password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                
                                    <div class="form-heading mt-3">
                                        <h1>Pet recovery: address and tag shipping info</h1>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="name">Full Name *</label>
                                        <input type="text" placeholder="Full Name *" name="name" value="{{ old('name') }}" class="form-control controls" id="name">
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address 1 *</label>
                                        <input type="text" placeholder="Address 1 *" name="address" value="{{ old('address') }}" class="form-control controls" id="address">
                                        @if ($errors->has('address'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="address_2">Address 2 *</label>
                                        <input type="text" placeholder="Address 2" name="address_2" value="{{ old('address_2') }}" class="form-control controls" id="address_2">
                                        @if ($errors->has('address_2'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('address_2') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="city">City *</label>
                                        <input type="text" placeholder="City *" name="city" value="{{ old('city') }}" class="form-control controls" id="city">
                                        @if ($errors->has('city'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('city') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="state">State *</label>
                                        <input type="text" placeholder="State *"  name="state" value="{{ old('state') }}" class="form-control controls" id="state">
                                        @if ($errors->has('state'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('state') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="zip_code">Zip Code *</label>
                                        <input type="text" placeholder="Zip Code *" name="zip_code" value="{{ old('zip_code') }}" class="form-control controls" id="zip_code">
                                        @if ($errors->has('zip_code'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('zip_code') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="country">Country *</label>
                                         <select name="country" class="custom-select" required="" id="country">
                                            <option value="">Please Country</option>
                                            @foreach($countries as $key =>$country)
                                            <option value="{{ $key }}">{{ $country }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('country'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('country') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-heading mt-3">
                                        <h1>Pet recovery: Phone numbers</h1>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Primary Phone *</label>
                                        <input type="text" placeholder="Primary Phone *" name="phone" value="{{ old('phone') }}" class="form-control controls" id="phone">
                                         @if ($errors->has('phone'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="s_phone">Secondary Phone *</label>
                                        <input type="text" placeholder="Secondary Phone" name="s_phone" value="{{ old('s_phone') }}" class="form-control controls" id="s_phone">
                                         @if ($errors->has('s_phone'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('s_phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <div class="form-heading mt-3">
                                        <h1>Pet recovery: Offer Reward</h1>
                                        <div class="form-row reward_selection">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-3 col-sm-2 col-xs-5">
                                                        <label class="checkbox-wrapper date-checkbox">Yes
                                                        <input type="radio" class="memberyes" name="reward" value="yes" checked="checked">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-3 col-sm-2 col-xs-5">
                                                        <label class="checkbox-wrapper date-checkbox">No
                                                            <input type="radio" class="memberno" name="reward" value="no">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </section>
                            <div class="step-heading">
                                <div class="img-wrapper"><img src="{{ asset('assets/img/dog.png') }}" alt=""></div>
                                <div class="title-wrapper">
                                    <h2>Step 2</h2>
                                    <p>Add Pets</p>
                                </div>
                            </div>
                            <section>
                                <div class="row form-set">
                                    <div class="col-md-6 rightSide">
                                        <div class="sales-wrapper">
                                            <div class="img-wrapper">
                                                <img src="{{ asset('assets/img/two-tags.jpg') }}" class="img-responsive" alt="">
                                            </div>
                                            <div class="sales-meta_desc">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <h3>Product Name: ROCCO TAG</h3>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <p>Tag material:</p>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <p>Aluminum</p>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <p>Tag Coating:</p>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <p>Hard Coat Anodized</p>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <p>Tag Diameter:</p>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <p>1.25"</p>    
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <p>Tag Thickness:</p>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <p>0.07"</p>
                                                    </div>
                                                    
                                                    <div class="col-sm-4">
                                                        <p>Tag Weight:</p>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <p>4 grams</p>
                                                    </div>
                                                    
                                                    <div class="col-sm-4">
                                                        <p>Tag Marking:</p>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <p>Laser Etched</p>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <p>Tag Saftey:</p>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <p>Verified lead tree</p>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <p>Manufactured In:</p>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <p>USA</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-6 rightSide">
                                        <div class="form-heading pet-add">
                                            <h1>About Pet</h1>
                                            <a href="javascript:void(0);" id="add-pet">Add Another Pet <img src="{{ asset('assets/img/icons/plus_sir.svg') }}" alt=""> </a>
                                        </div>
                                        <div id="pets_details"></div>
                                       
                                    </div>
                                </div>
                            </section>
                                <div class="step-heading">
                                    <div class="img-wrapper"><img src="{{ asset('assets/img/cart.png') }}" alt=""></div>
                                    <div class="title-wrapper">
                                        <h2>Step 3</h2>
                                        <p>Payment Method</p>
                                    </div>
                                </div>
                                <section>
                                <div class="row form-set">
                                <div class="col-md-6">
                                    <div class="form-heading">
                                        <h1>Billing Details</h1>
                                    </div>

                                    <div class="total-cost-wrapper">
                                        <h2>Total Pets: <span id="total-pets"></span></h2>
                                        <h3>Total Amount: <span id="total-amount"></span></h3>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-heading">
                                        <h1>Payment Information</h1>
                                    </div>
                                    <div class="form-group">
                                        <div class="payment-errors"></div>
                                        <div class="alert alert-danger" style="display:none"></div>
                                        <div class="purchase-content-inner">
                                            <div class="licence-form-wrapp">
                                                <input id="cardholder-name" name="cardholder_name" class="form-control" type="text" placeholder="Card Holder's Name">
                                                <input id="cardholder-number" name="card_holder" class="form-control" type="text" placeholder="Card Number">
                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <input value="" type="text" name="date_expiry" placeholder="Expiry Date" required="" class="form-control"id="date_expiry">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <input value="" type="text" name="cvc" maxlength="4" placeholder="CVC" required="" class="form-control" id="cvc">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <div class="thanks-wrapper">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="thanks-inner">
                                            <h2>Congratulations!</h2>
                                            <p>Your registration is complete and you will now be sent an email confirming all your booking confirmation details.</p>
                                            <p>If you have any further queries please contact please contact us on <a href="call: 01422545">01422545</a>. For further information or email <a href="mailto:web.sdfsd@fs.com">web.sdfsd@fs.com</a> </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-js')
<!-- APRIL 4TH, 2020 -->

<!-- <script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
<!-- <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script> -->
<script src="{{ asset('assets/date-picker/datepicker.min.js')}}"></script>
<script src="{{ asset('slick-1.8.1/slick/slick.min.js')}}"></script>
<script src="{{ asset('assets/js/jquery.steps.js') }}"></script>
<script src="{{ asset('assets/js/jquery.mask.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/underscore.min.js') }}"></script>
<script src="https://js.stripe.com/v2/"></script>


<script type="text/html" id="pet_tmpl">

<div class="pet-group" id="pet-row<%=row_id%>">
    <div class="form-heading pet-add">
         <h1>About Pet #<span><%=row_id%></span></h1>
         <% if(row_id > 1) { %>
             <a href="#" class="remove-appended remove-pet">
                 <img src="assets/img/icons/minus_sir.svg" alt="">
             </a>
         <% } %>
     </div>

    <div class="form-group">
        <label for="pet_name">Pet Name *</label>
        <input type="text" placeholder="Pet Name *" name="pets[<%=row_id%>][name]" class="form-control controls" id="pet_name" required="">
    </div>
    <div class="form-group">
        <label for="gender">Gender *</label>
        <select name="pets[<%=row_id%>][gender]" class="custom-select gender" required="" id="gender">
            <option value="">Please Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
    </div>
    <div class="form-group">
        <label for="color">Color</label>
        <input type="text" placeholder="Color *" name="pets[<%=row_id%>][color]" class="form-control controls" id="color" required="">
    </div>
    <div class="form-group">
        <label for="breed">Breed *</label>
        <input type="text" placeholder="Breed *" name="pets[<%=row_id%>][breed]" class="form-control controls" id="breed" required="">
    </div>
    <!-- <div class="form-group">
    <div class="upload-wrap">
        <p class="head">Upload Pet Image</p>
        <label for="01">
            <div class="uploadpreview 01"></div>
        </label>
        <input id="01" type="file" name="pets[<%=row_id%>][image1]" accept="image/*">
    </div>

    <div class="upload-wrap">
        <p class="head">Upload Pet Image</p>
        <label for="02">
            <div class="uploadpreview 02"></div>
        </label>
        <input id="02" type="file" name="pets[<%=row_id%>][image2]" accept="image/*">
    </div>

    </div> -->
</div>

</script>

<script type="text/javascript">

var counter = 0;
  $(function () {

     var pet_tmpl = $("#pet_tmpl").html();

     var pets_details = $("#pets_details");

    $("#add-pet").on("click", function (e) {
      var dataObject = { row_id: ++counter };
      var _new_row_tmpl  = _.template( pet_tmpl,  dataObject );
      pets_details.append( _new_row_tmpl );
    
    });

    $("#calculate-charge").on("click", function (e) {
        alert('calculate-charge')
    
    });
  });

  $(document).on("click", ".remove-pet", function(){

    $(this).parents(".pet-group").remove();

  });

Stripe.setPublishableKey("{{ config('services.stripe.key')}}");



  
</script>
@stop
