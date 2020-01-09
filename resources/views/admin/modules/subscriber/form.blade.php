<div class="m-portlet__body">
    <div class="m-form__section m-form__section--first">
        <div class="m-form__heading">
            <h3 class="m-form__heading-title">Account Info:</h3>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group m-form__group{{ $errors->has('name') ? ' has-danger' : '' }}">
                    <label for="name">Name*</label>
                    <input type="text" id="name" class="form-control m-input"
                           name="name" value="{{ old('name', optional($accountInfo)->name) }}" required>
                    @if ($errors->has('name'))
                        <span class="form-control-feedback">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>
            
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group m-form__group{{ $errors->has('email') ? ' has-danger' : '' }}">
                    <label for="email">Email address*</label>
                    <input type="email" id="email" class="form-control m-input"
                           name="email" value="{{ old('email', optional($accountInfo)->email) }}" required>
                    @if ($errors->has('email'))
                        <span class="form-control-feedback">{{ $errors->first('email') }}</span>
                    @endif
                </div>
            </div>
            {{-- <div class="col-lg-6">
                <div class="form-group m-form__group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                    <label for="phone">Phone*</label>
                    <input type="text" id="phone" class="form-control m-input"
                           name="phone" value="{{ old('phone', optional($accountInfo)->phone) }}" required>
                    @if ($errors->has('phone'))
                        <span class="form-control-feedback">{{ $errors->first('phone') }}</span>
                    @endif
                </div>
            </div> --}}
        </div>

        @if(empty($accountInfo))
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group m-form__group{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <label for="password">Password*</label>
                        <input type="password" id="password" class="form-control m-input" name="password" required>
                        @if ($errors->has('password'))
                            <span class="form-control-feedback">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group m-form__group">
                        <label for="confirm-password">Confirm Password*</label>
                        <input type="password" id="confirm-password" class="form-control m-input"
                               name="password_confirmation" required>
                    </div>
                </div>
            </div>
        @endif

        {{-- <div class="row">
            <div class="col-lg-12">
                <div class="form-group m-form__group{{ $errors->has('account_type') ? ' has-danger' : '' }}">
                    <label>Account Type*</label>
                    <div class="m-radio-inline">
                        @foreach($accountType as $accountTypeKey => $accountTypeValue)
                            <label class="m-radio m-radio--solid">
                                <input type="radio" name="account_type" value="{{ $accountTypeValue }}"
                                       @if(old('account_type', optional($accountInfo)->account_type) == $accountTypeValue) checked @endif required> {{ ucfirst($accountTypeValue) }}
                                <span></span>
                            </label>
                        @endforeach
                    </div>
                    @if ($errors->has('account_type'))
                        <span class="form-control-feedback">{{ $errors->first('account_type') }}</span>
                    @endif
                </div>
            </div>
        </div> --}}

        {{-- <div class="row">
            <div class="col-lg-12">
                <div class="form-group m-form__group{{ $errors->has('status') ? ' has-danger' : '' }}">
                    <label>Status*</label>
                    <div class="m-radio-inline">
                        @foreach($status as $statusKey => $statusValue)
                            <label class="m-radio m-radio--solid">
                                <input type="radio" name="status" value="{{ $statusValue }}"
                                       @if(old('status', optional($accountInfo)->status) == $statusValue) checked @endif required> {{ ucfirst($statusValue) }}
                                <span></span>
                            </label>
                        @endforeach
                    </div>
                    @if ($errors->has('status'))
                        <span class="form-control-feedback">{{ $errors->first('status') }}</span>
                    @endif
                </div>
            </div>
        </div> --}}

        <div class="row">
            <div class="col-lg-12">
                <div class="form-group m-form__group{{ $errors->has('email_verified') ? ' has-danger' : '' }}">
                    <label>Email Verified*</label>
                    <div class="m-radio-inline">
                        <label class="m-radio m-radio--solid">
                            <input type="radio" name="email_verified" value="yes" @if(old('email_verified') == 'yes' || optional($accountInfo)->email_verified_at != null) checked @endif required> Yes
                            <span></span>
                        </label>
                        <label class="m-radio m-radio--solid">
                            <input type="radio" name="email_verified" value="no" @if(old('email_verified') == 'no' || optional($accountInfo)->email_verified_at == null) checked @endif required> No
                            <span></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="row">
            <div class="col-lg-12">
                <div class="form-group m-form__group mb-0{{ $errors->has('subscribe_newsletter') ? ' has-danger' : '' }}">
                    <label>Subscribe Newsletter</label>
                    <div class="m-radio-inline">
                        <label class="m-radio m-radio--solid">
                            <input type="radio" name="subscribe_newsletter" value="yes" checked required> Yes
                            <span></span>
                        </label>
                        <label class="m-radio m-radio--solid">
                            <input type="radio" name="subscribe_newsletter" value="no" required> No
                            <span></span>
                        </label>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- <div class="row d-none">
            <div class="col-lg-12">
                <div class="form-group m-form__group mb-0{{ $errors->has('email_notification') ? ' has-danger' : '' }}">
                    <label>Send Email Notification</label>
                    <div class="m-radio-inline">
                        <label class="m-radio m-radio--solid">
                            <input type="radio" name="email_notification" value="yes" checked> Yes
                            <span></span>
                        </label>
                        <label class="m-radio m-radio--solid">
                            <input type="radio" name="email_notification" value="no"> No
                            <span></span>
                        </label>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>

    <div class="m-form__seperator m-form__seperator--dashed"></div>
    <div class="m-form__section m-form__section--last">
        <div class="m-form__heading">
            <h3 class="m-form__heading-title">Recovery Info:</h3>
        </div>

        {{-- <div class="row"> --}}
            {{-- <div class="col-lg-6">
                <div class="form-group m-form__group{{ $errors->has('contact_name') ? ' has-danger' : '' }}">
                    <label for="contact-name">Full Name*</label>
                    <input type="text" id="contact-name" class="form-control m-input"
                           name="contact_name" value="{{ old('contact_name', optional($contactInfo)->name) }}" required>
                    @if ($errors->has('contact_name'))
                        <span class="form-control-feedback">{{ $errors->first('contact_name') }}</span>
                    @endif
                </div>
            </div> --}}
            {{-- <div class="col-lg-6">
                <div class="form-group m-form__group{{ $errors->has('contact_email') ? ' has-danger' : '' }}">
                    <label for="contact-email">Email Address*</label>
                    <input type="email" id="contact-email" class="form-control m-input"
                           name="contact_email" value="{{ old('contact_email', optional($contactInfo)->email) }}" required>
                    @if ($errors->has('contact_email'))
                        <span class="form-control-feedback">{{ $errors->first('contact_email') }}</span>
                    @endif
                </div>
            </div>
        </div> --}}

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group m-form__group{{ $errors->has('contact_phone1') ? ' has-danger' : '' }}">
                    <label for="contact-phone1">Phone Number 1*</label>
                    <input type="text" id="contact-phone1" class="form-control m-input"
                           name="contact_phone1" value="{{ old('contact_phone1', optional($contactInfo)->phone1) }}" required>
                    @if ($errors->has('contact_phone1'))
                        <span class="form-control-feedback">{{ $errors->first('contact_phone1') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group m-form__group{{ $errors->has('contact_phone2') ? ' has-danger' : '' }}">
                    <label for="contact-phone2">Phone Number 2</label>
                    <input type="text" id="contact-phone2" class="form-control m-input"
                           name="contact_phone2" value="{{ old('contact_phone2', optional($contactInfo)->phone2) }}">
                    @if ($errors->has('contact_phone2'))
                        <span class="form-control-feedback">{{ $errors->first('contact_phone2') }}</span>
                    @endif
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-12">
                <div class="form-group m-form__group{{ $errors->has('contact_reward') ? ' has-danger' : '' }}">
                    <label>Reward Offered*</label>
                    <div class="m-radio-inline">
                        <label class="m-radio m-radio--solid">
                            <input type="radio" name="contact_reward" value="1" checked required> Yes
                            <span></span>
                        </label>
                        <label class="m-radio m-radio--solid">
                            <input type="radio" name="contact_reward" value="0" required> No
                            <span></span>
                        </label>
                    </div>
                    @if ($errors->has('contact_reward'))
                        <span class="form-control-feedback">{{ $errors->first('contact_reward') }}</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="form-group m-form__group mb-0{{ $errors->has('contact_message') ? ' has-danger' : '' }}">
                    <label for="contact-message">Message</label>
                    <textarea id="contact-message" class="form-control m-input" name="contact_message" rows="8"
                              placeholder="Custom message to display to person that finds phone.">{{ old('contact_message', optional($contactInfo)->message) }}</textarea>
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