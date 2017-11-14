@extends('layouts.app')
@section('title', 'Users')
@section('page-actions')
    <a href="{{ route('auth.users.create') }}" class="btn btn-default"><i class="fa fa-plus"></i> Add User</a>
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
                                    <th>Acc Type</th>
                                    <th>Email</th>
                                    <th>Joined On</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($users->count())
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                            <td>N/A</td>
                                            <td>{{ $user->email }}</td>
                                            <td >{{ $user->created_at->format('d.M.Y')}}</td>
                                                
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
