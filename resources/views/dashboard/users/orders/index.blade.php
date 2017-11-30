<?php
/**
 * Author: Francis Addai <me@faddai.com>
 * Date: 29/11/2017
 * Time: 3:40 PM
 */
?>
@extends('layouts.app')
@section('title', 'Your Orders')
@section('page-actions')
    @if($isNextWeekMenuAvailable)
    <a href="{{ route('orders.create') }}" class="btn btn-default">
        <i class="fa fa-plus"></i> Create a new Order
    </a>
    @endif
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <h4 class="panel-heading">This Week</h4>
                    <div class="panel-body">
                        @if(!is_null($currentWeekOrder))
                            <p>
                                <a href="{{ route('user.orders.show', ['user' => $user, 'order' => $currentWeekOrder]) }}">
                                    View Order for the week {{ $currentWeekOrder->created_at }}
                                </a>
                            </p>
                        @else
                            <p>Nothing here. I see you're on a hunger strike this week.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <h4 class="panel-heading">Next Week</h4>
                    <div class="panel-body">
                        @if(!is_null($nextWeekOrder))
                            <p>
                                <a href="{{ route('user.orders.show', ['user' => $user, 'order' => $nextWeekOrder]) }}">
                                    View Order for next week {{ $nextWeekOrder->created_at }}
                                </a>
                            </p>
                        @else
                            <p>
                                You haven't placed an order for next week yet.
                                @if($isNextWeekMenuAvailable)
                                    There's a menu available.
                                    <div>
                                        <a href="{{ route('orders.create') }}" class="btn btn-default block">
                                            <i class="fa fa-plus"></i> Create a new Order
                                        </a>
                                    </div>
                                @endif
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
