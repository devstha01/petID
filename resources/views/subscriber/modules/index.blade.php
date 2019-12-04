@extends('front.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <section class="section section-dashboard">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('subscriber.partials.sidebar')
                </div>
                <div class="col-md-9">
                    <div class="panel panel-default mb-0">
                        <div class="panel-heading">Dashboard</div>

                        <div class="panel-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            You are logged in!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
