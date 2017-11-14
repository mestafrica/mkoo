@extends('layouts.app')
@section('title', 'Create menu for the week')
@section('page-actions')
    <a href="{{ route('menu.index') }}" class="btn btn-default">
        <i class="fa fa-eye"></i> View existing menu
    </a>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <form class="form-horizontal" action="{{ $action ?? route('menu.store') }}" method="post">
                    @foreach(['dummy'] as $date)
                    <div class="panel-heading">Mon Oct 02 2017</div>
                    <div class="panel-body">
                        <div class="row">
                            <h4 class="col-sm-offset-2 col-md-offset-2 col-sm-5 col-md-5">Lunch</h4>
                            <h4 class="col-sm-5 col-md-5">Dinner</h4>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-md-2 control-label">Option 1: </label>
                            <div class="col-sm-5 col-md-5 ">
                                <select class="form-control" name="breakfast">
                                    @foreach($meals as $meal)
                                        <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-5 col-md-5 ">
                                <select class="form-control" name="breakfast">
                                    @foreach($meals as $meal)
                                        <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-md-2 control-label">Option 2: </label>
                            <div class="col-sm-5 col-md-5 ">
                                <select class="form-control" name="breakfast">
                                    @foreach($meals as $meal)
                                        <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-5 col-md-5 ">
                                <select class="form-control" name="breakfast">
                                    @foreach($meals as $meal)
                                        <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-6">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
