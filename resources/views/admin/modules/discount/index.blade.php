@extends('admin.layouts.app')

@section('title', 'Discount Codes')

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
            <a href="{{ route('admin.discount.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Discount Codes</span>
            </a>
        </li>
    </ul>
@endsection

@section('content')

    <div class="m-portlet m-portlet--mobile">
        @include('flash::message')
        <div class="m-portlet__body">
        <form method="POST" action="{{ route('admin.discount.create') }}"
        class="m-form m-form--label-align-right">
         @csrf()
         <div class="m-form__section m-form__section--first">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group m-form__group{{ $errors->has('discount_code') ? ' has-danger' : '' }}">
                            <label for="discount_code">Discount_code*</label>
                            <input type="text" id="discount_code" class="form-control m-input"
                                   name="discount_code" value="{{ old('discount_code') }}" required>
                            @if ($errors->has('discount_code'))
                                <span class="form-control-feedback">{{ $errors->first('discount_code') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Generate Discount Code</button>
            </div>
            </div>
        </form>


        <div class="m-portlet__body">
            <table class="table table-striped- table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Created At</th>
                    {{-- <th>Actions</th> --}}
                </tr>
                </thead>
                <tbody>
                @foreach($codes as $key=>$code)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$code->discount_code}}</td>
                        <td>{{Carbon\Carbon::parse($code->created_at)->diffForHumans()}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection

@push('scripts')
    {{-- <script>
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
    </script> --}}
@endpush
