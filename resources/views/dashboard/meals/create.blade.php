@extends('layouts.app')
@section('title', $title ?? 'Add new meal')
@section('page-actions')
    <a href="{{ route('meals.index') }}" class="btn btn-default"><i class="fa fa-eye"></i> View all meals</a>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p>Fill the form below to add a meal</p>

                        <form action="{{ $action ?? route('meals.store') }}" class="form">
                            {{ csrf_field() }}
                            @if($meal->exists())
                                <input type="hidden" value="put" name="_method">
                            @endif
                            <div class="form-group">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $meal->name }}">
                            </div>

                            <div class="form-group">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="description"
                                          rows="6">{{ $meal->description }}</textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save"></i> {{ $buttonText ?? 'Save meal' }}
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
