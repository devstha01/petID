<div class="m-portlet__body">
    <div class="m-form__section m-form__section--first">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group m-form__group{{ $errors->has('first_name') ? ' has-danger' : '' }}">
                    <label for="first_name">First Name*</label>
                    <input type="text" id="first_name" class="form-control m-input"
                           name="first_name" value="{{ old('first_name', currentUser()->first_name) }}" required>
                    @if ($errors->has('first_name'))
                        <span class="form-control-feedback">{{ $errors->first('first_name') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group m-form__group{{ $errors->has('last_name') ? ' has-danger' : '' }}">
                    <label for="last_name">Last Name*</label>
                    <input type="text" id="last_name" class="form-control m-input"
                           name="last_name" value="{{ old('last_name', currentUser()->last_name) }}" required>
                    @if ($errors->has('last_name'))
                        <span class="form-control-feedback">{{ $errors->first('last_name') }}</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group m-form__group{{ $errors->has('email') ? ' has-danger' : '' }}">
                    <label for="email">Email address*</label>
                    <input type="email" id="email" class="form-control m-input"
                           name="email" value="{{ old('email', currentUser()->email) }}" required>
                    @if ($errors->has('email'))
                        <span class="form-control-feedback">{{ $errors->first('email') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group m-form__group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                    <label for="phone">Phone*</label>
                    <input type="text" id="phone" class="form-control m-input"
                           name="phone" value="{{ old('phone', currentUser()->phone) }}" required>
                    @if ($errors->has('phone'))
                        <span class="form-control-feedback">{{ $errors->first('phone') }}</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h5 class="mb-4">Leave blank to keep unchanged.</h5>
            </div>
            <div class="col-lg-6">
                <div class="form-group m-form__group{{ $errors->has('password') ? ' has-danger' : '' }}">
                    <label for="password">Password*</label>
                    <input type="password" id="password" class="form-control m-input" name="password">
                    @if ($errors->has('password'))
                        <span class="form-control-feedback">{{ $errors->first('password') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group m-form__group">
                    <label for="confirm-password">Confirm Password*</label>
                    <input type="password" id="confirm-password" class="form-control m-input"
                           name="password_confirmation">
                </div>
            </div>
        </div>
    </div>

</div>
<div class="m-portlet__foot m-portlet__foot--fit">
    <div class="m-form__actions m-form__actions">
        <div class="row">
            <div class="col-lg-12">
                <button type="submit" class="btn btn-primary">{{ $submitButtonText }}</button>
            </div>
        </div>
    </div>
</div>