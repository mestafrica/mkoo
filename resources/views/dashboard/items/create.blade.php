@extends('layouts.app')
@section('title', 'Create Meal Item')
@section('page-actions')
    <a href="{{ route('items.index') }}" class="btn btn-default">
        <i class="fa fa-eye"></i> View existing meal items
    </a>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p>Fill the form below to add meal item</p>

                        <form action="{{ $action ?? route('items.store') }}" method="post">
                            {{ csrf_field() }}
                            @if($item->exists)
                                <input type="hidden" value="put" name="_method">
                            @endif
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name" class="form-label">Name</label>
                                <input autofocus class="form-control" name="name" id="name" value="{{ $item->name }}" required>
                                @if($errors->has("name"))
                                    <span class="help-block">{{ $errors->first("name") }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="description"
                                          rows="6">{{ $item->description }}</textarea>
                                @if($errors->has("description"))
                                    <span class="help-block">{{ $errors->first("description") }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save"></i> {{ $buttonText ?? 'Save item' }}
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
