@extends('front.layouts.app')

@section('title', 'Sales By Code')

@section('content')
<section class="section section-ptb pb-200">
    <div class="container">
        <div class="row">
            <div class="m-portlet__body">
                <table class="table table-striped- table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name | Email</th>
                        <th>Ordered At</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                    @foreach($orders as $key=>$order)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$order->user->name??''}} <br> {{$order->user->email??''}}</td>
                            <td>{{$order->created_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>

@endsection