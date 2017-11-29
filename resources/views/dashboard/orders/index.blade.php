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
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Day</th>
                                    <th>Lunch</th>
                                    <th>Dinner</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($meals->count())
                                    @foreach($days as $day)
                                        <tr>
                                        
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ \Carbon\Carbon::parse($day)->format('l') }}</td>
                                            <td>{{ $meals['lunch'][$day]->name}}</td>
                                            <td>
                                               {{ $meals['dinner'][$day]->name}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="text-center">
                                        <td colspan="6">You have no orders yet</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection












