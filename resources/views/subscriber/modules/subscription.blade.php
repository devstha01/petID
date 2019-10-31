@extends('front.layouts.app')

@section('title', 'Subscription')

@section('content')
    <section class="section section-dashboard">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('subscriber.partials.sidebar')
                </div>
                <div class="col-md-9">
                    <div class="panel panel-default mb-0">
                        <div class="panel-heading">Subscription</div>

                        <div class="panel-body">
                            @if(currentUser()->account_type != 'free')
                                @include('flash::message')

                                <h3 class="mb-0">Membership Type: Monthly $2.99</h3>

                                @if(! currentUser()->subscribed('main'))
                                    {{--This user is not a paying customer...--}}
                                @else
                                    {{--This user is a paying customer...--}}
                                    @if (currentUser()->onTrial('main'))
                                        <p>Trial period ends in {{ currentUser()->trial_end_date }}</p>
                                    @endif

                                    <div class="subscription-actions">
                                        @if(currentUser()->subscription('main')->cancelled())
                                            <form method="POST" action="{{ route('subscriber.subscription.resume') }}">
                                                @csrf
                                                <button type="submit" class="btn btn-default btn-style hvr-bounce-to-right">Resume subscription</button>
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('subscriber.subscription.cancel') }}">
                                                @csrf
                                                <button type="submit" class="btn btn-default btn-style hvr-bounce-to-right">Cancel Subscription</button>
                                            </form>
                                        @endif
                                    </div>
                                @endif
                            @else
                                <h3 class="mb-0">Congratulations you have a free account.</h3>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
