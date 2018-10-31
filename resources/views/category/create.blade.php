@extends('adminlte::page')

@section('title', 'Category | Pawer')


@section('content_header')

   
    
@stop
@section('content')



<div class="container-fluid">
    <div class="pageContent">
        <div class="addcategory">
            <h3 class="title">Add Category </h3>
            @if(count($errors) > 0)
             @foreach($errors->all() as $error)
                     <div class="alert alert-danger">
                           {{$error}}
                     </div>
              @endforeach
            @endif
            {!! Form::open(['action' =>['CategoryController@store'],'method'=> 'POST']) !!}
            {{csrf_field()}} 
             
                    <div class="row">
                        <div class="col-md-3">
                            {{Form::label('category_name', 'Category Name', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                            {{Form::text('category_name','', ['class' => 'form-control'])}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            {{Form::label('age_group', 'Age group.', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                          <!--   {{Form::text('age_group','' , ['class' => 'form-control'])}} -->

                          <input type="checkbox" id="inlineCheckbox1" name="age_group[]" value="9-13"> 9-13
                          <br/>
                          <input type="checkbox" id="inlineCheckbox2" name="age_group[]" value="14-17"> 14-17
                          <br/>
                            <input type="checkbox" id="inlineCheckbox3" name="age_group[]" value="17&above"> 17 & above
                        </div>
                    </div>
                   <!--  <div class="row">
                        <div class="col-md-3">
                            {{Form::label('color', 'Select Color ', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                            {{Form::text('color', '', ['class' => 'form-control'])}}
                        </div>
                    </div> -->
                  <!--   <div class="row">
                        <div class="col-md-3">
                            {{Form::label('color', 'Select Color ', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                            {{Form::text('color', '', ['class' => 'colorPicker'])}}
                        </div>
                    </div> -->
                <!-- <div class="row">
                         <div class="col-md-3">
                            {{Form::label('color', 'Select Color ', ['class' => 'formLabel'])}}
                        </div>
                        <div id="cp2" class=" col-md-9 input-group colorpicker colorpicker-component">  <input id= "color" name="color" type="text"   value="#38bc2f" class="form-control" /> 
                          <span class="input-group-addon"><i></i></span> 
                        </div>
                 </div> -->

                 <div class="row">
                         <div class="col-md-3">
                            {{Form::label('color', 'Select Color ', ['class' => 'formLabel'])}}
                        </div>
                        <div id="cp2" class=" col-md-9  input-group colorpicker colorpicker-component"> 
                            <input name = "color" type="text" value="#00AABB" class="form-control" /> 
                             <span class="input-group-addon"><i></i></span>                    
                        </div>
                 </div>
      
        <div class="centerButton">
            <button type="submit" class="btn btn-warning btn-lg yellowButton"> Add </button>
        </div>
       
    </div>
    {!! Form::close() !!}

</div>
</div>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.1/css/bootstrap-colorpicker.min.css" rel="stylesheet">
<script src="/vendor/adminlte/vendor/jquery/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.1/js/bootstrap-colorpicker.min.js"></script> 
<script type="text/javascript" >
         $('.colorpicker').colorpicker();
  </script>

 @endsection

