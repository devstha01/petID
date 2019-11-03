@extends('admin.layouts.app')

@section('title', 'Influencers')

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
            <a href="{{ route('admin.influencer.index') }}" class="m-nav__link">
                <span class="m-nav__link-text">Influencer</span>
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
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Birthday</th>
                    <th>Address</th>
                    <th>Created At</th>
                </tr>
                </thead>
                <tbody>
                @foreach($influencers as $key=>$inf)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$inf->first_name}}</td>
                        <td>{{$inf->last_name}}</td>
                        <td>{{$inf->email}}</td>
                        <td>{{$inf->birthday}}</td>
                        <td>{{$inf->city}} | {{$inf->street}} </td>
                        <td>{{Carbon\Carbon::parse($inf->created_at)->diffForHumans()}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{$inf->facebook_url}} |</td>
                        <td>{{$inf->twitter_url}} | {{$inf->twitter_followers}}</td>
                        <td>{{$inf->instagram_url}} | {{$inf->instagram_followers}}</td>
                        <td>{{$inf->tiktok_url}} | {{$inf->tiktok_followers}}</td>
                        <td>{{$inf->website_url}} | {{$inf->website_visitors}}</td>
                        <td><a href="{{route('admin.influencer.edit',$inf->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

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
