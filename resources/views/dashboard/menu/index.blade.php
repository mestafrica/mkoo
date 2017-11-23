@extends('layouts.app')
@section('title', 'Menu')
@section('page-actions')
    <a href="{{ route('menu.create') }}" class="btn btn-default"><i class="fa fa-plus"></i> Add menu</a>
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
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($menus->count())
                                    @foreach($menus as $menu)
                                        <tr>
                                        
                                            <td>{{$index =  $loop->iteration }}</td>
                                            <td>{{$menu->serving_at}} - {{\Carbon\  Carbon::parse($menu->serving_at)->addDays(5)->toDateString() }}</td>
                                            <td><span class="badge">{{($index == 1)?' Active':'InActive'}}</span></td>
                                            <td width="20%">                    
                                                    <a href="#" class="btn btn-sm
                                        btn-default">
                                                    <i class="fa fa-trash"></i> Delete
                                                </a>    
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="text-center">
                                        <td colspan="6">No menu has been added yet</td>
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
