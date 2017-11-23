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

                        <form action="{{ $action ?? route('meals.store') }}" method="post">
                            {{ csrf_field() }}
                            @if($meal->exists)
                                <input type="hidden" value="put" name="_method">
                            @endif
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name" class="form-label">Name</label>
                                <input autofocus class="form-control" name="name" id="name"
                                       value="{{ old('name', $meal->name) }}" placeholder="Name of meal">
                                @if($errors->has("name"))
                                    <span class="help-block">{{ $errors->first("name") }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('meal_items') ? 'has-error' : '' }}">
                                <label for="meal-items" class="form-label">Meal Items</label>
                                <select name="meal_items[]" id="meal-items" class="form-control" multiple>
                                    @if($items->count())
                                        @foreach($items as $item)
                                            @if(in_array($item->id, old('meal_items', $meal->items()->pluck('items.id')->toArray())))
                                                <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                                @if($errors->has("meal_items"))
                                    <span class="help-block">{{ $errors->first("meal_items") }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="6"
                                          placeholder="Describe this meal">{{ old('description', $meal->description) }}</textarea>
                                @if($errors->has("description"))
                                    <span class="help-block">{{ $errors->first("description") }}</span>
                                @endif
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
@push('more_scripts')
    <script>
        $("#meal-items").select2({
            placeholder: 'Select the items that make up this meal'
        })
    </script>
@endpush
