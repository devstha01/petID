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
        <li class="m-nav__separator">-</li>
        <li class="m-nav__item">
            <a href="{{ route('admin.subscribers.pets',$id) }}" class="m-nav__link">
                <span class="m-nav__link-text">Pets</span>
            </a>
        </li>
    </ul>
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        @include('flash::message')
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">All Pets</h3>
                </div>
            </div>
        </div>

        <div class="m-portlet__body">
            <table class="table table-striped- table-bordered">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Pet Code</th>
                    <th>Gender</th>
                    <th>Color</th>
                    <th>Breed</th>
                    <th>Image1</th>
                    <th>Image2</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pets as $pet)
                    <tr>
                        <td>{{ $pet->id }}</td>
                        <td>{{ $pet->name }}</td>
                        <td>{{ $pet->pet_code }}</td>
                        <td>{{ $pet->gender }}</td>
                        <td>{{ $pet->color }}</td>
                        <td>{{ $pet->breed }}</td>
                        <td> 
                            <img src="{{ url('pet/'.$pet->image1) }}" alt="" width="100px"/> 
                        </td>
                        <td> 
                            <img src="{{ url('pet/'.$pet->image2) }}" alt="" width="100px" /> 
                        </td>
                        <td>{{ $pet->created_at }}</td>
                        <td>
                            <a type="button" href="{{ route('admin.subscribers.order-tag', $pet->id) }}">Order Tag</a>
                        </td>                       
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
