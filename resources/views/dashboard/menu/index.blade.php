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
                                    <th>Nth Weekly Menu </th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($menus->count())
                                    @foreach($menus as $menu)
                                        <tr>
                                        
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $menu->serving_at }}</td>
                                            <td>{{ (new DateTime($menu->name))->format("W") }}</td>
                                            <td width="20%">

                                                <div class="col-md-6">
                                                    
                                                <a href="#" class="btn btn-sm
                                        btn-default">
                                                    <i class="fa fa-eye"></i> View
                                                </a>
                                                   
                                                </div>

                                                <div class="col-md-6">
                                                    <a href="#" class="btn btn-sm
                                        btn-default">
                                                    <i class="fa fa-trash"></i> Delete
                                                </a>    
                                                </div>
                                                
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
