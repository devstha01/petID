@extends('admin.layouts.app')

@section('title', 'Profile')

@section('breadcrumb')
    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
        <li class="m-nav__item m-nav__item--home">
            <a href="{{ route('admin.dashboard') }}" class="m-nav__link m-nav__link--icon">
                <i class="m-nav__link-icon la la-home"></i>
            </a>
        </li>
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="#" class="m-nav__link">
                <span class="m-nav__link-text">Profile</span>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">

            <!--begin::Portlet-->
            <div class="m-portlet">
                @include('flash::message')
                <!--begin::Form-->
                <form method="POST" action="{{ route('admin.profile.update') }}"
                      class="m-form m-form--label-align-right">
                    @csrf()
                    @include('admin.modules.profile.form', ['submitButtonText' => 'Update'])
                </form>

                <!--end::Form-->
            </div>
            <!--end::Portlet-->
        </div>
    </div>
@endsection
