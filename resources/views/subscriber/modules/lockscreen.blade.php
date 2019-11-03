@extends('front.layouts.app')

@section('title', 'My Lockscreen')

@section('content')
    <section class="section section-dashboard">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('subscriber.partials.sidebar')
                </div>
                <div class="col-md-9">
                    <div class="panel panel-default panel-contact-info mb-0">
                        <div class="panel-heading">My Lockscreen</div>

                        <div class="panel-body">
                            @if(is_null($contactInfo))
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="alert alert-danger mb-0">Please update the recovery information to
                                            view lockscreen preview.
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-6">
                                        @include('flash::message')

                                        <form method="POST" action="{{ route('subscriber.lockscreen.store') }}"
                                              id="form-lockscreen-info">
                                            @csrf

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group{{ $errors->has('device') ? ' has-error' : '' }}">
                                                        <label for="device">{{ __('Device*') }}</label>

                                                        <select id="device" class="form-control" name="device"
                                                                required>
                                                            <option value="">Select Device*</option>
                                                            @foreach($devices as $device)
                                                                <option value="{{ $device }}" {{ !is_null($lockscreenInfo) && $lockscreenInfo->device == $device ? 'selected' : '' }}>{{ ucfirst($device) }}</option>
                                                            @endforeach
                                                        </select>

                                                        @if ($errors->has('device'))
                                                            <span class="help-block">{{ $errors->first('device') }}</span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group radio-group">
                                                        <label for="">Lockscreen Color*</label>
                                                        <div class="radio">
                                                            <label><input type="radio" name="lockscreen_color"
                                                                          value="black"
                                                                          {{ !is_null($lockscreenInfo) && $lockscreenInfo->lockscreen_color == 'black' ? 'checked' : '' }} required>Black</label>
                                                        </div>
                                                        <div class="radio">
                                                            <label><input type="radio" name="lockscreen_color"
                                                                          value="white"
                                                                          {{ !is_null($lockscreenInfo) && $lockscreenInfo->lockscreen_color == 'white' ? 'checked' : '' }} required>White</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">													Step 1:
                                                    <button type="submit"
                                                            class="btn btn-default btn-style hvr-bounce-to-right">Update
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="col-md-6">
                                        <br><h3>Lockscreen preview</h3>

                                        @if(!is_null(optional($lockscreenInfo)->lockscreen))
                                            <form method="POST" action="{{ route('subscriber.lockscreen.email') }}"
                                                  class="mb-20">
                                                @csrf
												Step 2: 
                                                <button type="submit"
                                                        class="btn btn-default btn-style hvr-bounce-to-right mr-0">Send
                                                    to email
                                                </button>
                                            </form>

                                            <img src="{{ Storage::url($lockscreenInfo->lockscreen) }}" alt=""
                                                 class="img-responsive{{ $lockscreenInfo->lockscreen_color == 'white' ? ' img-bordered' : '' }}">
                                        @else
                                            <div class="alert alert-danger mb-0">Please update the lockscreen
                                                information to view lockscreen preview.
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
