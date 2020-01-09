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
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="{{ route('admin.discount.used',$code) }}" class="m-nav__link">
            <span class="m-nav__link-text">Used By({{ $usedCount }})</span>
            </a>
        </li>
    </ul>
@endsection

@section('content')
        <div class="m-portlet__body">
            <table class="table table-striped- table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Used By</th>
                    <th>Created At</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $key=>$order)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$order->user->name}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>{{Carbon\Carbon::parse($order->created_at)->diffForHumans()}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection

