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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Birthday</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($influencers as $key=>$inf)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$inf->user->name??''}}</td>
                        <td>{{$inf->user->email??''}}</td>
                        <td>{{$inf->birthday}}</td>
                        <td>{{$inf->city}} | {{$inf->street}} </td>
                        <td>{{Carbon\Carbon::parse($inf->created_at)->diffForHumans()}}</td>
                        <td>
                            <form action="{{route('admin.influencer.status',$inf->id)}}" method="post">
                                {{csrf_field()}}
                                @if($inf->user->status??'' ==='active')
                                    <button class="btn btn-sm btn-success"><i class="fa fa-check"></i> active</button>
                                @else
                                    <button class="btn btn-sm btn-danger"><i class="fa fa-times"></i> inactive</button>
                                @endif
                            </form>
                        </td>
                        <td colspan="2">
                            <a href="{{route('admin.influencer.edit',$inf->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a>
                            <a href="{{route('admin.influencer.editpass',$inf->id)}}" class="btn btn-info btn-sm"> Password</a>
                        </td>
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
