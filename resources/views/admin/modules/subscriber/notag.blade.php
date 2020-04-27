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
            <a href="{{ url('admin/no-tags-purchased-users') }}" class="m-nav__link">
                <span class="m-nav__link-text">No Tags Purchased Users</span>
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
                    <h3 class="m-portlet__head-text">All Subscribers</h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <a href="{{ route('admin.subscribers.create') }}"
                           class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                            <span>
                                <i class="la la-plus"></i>
                                <span>New Record</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="m-portlet__body">
            <table class="table table-striped- table-bordered">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                </tr>
                </thead>
                <tbody>
                @foreach($subscribers as $key=>$subscriber)
                    <tr>
                        <td> {{$key + $subscribers->firstItem()}} </td>
                        <td>{{ $subscriber->name }}</td>
                        <td>{{ $subscriber->email }}</td>
                        <td>{{ $subscriber->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{ $subscribers->links() }}
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