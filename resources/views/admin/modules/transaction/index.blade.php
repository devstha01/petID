@extends('admin.layouts.app')

@section('title', 'Transactions')

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
                <span class="m-nav__link-text">Transactions</span>
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
                    <th>Subscriber</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
                </thead>
                <tbody>
                @foreach($charges['data'] as $charge)
                    {{--@foreach($charges->autoPagingIterator() as $charge)--}}
                    {{--@php(dump($charge))--}}
                    <tr>
                        <td>{{ optional(subscriberByCustomerId($charge->customer))->id }}</td>
                        <td>
                            <a href="#">
                                {{ optional(subscriberByCustomerId($charge->customer))->full_name }}
                            </a>
                        </td>
                        <td>${{ centToDollar($charge->amount) }}</td>
                        <td>{{ ucfirst($charge->status) }}</td>
                        <td>{{ \Carbon\Carbon::createFromTimestamp($charge->created)->format('m/d/Y \a\t g:i A') }}</td>
                        {{--<td>{{ gmdate("Y-m-d\TH:i:s\Z", $charge->created) }}</td>--}}
                    </tr>
                @endforeach
                </tbody>
            </table>

            {{--<div class="count-transactions">--}}
            {{--{{ count($charges['data']) }} results--}}
            {{--</div>--}}
            @if($charges->has_more)
                <ul class="pagination" role="navigation">
                    @if($charges->has_more)
                        @php($lastCharge = array_last($charges['data']))
                        <li class="page-item">
                            <a class="page-link"
                               href="{{ route('admin.transactions.index') . '?starting_after=' . $lastCharge->id }}"
                               rel="next" aria-label="Next »">Next ›</a>
                        </li>
                    @else
                        {{--@php($firstCharge = array_first($charges['data']))--}}
                        {{--<li class="page-item">--}}
                            {{--<a class="page-link"--}}
                               {{--href="{{ route('admin.transactions.index') . '?ending_before=' . $firstCharge->id }}"--}}
                               {{--rel="previous" aria-label="Previous »">‹ Prev</a>--}}
                        {{--</li>--}}
                    @endif
                </ul>
            @endif
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
