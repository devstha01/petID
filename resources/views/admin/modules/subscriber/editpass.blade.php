@extends('admin.layouts.app')

@section('title', 'Subscribers')

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
    <div class="m-portlet m-portlet--mobile">
        @include('flash::message')

        <div class="m-portlet__body">

            @if(session('success'))
                <div class="alert alert-success"><i class="fa fa-check-circle"></i> {{session('success')}}</div>
            @endif


            <form method="POST" action="{{route('admin.subscribers.updatepass',$inf->id)}}">

                @csrf

                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label>Password</label>

                            <input type="password" class="form-control" name="password"
                                   value=""

                                   placeholder="Password*" required>

                            @if ($errors->has('password'))

                                <span class="help-block">{{ $errors->first('password') }}</span>

                            @endif

                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
                            <label>Confirm Password</label>

                            <input type="password" class="form-control" name="confirm_password"
                                   value=""

                                   placeholder="Confirm Password*" required>

                            @if ($errors->has('confirm_password'))

                                <span class="help-block">{{ $errors->first('confirm_password') }}</span>

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
