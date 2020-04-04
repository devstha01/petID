@extends('front.layouts.app')

@section('title', 'Online-Signup')



@section('content')

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
                        <form id="contact" class="form-main" action="#">
                            <div>
                                <div class="step-heading">
                                    <div class="img-wrapper"><img src="assets/img/user.png" alt=""></div>
                                    <div class="title-wrapper">
                                        <h2>Step 1</h2>
                                        <p>Create Account</p>
                                    </div>
                                </div>
                                <section>
                                <div class="row form-set">
                                    <div class="col-md-6 leftSide">
                                        <div class="pet-img-container">
                                            <img src="assets/img/carousel/1.jpg" class="img-fluid" alt="pets pic">
                                            <div class="small-img-container">
                                                <img src="assets/img/carousel/2.jpg" class="img-fluid" alt="pets pic">
                                                <img src="assets/img/carousel/3.jpg" class="img-fluid" alt="pets pic">
                                            </div>
                                            <img src="assets/img/carousel/4.jpg" class="img-fluid" alt="pets pic">
                                        </div>
                                    </div>
                                    <div class="col-md-6 rightSide">
                                        <div class="form-heading">
                                            <h1>Create Account</h1>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email Address *</label>
                                            <input type="text" placeholder="Email Address *" value="" name="email_address" class="form-control" id="email">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password *</label>
                                            <input type="password" placeholder="Password *" name="password" class="form-control controls" id="password">
                                        </div>
                                        <div class="form-group">
                                            <label for="confirm_password">Confirm Password *</label>
                                            <input type="password" placeholder="Confirm Password *" name="confirm_password" class="form-control controls" id="confirm_password">
                                        </div>
                                    
                                        <div class="form-heading mt-3">
                                            <h1>Pet recovery address and tag shipping info</h1>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="name">Full Name *</label>
                                            <input type="text" placeholder="Full Name *" name="name" class="form-control controls" id="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="naaddressme">Address 1 *</label>
                                            <input type="text" placeholder="Address 1 *" name="address" class="form-control controls" id="address">
                                        </div>
                                        <div class="form-group">
                                            <label for="address_2">Address 2 *</label>
                                            <input type="text" placeholder="Address 2 *" name="address_2" class="form-control controls" id="address_2">
                                        </div>
                                        <div class="form-group">
                                            <label for="city">City *</label>
                                            <input type="text" placeholder="City *" name="city" class="form-control controls" id="city">
                                        </div>
                                        <div class="form-group">
                                            <label for="state">State *</label>
                                            <input type="text" placeholder="State *"  name="state" class="form-control controls" id="state">
                                        </div>
                                        <div class="form-group">
                                            <label for="zip_code">Zip Code *</label>
                                            <input type="text" placeholder="Zip Code *" name="zip_code" class="form-control controls" id="zip_code">
                                        </div>
                                        <div class="form-group">
                                            <label for="country">Country *</label>
                                            <input type="text" placeholder="Country *" name="country" class="form-control controls" id="country">
                                        </div>
                                        <div class="form-heading mt-3">
                                            <h1>Pet recovery Phone numbers</h1>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Primary Phone *</label>
                                            <input type="text" placeholder="Primary Phone *" name="phone" class="form-control controls" id="phone">
                                        </div>
                                        <div class="form-group">
                                            <label for="s_phone">Secondary Phone *</label>
                                            <input type="text" placeholder="Secondary Phone *" name="s_phone" class="form-control controls" id="s_phone">
                                        </div>
                                        
                                        <div class="form-heading mt-3">
                                            <h1>Pet recovery Offer Reward</h1>
                                            <div class="form-row reward_selection">
                                                <div class="form-group col-lg-3 col-md-4 col-sm-3 col-4">
                                                    <label class="checkbox-wrapper date-checkbox">Yes
                                                    <input type="radio" class="memberyes" name="reward" value="yes" checked="checked">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                                <div class="form-group col-lg-3 col-md-4 col-sm-3 col-4">
                                                    <label class="checkbox-wrapper date-checkbox">No
                                                        <input type="radio" class="memberno" name="reward" value="no">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </section>
                                <div class="step-heading">
                                    <div class="img-wrapper"><img src="assets/img/user.png" alt=""></div>
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
                                                    <img src="assets/img/two-tags.jpg" class="img-fluid" alt="">
                                                </div>
                                                <div class="sales-meta_desc">
                                                    <h3>Tags</h3>
                                                    <p>Tag material: Aluminum</p>
                                                    <p>Tag material: Aluminum</p>
                                                    <p>Tag material: Aluminum</p>
                                                    <p>Tag material: Aluminum</p>
                                                    <p>Tag material: Aluminum</p>
                                                    <p>Tag material: Aluminum</p>
                                                    <p>Tag material: Aluminum</p>
                                                    <p>Tag material: Aluminum</p>
                                                    <p>Tag material: Aluminum</p>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-6 rightSide">
                                            <div class="form-heading pet-add">
                                                <h1>Add Pet</h1>
                                                <a href="#" id="append_child">Add Another Pet <img src="assets/img/icons/plus_sir.svg" alt=""> </a>
                                            </div>
                                            <div class="pet-group">
                                                <div class="form-group">
                                                    <label for="pet_name">Pet Name *</label>
                                                    <input type="text" placeholder="Pet Name *" name="pet_name" class="form-control controls" id="pet_name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="gender">Gender *</label>
                                                    <select name="gender[]" class="custom-select gender" required="" id="gender" data-msg-required="Please, provide your child's gender">
                                                        <option value="">Please Gender</option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="color">Color</label>
                                                    <input type="text" placeholder="Color *" name="color" class="form-control controls" id="color">
                                                </div>
                                                <div class="form-group">
                                                    <label for="breed">Breed *</label>
                                                    <input type="text" placeholder="Breed *" name="city" class="form-control controls" id="breed">
                                                </div>
                                                <div class="form-group">
                                                <div class="upload-wrap"><p class="head">input
                                                    <div class="uploadpreview 01"></div>
                                                    <input id="01" type="file" accept="image/*">
                                                </div></p>

                                                <div class="upload-wrap"><p class="head">input
                                                    <div class="uploadpreview 02"></div>
                                                    <input id="02" type="file" accept="image/*">
                                                </div>

                                                </div>
                                            </div>
                                            <div class="pet-group">
                                                
                                                <div class="form-heading pet-add">
                                                    <h1>About Pet #<span>2</span></h1>
                                                    <a href="#" class="remove-appended">
                                                        <img src="assets/img/icons/minus_sir.svg" alt="">
                                                    </a>
                                                </div>
                                                <div class="form-group">
                                                    <label for="pet_name">Pet Name *</label>
                                                    <input type="text" placeholder="Pet Name *" name="pet_name" class="form-control controls" id="pet_name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="gender">Gender *</label>
                                                    <select name="gender[]" class="custom-select gender" required="" id="gender" data-msg-required="Please, provide your child's gender">
                                                        <option value="">Please Gender</option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="color">Color</label>
                                                    <input type="text" placeholder="Color *" name="color" class="form-control controls" id="color">
                                                </div>
                                                <div class="form-group">
                                                    <label for="breed">Breed *</label>
                                                    <input type="text" placeholder="Breed *" name="city" class="form-control controls" id="breed">
                                                </div>
                                                <div class="form-group">
                                                <div class="upload-wrap"><p class="head">input
                                                <div class="uploadpreview 03"></div>
                                                <input id="03" type="file" accept="image/*">
                                                </div></p>

                                                <div class="upload-wrap"><p class="head">input
                                                <div class="uploadpreview 04"></div>
                                                <input id="04" type="file" accept="image/*">
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                    <div class="step-heading">
                                        <div class="img-wrapper"><img src="assets/img/user.png" alt=""></div>
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
                                            <h2>Total Children: <span>1</span></h2>
                                            <h3>Total Billed Today: €<span>60</span></h3>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-heading">
                                            <h1>Payment Information</h1>
                                        </div>
                                        <div class="form-group">
                                            <div class="purchase-content-inner">
                                                <div class="licence-form-wrapp">
                                                <input id="cardholder-name" class="form-control" type="text" placeholder="Card Holder's Name">
                                            </div>
                                            <div class="purchase-content-inner">
                                                <div class="licence-form-wrapp">
                                                <input id="cardholder-name" class="form-control" type="text" placeholder="Card Number">
                                            </div>
                                            <div class="purchase-content-inner">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <input value="" type="text" name="date-expiry" placeholder="Expiry Date" required="" class="form-control"id="date_expiry">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <input value="" type="text" name="cvc"  placeholder="CVC" required="" class="form-control" id="cvc">
                                                </div>
                                            </div>
                                            </div>
                                            <div class="form-group optional-billing-info">
                                                <p>+ Add Optional Billing Information</p>
                                                <textarea class="form-control additonal_info" name="optional_billing_info" id="additonal_info"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection