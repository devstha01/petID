@extends('front.layouts.app')



@section('title', 'Online-Signup')



@section('content')


<section class="section section-ptb">
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
					<input type="text" class="pet-name form-control" name="pet name" value=""
						placeholder="Pet Name*" required="">
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

