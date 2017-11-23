@extends('layouts.app')
@section('title', 'Items')
@section('page-actions')
    <a href="{{ route('items.create') }}" class="btn btn-default"><i class="fa fa-plus"></i> Add item</a>
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
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($items->count())
                                    @foreach($items as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td width="100px">
                                                <a href="{{ route('items.edit', compact('item')) }}" class="btn btn-sm
                                        btn-primary col-sm-12">
                                                    <i class="fa fa-edit"></i> edit
                                                </a>
                                                {{--<a href="{{ route('items.edit', compact('item')) }}"--}}
                                                   {{--class="btn btn-sm btn-default col-sm-12">--}}
                                                    {{--<i class="fa fa-copy"></i>--}}
                                                {{--</a>--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="text-center">
                                        <td colspan="6">No meal item has been added yet</td>
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
