@extends('layouts.app')
@section('title', 'Create menu for the week')
@section('page-actions')
    <a href="{{ route('menu.index') }}" class="btn btn-default"><i class="fa fa-eye"></i> View existing menu</a>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Mon Oct 02 2017</div>
                    <div class="panel-body">
                        <form class="form-horizontal">
                            <div class="row">
                                <h4 class="col-sm-offset-2 col-md-offset-2 col-sm-5 col-md-5">Lunch</h4>
                                <h4 class="col-sm-5 col-md-5">Dinner</h4>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-md-2 control-label">Option 1: </label>
                                <div class="col-sm-5 col-md-5 ">
                                    <select class="form-control" name="breakfast">
                                    </select>
                                </div>
                                <div class="col-sm-5 col-md-5 ">
                                    <select class="form-control" name="breakfast">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-md-2 control-label">Option 2: </label>
                                <div class="col-sm-5 col-md-5 ">
                                    <select class="form-control" name="breakfast">
                                    </select>
                                </div>
                                <div class="col-sm-5 col-md-5 ">
                                    <select class="form-control" name="breakfast">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form action="{{ $action ?? route('menu.store') }}" method="post">
                            <div class="form-group">
                                <label for="date-range">Dates</label>
                                <input type="text" class="form-control" name="date">
                            </div>

                            <div class="form-group">
                                <label for="meals" class="control-label">Meals</label>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
