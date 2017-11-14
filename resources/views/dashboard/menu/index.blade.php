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
                                    <th>Meals</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($menus->count())
                                    @foreach($menus as $menu)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $menu->name }}</td>
                                            <td>{{ $menu->description }}</td>
                                            <td width="100px">
                                                <a href="{{ route('menus.edit', compact('menu')) }}" class="btn btn-sm
                                        btn-default">
                                                    <i class="fa fa-edit"></i> edit
                                                </a>
                                                <a href="{{ route('menus.duplicate', compact('menu')) }}"
                                                   class="btn btn-sm btn-default">
                                                    <i class="fa fa-copy"></i>
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
