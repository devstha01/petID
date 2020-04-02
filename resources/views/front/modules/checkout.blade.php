@extends('front.layouts.app')



@section('title', 'Online-Signup')



@section('content')



    <!--== FAQ Section Start ==-->
    <section class="section section-ptb">
        <div class="container">
            <div class="row">

            <div class="col-md-6">
                Order details.
            </div>
            <div class="col-md-6">
			<h4>Final Step. Checkout</h4><br>
                <div class="form-group">
					Billing Info
                    <input type="text" class="form-control" name="email" value="" placeholder="Pet Name*" required="">
					<input type="text" class="form-control" name="password" value="" placeholder="sex*" required="">   
					<input type="text" class="form-control" name="2_password" value="" placeholder="color*" required="">
					<input type="text" class="form-control" name="full_name" value="" placeholder="breed*" required="">
					
					+ Add another pet.
					Loads another form
					
					<br><br>
					
					<button type="submit" class="btn btn-default btn-style hvr-bounce-to-right">Finalize Account</button>
					
                </div>
            </div>
        </div>
    </section>

	<br><br><br><br>

    <!--== About Section End ==-->

@endsection

