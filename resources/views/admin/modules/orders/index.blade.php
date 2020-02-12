@extends('admin.layouts.app')

@section('title', 'Order Tags')

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
            <a href="{{ route('admin.orders.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Order Tags</span>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        @include('flash::message')

        <div class="m-portlet__body">
            <table class="table table-striped- table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Pet ID</th>
                    <th>Total Price</th>
                    <th>Tag Price</th>
                    <th>Discount</th>
                    <th>Shipping Charge</th>
                    <th>Address</th>
                    <th>Created At</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $key=>$order)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$order->user->name??''}} <br> {{$order->user->email??''}}</td>
                        <td>{{$order->pet->pet_code}}</td>
                        <td>{{$order->total_price}}</td>
                        <td>{{$order->tag_price}}</td>
                        <td>{{$order->discount}}</td>
                        <td>{{$order->shipping_charge}}</td>
                        <td>{{$order->address1}} | {{ $order->address2}} <br> {{$order->city}} | {{$order->street}} | {{$order->zip_code}}</td>
                        <td>{{Carbon\Carbon::parse($order->created_at)->diffForHumans()}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection

