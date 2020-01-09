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
                    <th>Phone</th>
                    {{-- <th>Subscription</th> --}}
                    {{-- <th>Status</th> --}}
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($subscribers as $subscriber)
                    <tr>
                        <td>{{ $subscriber->id }}</td>
                        <td>{{ $subscriber->name }}</td>
                        <td>{{ $subscriber->email }}</td>
                        <td>{{ $subscriber->contactInfo->phone1 }}</td>
                        {{-- <td>
                            @if(currentUser()->subscribed('main'))
                                {{ $user->subscription('main')->onTrial() ? 'Trial' : 'Recurring' }}
                            @else
                                Unsubscribed
                            @endif
                        </td> --}}
                        {{-- <td>
                            <span class="m-badge m-badge--{{ $subscriber->status == 'active' ? 'success' : 'danger' }} m-badge--wide">
                                {{ ucfirst($subscriber->status) }}
                            </span>
                        </td> --}}
                        <td>{{ $subscriber->created_at }}</td>
                        <td>
                        <span class="dropdown">
                            <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"
                               data-toggle="dropdown" aria-expanded="false">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <span class="dropdown-menu dropdown-menu-right" x-placement="bottom-end"
                                  style="position: absolute; will-change: transform; top: 0; left: 0; transform: translate3d(-33px, 26px, 0px);">
                                <a class="dropdown-item" href="{{ route('admin.subscribers.edit', $subscriber->id) }}">
                                    <i class="la la-edit"></i> Edit Details</a>
                                {{-- <a class="dropdown-item" href="#"><i class="la la-cog"></i> Change Password</a> --}}
                                <a class="dropdown-item" href="{{ route('admin.subscribers.pets', $subscriber->id) }}"><i class="la la-cog"></i> View Pets</a>
                              
                                <!--<a class="dropdown-item" href="#"><i class="la la-history"></i> History</a>-->
                            </span>

                   
                        </span>
                            <a href="javascript:void(0);"
                               class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill m-btn-delete"
                               title="Delete">
                                <i class="la la-trash"></i>
                                <form method="POST" action="{{ route('admin.subscribers.destroy', $subscriber->id) }}"
                                      class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </a>
                        </td>
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