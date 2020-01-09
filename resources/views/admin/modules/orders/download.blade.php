@extends('admin.layouts.app')

@section('title', 'Download Tags Template')

@push('styles')

@endpush

@section('breadcrumb')
    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
        <li class="m-nav__item m-nav__item--home">
            <a href="{{ route('admin.dashboard') }}" class="m-nav__link m-nav__link--icon">
                <i class="m-nav__link-icon la la-home"></i>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        @include('flash::message')

        <div class="m-portlet__body">
            <div class="row" align="center">
                <h3>Download BackPdf</h3>
            </div>
            <form action="{{ url('download_backpdf') }}" method="GET">
                <div class="row">
                
                    <div class="col-sm-4">
                        <div class="form-group">
                            <input type="date" class="form-control" name="date" style="height:39px" placeholder="Select Date" required />
                        </div>
                    </div>
                    <div class="col-sm-4" align="left">
                        <button type="submit" class="btn btn-success">Download</button>
                    </div>
                
                </div>
            </form>
            <div class="row" align="center">
                <h3>Download FrontPdf</h3>
            </div>
            <form action="{{ url('download_frontpdf') }}" method="GET">
                <div class="row">
                
                    <div class="col-sm-4">
                        <div class="form-group">
                            <input type="date" class="form-control" name="date" style="height:39px" placeholder="Select Date" required />
                        </div>
                    </div>
                    <div class="col-sm-4" align="left">
                        <button type="submit" class="btn btn-success">Download</button>
                    </div>
                
                </div>

        </div>
    </div>
@endsection

