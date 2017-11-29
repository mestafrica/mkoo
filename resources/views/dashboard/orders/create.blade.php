@extends('layouts.app')
@section('title', $menu ? 'Meals for the week' : '')
@section('page-actions')
    <a href="{{ route('orders.index') }}" class="btn btn-default">
        <i class="fa fa-plus"></i> View Order
    </a>
@endsection
@section('content')

<div class="container">
    @if($menu)
    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step col-xs-2"> 

                <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                <p><small>Monday</small></p>
            </div>
            <div class="stepwizard-step col-xs-2"> 
                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                <p><small>Tuesday</small></p>
            </div>
            <div class="stepwizard-step col-xs-2"> 
                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                <p><small>Wednesday</small></p>
            </div>
            <div class="stepwizard-step col-xs-2"> 
                <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                <p><small>Thursday</small></p>
            </div>

            <div class="stepwizard-step col-xs-2"> 
                <a href="#step-5" type="button" class="btn btn-default btn-circle" disabled="disabled">5</a>
                <p><small>Friday</small></p>
            </div>

            <div class="stepwizard-step col-xs-2"> 
                <a href="#step-6" type="button" class="btn btn-default btn-circle" disabled="disabled">6</a>
                <p><small>Saturday</small></p>
            </div>
        </div>
    </div>
    
    <form role="form" action="{{route("orders.store")}}" method="post">
        {{csrf_field()}}
        <input type="hidden" value="{{ $menu->id }}" name="menu_id">

        @foreach(get_dates_for_the_week() as $date)
        <div class="panel panel-primary setup-content" id="step-{{ $loop->iteration }}">
            <div class="panel-heading">
               <h3 class="panel-title">{{ \Carbon\Carbon::parse($date)->format('l') }}</h3>
            </div>
           <div class="row">
                <div class="panel-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="control-label text-center" >Lunch</div>
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-10">
                                   <select class="form-control" required name="meals[]">
                                     @foreach($menu->lunch($date) as $meal)
                                     <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                     @endforeach
                                 </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="control-label text-center" >Dinner</div>
                            <div class="row">
                                <div class="col-md-10">
                                   <select class="form-control" required name="meals[]">
                                    @foreach($menu->dinner($date) as $meal)
                                     <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                     @endforeach
                                 </select>
                                </div>
                            </div>
                        </div>
                        @if($loop->last)
                            <button class="btn btn-primary nextBtn pull-right" type="submit">
                                <i class="fa fa-save"></i> Place your Order
                            </button>
                        @else
                            <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </form>
@else
    <div class="row">
        <div style="margin-bottom: 20%"></div>
        <div class="col-md-12 col-md-offset-4">
            <strong class="alert alert-warning text-center">
                Sorry but you cannot select meals at this time.
            </strong>

        </div>
    </div>
@endif
</div>
@endsection
@push('more_scripts')
<script src="{{ asset('js/menu.js') }}" defer></script>
@endpush

