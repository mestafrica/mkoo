@extends('layouts.app')
@section('title', 'Meals for the week')
@section('page-actions')
    <a href="{{ route('menu.index') }}" class="btn btn-default"><i class="fa fa-eye"></i> Menu List</a>
@endsection
@section('content')

<div class="container">
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

        <div class="panel panel-primary setup-content" id="step-1">
            <div class="panel-heading">
               <h3 class="panel-title">Monday</h3>
           </div>
           <div class="row">
            <div class="panel-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="control-label text-center" >Lunch</div>
                        <div class="row">
                            <div class="col-md-2">Option-1</div>
                            <div class="col-md-10">
                                {{dd($getItem('monday', 'lunch'))}}
                               <select class="form-control" required name="monday[lunch]">
                                 @foreach($getItem('monday', 'lunch') as $item)
                                 <option value="{{ $item->meal->id }}">{{ $item->meal->name }}</option>
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
                               <select class="form-control" required name="monday[dinner]">
                                 @foreach($meals as $meal)
                                 <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                 </div>
           <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
       </div>

   </div>

</div>

</div>

<div class="panel panel-primary setup-content" id="step-2">
    <div class="panel-heading">
       <h3 class="panel-title">Tuesday</h3>
   </div>
    <div class="row">
            <div class="panel-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="control-label text-center" >Lunch</div>
                        <div class="row">
                            <div class="col-md-2">Option-1</div>
                            <div class="col-md-10">
                               <select class="form-control" required name="tuesday[lunch]">
                                 @foreach($meals as $meal)
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
                               <select class="form-control" required name="tuesday[dinner]">
                                 @foreach($meals as $meal)
                                 <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                 </div> 
           <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
       </div>

   </div>

</div>
</div>

<div class="panel panel-primary setup-content" id="step-3">
    <div class="panel-heading">
       <h3 class="panel-title">Wednesday</h3>
   </div>
     <div class="row">
            <div class="panel-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="control-label text-center" >Lunch</div>
                        <div class="row">
                            <div class="col-md-2">Option-1</div>
                            <div class="col-md-10">
                               <select class="form-control" required name="wednesday[lunch]">
                                 @foreach($meals as $meal)
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
                               <select class="form-control" required name="wednesday[dinner]">
                                 @foreach($meals as $meal)
                                 <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                 </div> 
           <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
       </div>

   </div>

</div>
</div>
<div class="panel panel-primary setup-content" id="step-4">
    <div class="panel-heading">
       <h3 class="panel-title">Thurday</h3>
   </div>
    <div class="row">
            <div class="panel-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="control-label text-center" >Lunch</div>
                        <div class="row">
                            <div class="col-md-2">Option-1</div>
                            <div class="col-md-10">
                               <select class="form-control" required name="thursday[lunch]">
                                 @foreach($meals as $meal)
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
                               <select class="form-control" required name="thursday[dinner]">
                                 @foreach($meals as $meal)
                                 <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                 </div> 
           <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
       </div>

   </div>

</div>
</div>

<div class="panel panel-primary setup-content" id="step-5">
    <div class="panel-heading">
       <h3 class="panel-title">Friday</h3>
   </div>
    <div class="row">
            <div class="panel-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="control-label text-center" >Lunch</div>
                        <div class="row">
                            <div class="col-md-2">Option-1</div>
                            <div class="col-md-10">
                               <select class="form-control" required name="friday[lunch]">
                                 @foreach($meals as $meal)
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
                               <select class="form-control" required name="friday[dinner]">
                                 @foreach($meals as $meal)
                                 <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                 </div> 
           <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
       </div>

   </div>

</div>
</div>

<div class="panel panel-primary setup-content" id="step-6">
    <div class="panel-heading">
       <h3 class="panel-title">Saturday</h3>
   </div>
  <div class="row">
            <div class="panel-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="control-label text-center" >Lunch</div>
                        <div class="row">
                            <div class="col-md-12">
                               <select class="form-control" required name="saturday[lunch]">
                                 @foreach($meals as $meal)
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
                               <select class="form-control" required name="saturday[dinner]">
                                 @foreach($meals as $meal)
                                 <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                 </div>
           <button class="btn btn-primary nextBtn pull-right" type="submit"><i class="fa fa-save"></i> Save Menu</button>
       </div>

   </div>

</div>
</div>
</form>
</div>    
@endsection
<script src="{{ asset('js/menu.js') }}" defer></script>

