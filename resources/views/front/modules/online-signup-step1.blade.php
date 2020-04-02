@extends('front.layouts.app')



@section('title', 'Online-Signup')



@section('content')



    <!--== FAQ Section Start ==-->
    <section class="section section-ptb" id="step1">
        <div class="container">
            <div class="row">

				<div class="col-md-6 ">
                    <div class="pet-img-container">
						<img src="{{ asset('pet-images/1.jpg') }}" class="pet-img" alt="pets pic" />
                        <div class="small-img-container">
						<img src="{{ asset('pet-images/2.jpg') }}" class="pet-img" alt="pets pic" />
						<img src="{{ asset('pet-images/3.jpg') }}" class="pet-img" alt="pets pic" />
                        </div>

						<img src="{{ asset('pet-images/4.jpg') }}" class="pet-img" alt="pets pic" />
                    </div>

                    <div class="pet-images-carousel">
					<img src="{{ asset('pet-images/1.jpg') }}"  class="carousel-item" alt="pets pic" />
					<img src="{{ asset('pet-images/2.jpg') }}"  class="carousel-item" alt="pets pic" />
					<img src="{{ asset('pet-images/3.jpg') }}" class="carousel-item" alt="pets pic" />
					<img src="{{ asset('pet-images/4.jpg') }}"  class="carousel-item" alt="pets pic" />
                       
                    </div>
                </div>
				<div class="col-md-6">
                    <h4 class="form-title">Step 1. Create Account</h4><br>
                    <div class="form-group">
                        <span class="form-subtitle">Create Account</span>
                        <input type="text" class="form-control" name="email" id="email" value="" placeholder="Email*" required="">
                        <input type="text" class="form-control" name="password" id="password" value="" placeholder="Password*"
                            required="">
                        <input type="text" class="form-control" name="confirm_password" id="cpassword" value=""
                            placeholder="Repeat Password*" required="">
                        <br>

                        <span class="form-subtitle"> Pet recovery address and tag shipping info</span>
                        <input type="text" class="form-control" name="name" id="name" value="" placeholder="Full Name*"
                            required="">
                        <input type="text" class="form-control" name="address1" id="address1" value="" placeholder="Address 1*"
                            required="">
                        <input type="text" class="form-control" name="address2" id="address2" value="" placeholder="Address 2*"
                            required="">
                        <input type="text" class="form-control" name="city" id="city" value="" placeholder="City*" required="">
                        <input type="text" class="form-control" name="state" id="state" value="" placeholder="State*" required="">
                        <input type="text" class="form-control" name="zip" id="zip" value="" placeholder="Zip Code*" required="">
						<select name="country" id="country" class="form-control">
							<option value="">Please Select Country</option>
							@foreach($countries as $country)
							<option value="{{ $country->code }}">{{ $country->name }}</option>
							@endforeach
						</select>
                        <br>

                        <span class="form-subtitle"> Pet recovery Phone numbers</span>
                        <input type="text" class="form-control" name="Phone_1" value="" placeholder="Phone 1*"
                            required="">
                        <input type="text" class="form-control" name="Phone_2" value="" placeholder="Phone 2*"
                            required="">
                        <br>

                        <span class="form-subtitle">Pet recovery Offer Reward</span>
                        bool yes no
                        <br>

                        <button type="submit" class="btn btn-default btn-style hvr-bounce-to-right btn_second_step" > <a href="step2.html" >Step 2. Add Pet's
                            <i class="fas fa-arrow-right"> </i> </a></button>

                    </div>
                </div>
			</form>
            </div>
        </div>
    </section>

	<section class="section section-ptb" id="step2">
		<div class="container">
			<div class="row">
	
				<div class="col-md-6">
					<!--<img src="images/tags-app.png" alt class="img-responsive">-->
					<img src="https://pet-id.app/images/two-tags.jpg" alt class="img-responsive"><br>
					<div class="details__table">
						<div class="details__table_item">
							<div class="details__table_item-title">Tag Material:</div>
							<div class="details__table_item-description">Aluminum</div>
						</div>
						<div class="details__table_item">
							<div class="details__table_item-title">Tag Coating:</div>
							<div class="details__table_item-description">Hard Coat Anodized</div>
						</div>
						<div class="details__table_item">
							<div class="details__table_item-title">Tag Diameter:</div>
							<div class="details__table_item-description">1.25"</div>
						</div>
						<div class="details__table_item">
							<div class="details__table_item-title">Tag Thickness:</div>
							<div class="details__table_item-description">0.07"</div>
						</div>
						<div class="details__table_item">
							<div class="details__table_item-title">Tag Weight:</div>
							<div class="details__table_item-description">4 grams</div>
						</div>
						<div class="details__table_item">
							<div class="details__table_item-title">Tag Marking:</div>
							<div class="details__table_item-description">Laser Etched</div>
						</div>
						<div class="details__table_item">
							<div class="details__table_item-title">Tag Saftey:</div>
							<div class="details__table_item-description">Verified lead free</div>
						</div>
						<div class="details__table_item">
							<div class="details__table_item-title">Manufactured In:</div>
							<div class="details__table_item-description">USA</div>
						</div>
					</div>
				</div>
	
				<div class="col-md-6">
					<h4 class="form-title">Step 2. Add Pets</h4><br>
					<div class="col-md-12 contact-form">
						<span class="form-subtitle"> Pet Info</span>
						<input type="text" class="pet-name form-control" name="pet_name" value=""
							placeholder="Pet Name*" id="petname">
						<div class="group-input-fields">
						</div>
						<br>
	
						<button class="btn btn-info" id="add-pet-btn"><i class="fas fa-plus"></i> Add another pet.</button>
						<button class="btn btn-danger" id="delete-pet-btn"> <i class="fas fa-trash-alt"></i> Delete pet</button>
	
						<br><br>
	
						<button type="submit" class="btn btn-default btn-style hvr-bounce-to-right">Step 3. Checkout
							<i class="fas fa-arrow-right"></i></button>
	
					</div>
				</div>
			</div>
	</section>

	
@endsection

