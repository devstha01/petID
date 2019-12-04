@extends('front.layouts.app')

@section('title', 'Return found phone')

@section('content')
    <section class="section section-ptb pb-200">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="mb-35 text-center">
                        <h2 class="heading-center">Return A Found <span>Pet</span></h2>
                        <p class="heading-text mb-0">Thank you for doing the right thing. Please use the below form
                            to enter the tag code found on the pet's tag.</p>
                    </div>

                    @include('flash::message')

                    <form method="GET" action="{{ route('return-found-pet') }}">
                        <div class="input-group input-group-return-found-phone">
                            <input type="text" class="form-control" name="phone_code"
                                   value="{{ old('phone_code', $phoneCode) }}" placeholder="Enter Tag Code*">
                            <span class="input-group-btn">
                                <button type="submit"
                                        class="btn btn-default btn-style hvr-bounce-to-right">Submit</button>
                            </span>
                        </div>
                    </form>

                    @if($contactInfo)
                        <h3 style="margin-top: 20px; margin-bottom: 15px; font-size: 18px;">Contact Information</h3>
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td>Name</td>
                                <td>{{ $contactInfo->name }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $contactInfo->email }}</td>
                            </tr>
                            <tr>
                                <td>Secondary Phone Number 1</td>
                                <td>{{ $contactInfo->phone1 }}</td>
                            </tr>
                            <tr>
                                <td>Secondary Phone Number 2</td>
                                <td>{{ $contactInfo->phone2 ? $contactInfo->phone2 : '-' }}</td>
                            </tr>
                            <tr>
                                <td>Secondary Phone Number 3</td>
                                <td>{{ $contactInfo->phone3 ? $contactInfo->phone3 : '-' }}</td>
                            </tr>
                            <tr>
                                <td>Secondary Phone Number 4</td>
                                <td>{{ $contactInfo->phone4 ? $contactInfo->phone4 : '-' }}</td>
                            </tr>
                            <tr>
                                <td>Reward Offered</td>
                                <td>{{ $contactInfo->reward == 1 ? 'Yes' : 'No' }}</td>
                            </tr>
                            <tr>
                                <td>Message</td>
                                <td>{{ $contactInfo->message ? $contactInfo->message : '-' }}</td>
                            </tr>
                            </tbody>
                        </table>
                    @else
                        
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
