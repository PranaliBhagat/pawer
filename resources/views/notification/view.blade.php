@extends('adminlte::page')
@section('content')



<div class="container-fluid">
    <div class="pageContent">
        <div class="addnotification">
            <h3 class="title"> Notification </h3>
            {!! Form::open(['action'=>['CategoryController@edit',$notification->category_id],'method'=> 'POST']) !!}
            {{csrf_field()}}  
             
                    <div class="row">
                        <div class="col-md-3">
                            {{Form::label('category_name', 'Category', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-5">
                            {{Form::text('category_name',$notification->category_name, ['class' => 'form-control', 'readonly' => 'true'])}}
                         
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-3">
                            {{Form::label('age_group', 'Age Group', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                            {{Form::text('age_group',$notification->age_group , ['class' => 'form-control','readonly' => 'true'])}}

                         
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-3">
                            {{Form::label('type', 'Notification Type', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                             {{Form::text('type',$notification->type , ['class' => 'form-control','readonly' => 'true'])}} 
                        </div>
                     </div>

                    <br/>

                       <div class="row">
                       <div class="col-md-3">
                            {{Form::label('normaltitle', 'Notification Title', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                               {{Form::text('normaltitle',$notification->title, ['class' => 'form-control','readonly' => 'true'])}}
                        </div>
                     </div>
                     <br/>
                      <div class="row">
                        <div class="col-md-3">
                            {{Form::label('normalmessage', 'Notification Message', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                               {{Form::textarea('normalmessage',$notification->message, ['class' => 'form-control','readonly' => 'true'])}}
                        </div>
                     </div>
                      <br/>
                      <div id= "divnormal" class="row" style="display:none" >
                        <div class="col-md-3">
                            {{Form::label('image', 'Image Uploaded', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9 form-control">
                      <img class="img-responsive" src="{{env('APP_URL').'storage/app/'.$notification->image}}" width="200px" alt="Image">
                        </div>

                     </div>
                      <br/>
                       <div id= "divurl"  style="display:none" >
                         <div class="row">
                             <div class="col-md-3">
                             {{Form::label('url', 'URL', ['class' => 'formLabel'])}}
                         </div>
                         <div class="col-md-9">
                             {{Form::text('url',$notification->url, ['class' => 'form-control','readonly' => 'true'])}}
                         </div>
                        </div>
                     </div>
                       
                     
               

                 <hr>

                 <div class= "questionaire" >
                    <h3 class="title"> Questionnaire </h3>
                    <div class="row">
                        <div class="col-md-3">
                            {{Form::label('question', 'Question', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                               {{Form::text('question',$notification->question, ['class' => 'form-control','readonly' => 'true'])}}
                        </div>
                     </div>
                     <br/>

                      <div class="row">
                        <div class="col-md-3">
                            {{Form::label('option1', 'Option 1', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                               {{Form::text('option1',$notification->option1, ['class' => 'form-control','readonly' => 'true'])}}
                        </div>
                     </div>
                     <br/>

                      <div class="row">
                        <div class="col-md-3">
                            {{Form::label('option2', 'Option 2', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                               {{Form::text('option2',$notification->option2, ['class' => 'form-control','readonly' => 'true'])}}
                        </div>
                     </div>
                     <br/>

                       <div class="row">
                        <div class="col-md-3">
                            {{Form::label('option3', 'Option 3', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                               {{Form::text('option3',$notification->option3, ['class' => 'form-control','readonly' => 'true'])}}
                        </div>
                     </div>
                     <br/>
                       <div class="row">
                        <div class="col-md-3">
                            {{Form::label('option4', 'Option 4', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                               {{Form::text('option4',$notification->option4, ['class' => 'form-control','readonly' => 'true'])}}
                        </div>
                     </div>
                       <br/>
                      <div class="row">
                        <div class="col-md-3">
                            {{Form::label('correctoption', 'Correct Option', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                               {{Form::text('correctoption',$notification->correctoption, ['class' => 'form-control','readonly' => 'true'])}}
                        </div>
                     </div>
                      <br/>

                     <div class="row">
                        <div class="col-md-3">
                            {{Form::label('correctpoints', 'Correct Option Points', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                               {{Form::text('correctpoints',$notification->correctpoints, ['class' => 'form-control','readonly' => 'true'])}}
                        </div>
                     </div>
                      <br/>
                      <div class="row">
                        <div class="col-md-3">
                            {{Form::label('wrongpoints', 'Wrong Option Points', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                               {{Form::text('wrongpoints',$notification->wrongpoints, ['class' => 'form-control','readonly' => 'true'])}}
                        </div>
                     </div>

                 </div> 
              <div class="centerButton">
                    <button type="submit" class="btn btn-warning btn-lg yellowButton"> OK </button>
             </div>
   
    {!! Form::close() !!}
     </div>
       
    </div>

</div>
</div>

<script type="text/javascript">
   var type = document.getElementsByName("type"); 
   //console.log(type[0].value);

   if (type[0].value == "URL") {
    document.getElementById('divurl').style.display = "block";
}
else
{
      document.getElementById('divnormal').style.display = "block";
}
</script>
 

 @endsection

