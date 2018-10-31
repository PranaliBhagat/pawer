@extends('adminlte::page')
@section('content')

 {!! Form::open(['action' =>['CategoryController@update',$category-> id],'method'=> 'POST']) !!}
            {{csrf_field()}}  
<div class="container-fluid">
    <div class="pageContent">

        <h3 class="title">Edit Category</h3>
       
        <hr>
        <div class="UserDetails">
            @if(count($errors) > 0)
             @foreach($errors->all() as $error)
                     <div class="alert alert-danger">
                           {{$error}}
                     </div>
              @endforeach
            @endif
            
            <div class="row">
           
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-3">
                         {{Form::label('categoryname', 'Category Name', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                            {{Form::text('categoryname', $category_name, ['class' => 'form-control'])}}
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-md-3">
                         {{Form::label('agegroup', 'Age Group', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                            <!-- {{Form::text('agegroup', $category-> age_group, ['class' => 'form-control'])}} -->

                            <input type="checkbox" id="inlineCheckbox1" name="age_group[]" 
                            value="9-13"  

                             {{ in_array("9-13", $age_group)?"checked":"" }}

                            > 9-13
                            <br/>
                          <input type="checkbox" id="inlineCheckbox2" name="age_group[]" value="14-17"
                            {{ in_array("14-17", $age_group)?"checked":"" }}
                          > 14-17 
                          <br/>
                            <input type="checkbox" id="inlineCheckbox3" name="age_group[]" value="17&above"  {{ in_array("17&above", $age_group)?"checked":"" }} > 17 & above
                        </div>
                    </div>
                      <div class="row">
                        <div class="col-md-3">
                         {{Form::label('color', 'Color', ['class' => 'formLabel'])}}
                        </div>
                        <div id="colorpicker" class=" col-md-9  input-group colorpicker colorpicker-component"> 
                            <input name = "color" type="text" value="{{$color}}" class="form-control" /> 
                             <span class="input-group-addon"><i></i></span>                    
                        </div>
                    </div>
                    <br/>
            {{Form::hidden('_method','PUT')}}

             <div class="row">
                 <div class="col-md-3">
                <button type="submit" class="btn btn-success btn-lg yellowButton">SAVE</button>
              </div>
                <div class="col-md-3">
                <a href ="/category" class="btn btn-danger btn-lg yellowButton" > Cancel </a>
              
              </div>  
            </div>
        </div>
    </div>
</div>
<br/><br/>

<div class ="notification" >
   <h3 class="title">Notification</h3>
        <hr>
        <div>
        <!--  <a href="{{action('NotificationController@create', ['id' => $category->id])}}" class="btn btn-success">New Notification</a> -->
                <a href="  {{ route('notification.create', ['id' => $category->id]) }}" class="btn btn-success">New Notification</a>
                <br/><br/>
                       
        </div>
          <div>

                   <table class="table table-striped table-bordered" cellspacing="0" id="tbnotification"> 
                    <thead> 
                            <tr>
                              <th> Title </th>
                              <th> Category Name </th>
                              <th> Age group   </th>
                               <th> Type   </th>

                                <th>Actions</th>
                                <th></th>
                            </tr>
                    </thead>
                    <tbody> 
             @foreach($notification as $notifications)
                <tr>
                    <td>{{$notifications->title}} </td>
                    <td>{{$notifications->category_name}} </td>
                    <td>{{$notifications->age_group}}</td>
                     <td>{{$notifications->type}}</td>
                    <td>
                        <a href="{{action('NotificationController@edit',$notifications->id)}}" class="btn btn-warning">View</a> &nbsp;
                      </td>
                      <td> 

                          <a href="{{action('CategoryController@destroynotification',$notifications->id)}}" class="btn btn-danger">Delete</a> &nbsp;
                    </td>
                    
                </tr>
                @endforeach
                    </tbody>
                    </table>
                </div>

  </div>
</div>
    {!! Form:: close()!!}

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.1/css/bootstrap-colorpicker.min.css" rel="stylesheet"/>
<script src="../../vendor/adminlte/vendor/jquery/dist/jquery.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.1/js/bootstrap-colorpicker.min.js"></script> 

<script type="text/javascript">
     
 $(document).ready(function ()
   {

    $('#tbnotification').DataTable();
	   
   
   });
 $('.colorpicker').colorpicker();
</script>
  @endsection