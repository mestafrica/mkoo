@extends('layouts.app')
@section('title', 'Add New User')
@section('page-actions')
<a href="{{ route('auth.users') }}" class="btn btn-default">
    <i class="fa fa-eye"></i> All Users
</a>
<?php
 // dd($user);
  ?>
@endsection
@section('content')
 <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p>Fill the form below to add a user</p>

                        <form action="{{ $action ?? route('auth.users.create') }}" method="post">
                            {{ csrf_field() }}
                            @if($user->exists)
                                <input type="hidden" value="put" name="_method">
                            @endif
                            <div class="form-group @if($errors->has('first_name')) has-error @endif">
                                <label for="first_name" class="form-label">First Name</label>
                                <input autofocus class="form-control" name="first_name" id="first_name" value="{{ $user->first_name }}">
                                @if($errors->has("first_name"))
                                    <span class="help-block">{{ $errors->first("first_name") }}</span>
                                @endif
                            </div>

                            <div class="form-group @if($errors->has('last_name')) has-error @endif">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input autofocus class="form-control" name="last_name" id="last_name" value="{{ $user->last_name }}">
                                 @if($errors->has("last_name"))
                                    <span class="help-block">{{ $errors->first("last_name") }}</span>
                                @endif
                            </div>   

                            <div class="form-group @if($errors->has('email')) has-error @endif">
                                <label for="email" class="form-label">Email</label>
                                <input autofocus class="form-control" type="email" name="email" id="email" value="{{ $user->email }}">
                                @if($errors->has("email"))
                                    <span class="help-block">{{ $errors->first("email") }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <input autofocus type="password" class="form-control" name="password" id="password" value="{{ $user->password }}">
                            </div>

                            <div class="form-group @if($errors->has('password')) has-error @endif">
                                <label for="password" class="form-label">Confirm Password</label>
     
                                <input autofocus type="password" class="form-control" name="password_confirmation" id="password_confirmation" value="{{ $user->password }}" placeholder="Please confirm chosen password">
                                @if($errors->has("password"))
                                    <span class="help-block">{{ $errors->first("password") }}</span>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save"></i> {{ $buttonText ?? 'Add User' }}
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
