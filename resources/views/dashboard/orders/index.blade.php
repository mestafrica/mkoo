@extends('layouts.app')
@section('title', 'Orders')
@section('page-actions')
    <a href="{{ route('orders.create') }}" class="btn btn-default">
        <i class="fa fa-plus"></i> Add/Update Order
    </a>
    {{--    <a href="{{ route('menu.create') }}" class="btn btn-default"><i class="fa fa-copy"></i> Duplicate menu</a>--}}
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6 no-padding drop-down-select">
                    <select name="day_of_week">
                        @foreach($daysOfWeek as $day)
                        <option value="">{{ $day }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 card-parent no-padding">
                <div class="col-md-4 m-b">
                    <div class="card-single">
                        <div class="card-img">
                            <img src="{{ asset('img/default-food.jpg') }}" width="100%" alt="">
                        </div>
                        <div class="card-info">
                            <h2>Breakfast</h2>
                            <p>Fried rice and chicken</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 m-b">
                    <div class="card-single">
                        <div class="card-img">
                            <img src="{{ asset('img/default-food.jpg') }}" width="100%" alt="">
                        </div>
                        <div class="card-info">
                            <h2>Lunch</h2>
                            <p>Fried rice and chicken</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-single">
                        <div class="card-img">
                            <img src="{{ asset('img/default-food.jpg') }}" width="100%" alt="">
                        </div>
                        <div class="card-info">
                            <h2>Dinner</h2>
                            <p>Fried rice and chicken</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-offset-6 col-sm-offset-2">
                <div>
                    <a href="#" class="btn btn-primary">View all for the week</a>
                </div>
            </div>
        </div>
    </div>
    @push('more_styles')
        <style>
            .m-b { margin-bottom: 10px }
        </style>
    @endpush
@endsection











