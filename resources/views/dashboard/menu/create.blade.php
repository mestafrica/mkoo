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

                <a href="#step-1" id="hlt-step-1" type="button" class="btn btn-success btn-circle">1</a>
                <p><small>Monday</small></p>
            </div>
            <div class="stepwizard-step col-xs-2"> 
                <a href="#step-2" type="button" id="hlt-step-2" class="btn btn-default btn-circle" disabled="disabled">2</a>
                <p><small>Tuesday</small></p>
            </div>
            <div class="stepwizard-step col-xs-2"> 
                <a href="#step-3" type="button" id="hlt-step-3" class="btn btn-default btn-circle" disabled="disabled">3</a>
                <p><small>Wednesday</small></p>
            </div>
            <div class="stepwizard-step col-xs-2"> 
                <a href="#step-4" type="button" id="hlt-step-4" class="btn btn-default btn-circle" disabled="disabled">4</a>
                <p><small>Thursday</small></p>
            </div>

            <div class="stepwizard-step col-xs-2"> 
                <a href="#step-5" type="button" id="hlt-step-5" class="btn btn-default btn-circle" disabled="disabled">5</a>
                <p><small>Friday</small></p>
            </div>

            <div class="stepwizard-step col-xs-2"> 
                <a href="#step-6" type="button" id="hlt-step-6" class="btn btn-default btn-circle" disabled="disabled">6</a>
                <p><small>Saturday</small></p>
            </div>
        </div>
    </div>
    
    <form role="form" action="{{route("menu.store")}}" method="post">
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
                            <div class="col-md-3">Option 1</div>
                            <div class="col-md-9">
                               <select class="form-control" required name="meals[{{$date = $getDate(0)}}][lunch][0]">
                                 @foreach($meals as $meal)
                                 <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                 </div>
                 <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">Option 2</div>
                        <div class="col-md-9">
                           <select class="form-control" required  name="meals[{{$date}}][lunch][1]">
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
                            <div class="col-md-9">
                               <select class="form-control" required name="meals[{{$date}}][dinner][0]">
                                 @foreach($meals as $meal)
                                 <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                 </div>
                 <div class="form-group">
                        <div class="row">
                            <div class="col-md-9">
                               <select class="form-control" required name="meals[{{$date}}][dinner][1]">
                                 @foreach($meals as $meal)
                                 <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                 </div>  
               <button class="btn btn-primary nextBtn pull-right text-center" type="button" style="padding-left: 6%">Next <i class="fa fa-arrow-right"></i></button>
       
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
                            <div class="col-md-3">Option 1</div>
                            <div class="col-md-9">
                               <select class="form-control" required name="meals[{{$date = $getDate(1)}}][lunch][0]">
                                 @foreach($meals as $meal)
                                 <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                 </div>
                 <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">Option 2</div>
                        <div class="col-md-9">
                           <select class="form-control" required name="meals[{{$date}}][lunch][1]">
                             @foreach($meals as $meal)
                             <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                             @endforeach
                         </select>
                     </div>
                 </div>
             </div>

             <button href="#step-1" type="button" class="btn btn-primary prevBtn hidden-sm hidden-xs "><i class="fa fa-arrow-left"></i> Previous</button>
            
         </div>


         <div class="col-md-6">
          <div class="form-group">
                        <div class="control-label text-center" >Dinner</div>
                        <div class="row">
                            <div class="col-md-9">
                               <select class="form-control" required name="meals[{{$date}}][dinner][0]">
                                 @foreach($meals as $meal)
                                 <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                 @endforeach
                             </select>

                         </div>
                     </div>
                 </div>
                 <div class="form-group">
                        <div class="row">
                            <div class="col-md-9">
                               <select class="form-control" required name="meals[{{$date}}][dinner][1]">
                                 @foreach($meals as $meal)
                                 <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                 </div>  
            
             <button href="#step-1" type="button" class="btn btn-primary prevBtn   hidden-md hidden-lg"><i class="fa fa-arrow-left"></i> Previous</button>
           <button class="btn btn-primary nextBtn pull-right text-center" type="button" style="padding-left: 6%">Next <i class="fa fa-arrow-right"></i></button>
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
                            <div class="col-md-3">Option 1</div>
                            <div class="col-md-9">
                               <select class="form-control" required name="meals[{{$date = $getDate(2)}}][lunch][0]">
                                 @foreach($meals as $meal)
                                 <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                 </div>
                 <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">Option 2</div>
                        <div class="col-md-9">
                           <select class="form-control" required  name="meals[{{$date}}][lunch][1]">
                             @foreach($meals as $meal)
                             <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                             @endforeach
                         </select>
                     </div>
                 </div>

             </div>
             <button href="#step-2" type="button" class="btn btn-primary prevBtn hidden-sm hidden-xs "><i class="fa fa-arrow-left"></i> Previous</button>
         
         </div>


         <div class="col-md-6">
          <div class="form-group">
                        <div class="control-label text-center" >Dinner</div>
                        <div class="row">
                            <div class="col-md-9">
                               <select class="form-control" required name="meals[{{$date}}][dinner][0]">
                                 @foreach($meals as $meal)
                                 <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                 </div>
                 <div class="form-group">
                        <div class="row">
                            <div class="col-md-9">
                               <select class="form-control" required name="meals[{{$date}}][dinner][1]">
                                 @foreach($meals as $meal)
                                 <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                 </div>  
             <button href="#step-2" type="button" class="btn btn-primary prevBtn   hidden-md hidden-lg"><i class="fa fa-arrow-left"></i> Previous</button>

              <button class="btn btn-primary nextBtn pull-right text-center" type="button" style="padding-left: 6%">Next <i class="fa fa-arrow-right"></i></button>
       
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
                            <div class="col-md-3">Option 1</div>
                            <div class="col-md-9">
                               <select class="form-control" required name="meals[{{$date = $getDate(3)}}][lunch][0]">
                                 @foreach($meals as $meal)
                                 <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                 </div>
                 <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">Option 2</div>
                        <div class="col-md-9">
                           <select class="form-control" required  name="meals[{{$date}}][lunch][1]">
                             @foreach($meals as $meal)
                             <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                             @endforeach
                         </select>
                     </div>
                 </div>

             </div>
                 <button href="#step-3" type="button" class="btn btn-primary prevBtn hidden-sm hidden-xs "><i class="fa fa-arrow-left"></i> Previous</button>
         
         </div>


         <div class="col-md-6">
          <div class="form-group">
                        <div class="control-label text-center" >Dinner</div>
                        <div class="row">
                            <div class="col-md-9">
                               <select class="form-control" required name="meals[{{$date}}][dinner][0]">
                                 @foreach($meals as $meal)
                                 <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                 </div>
                 <div class="form-group">
                        <div class="row">
                            <div class="col-md-9">
                               <select class="form-control" required name="meals[{{$date}}][dinner][1]">
                                 @foreach($meals as $meal)
                                 <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                 </div>  
             <button href="#step-3" type="button" class="btn btn-primary prevBtn   hidden-md hidden-lg"><i class="fa fa-arrow-left"></i> Previous</button>

              <button class="btn btn-primary nextBtn pull-right text-center" type="button" style="padding-left: 6%">Next <i class="fa fa-arrow-right"></i></button>
       
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
                            <div class="col-md-3">Option 1</div>
                            <div class="col-md-9">
                               <select class="form-control" required name="meals[{{$date = $getDate(4)}}][lunch][0]">
                                 @foreach($meals as $meal)
                                 <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                 </div>
                 <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">Option 2</div>
                        <div class="col-md-9">
                           <select class="form-control" required  name="meals[{{$date}}][lunch][1]">
                             @foreach($meals as $meal)
                             <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                             @endforeach
                         </select>
                     </div>
                 </div>

             </div>
                 <button href="#step-4" type="button" class="btn btn-primary prevBtn hidden-sm hidden-xs "><i class="fa fa-arrow-left"></i> Previous</button>
         
         </div>


         <div class="col-md-6">
          <div class="form-group">
                        <div class="control-label text-center" >Dinner</div>
                        <div class="row">
                            <div class="col-md-9">
                               <select class="form-control" required name="meals[{{$date}}][dinner][0]">
                                 @foreach($meals as $meal)
                                 <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                 </div>
                 <div class="form-group">
                        <div class="row">
                            <div class="col-md-9">
                               <select class="form-control" required name="meals[{{$date}}][dinner][1]">
                                 @foreach($meals as $meal)
                                 <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                 </div>  
             <button href="#step-4" type="button" class="btn btn-primary prevBtn   hidden-md hidden-lg"><i class="fa fa-arrow-left"></i> Previous</button>

              <button class="btn btn-primary nextBtn pull-right text-center" type="button" style="padding-left: 6%">Next <i class="fa fa-arrow-right"></i></button>
       
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
                            <div class="col-md-3">Option 1</div>
                            <div class="col-md-9">
                               <select class="form-control" required name="meals[{{$date = $getDate(5)}}][lunch][0]">
                                 @foreach($meals as $meal)
                                 <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                 </div>
                 <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">Option 2</div>
                        <div class="col-md-9">
                           <select class="form-control" required  name="meals[{{$date}}][lunch][1]">
                             @foreach($meals as $meal)
                             <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                             @endforeach
                         </select>
                     </div>
                 </div>

             </div>
                 <button href="#step-5" type="button" class="btn btn-primary prevBtn hidden-sm hidden-xs "><i class="fa fa-arrow-left"></i> Previous</button>
         
         </div>


         <div class="col-md-6">
          <div class="form-group">
                        <div class="control-label text-center" >Dinner</div>
                        <div class="row">
                            <div class="col-md-9">
                               <select class="form-control" required name="meals[{{$date}}][dinner][0]">
                                 @foreach($meals as $meal)
                                 <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                 </div>
                 <div class="form-group">
                        <div class="row">
                            <div class="col-md-9">
                               <select class="form-control" required name="meals[{{$date}}][dinner][1]">
                                 @foreach($meals as $meal)
                                 <option value="{{ $meal->id }}">{{ $meal->name }}</option>
                                 @endforeach
                             </select>
                         </div>
                     </div>
                 </div>  
             <button href="#step-5" type="button" class="btn btn-primary prevBtn   hidden-md hidden-lg"><i class="fa fa-arrow-left"></i> Previous</button>

           <button class="btn btn-primary  pull-right" type="submit"><i class="fa fa-save"></i> Save Menu</button>
       </div>

   </div>

</div>
</div>
</form>
</div>    
@endsection
<script src="{{ asset('js/menu.js') }}" defer></script>

