<?php
/**
 * Author: Francis Addai <me@faddai.com>
 * Date: 29/11/2017
 * Time: 3:40 PM
 */
?>
@extends('layouts.app')
@section('title', 'Order Details')
@section('page-actions')
    <a href="{{ route('user.orders', ['user' => auth()->user()]) }}" class="btn btn-default">
        <i class="fa fa-plus"></i> View Your Orders
    </a>
@endsection
@section('content')
    <div class="container">

        @foreach($order as $date => $meals)
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <h4 class="panel-heading">
                        {{ sprintf('%s', $date ? \Carbon\Carbon::parse($date)->format('l, M d') : 'N/A') }}
                    </h4>
                    <div class="panel-body">
                        @if(count($meals))
                            @foreach($meals as $meal)
                            <div class="card-parent">
                                <div class="col-md-6 m-b">
                                    <div class="card-single">
                                        <div class="card-img">
                                            <img src="{{ asset($meal->image ?? 'img/default-food.jpg') }}" width="100%"
                                                 alt="{{ $meal->name }}">
                                        </div>
                                        <div class="card-info">
                                            <h5><strong>{{ ucfirst($meal->pivot->type) }}</strong></h5>
                                            <p>{{ $meal->name }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            Nothing here. I see you're on a hunger strike this week.
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
@endsection
