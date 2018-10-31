@extends('adminlte::page')
@section('content')



<div class="container-fluid">
    <div class="pageContent">
        <div class="addnotification">
            <h3 class="title"> Notification </h3>
            @if(count($errors) > 0)
             @foreach($errors->all() as $error)
                     <div class="alert alert-danger">
                           {{$error}}
                     </div>
              @endforeach
            @endif

            {!! Form::open(['action' =>['NotificationController@store'],'files' =>true,'method'=> 'POST']) !!}
            {{csrf_field()}} 
             
                    <div class="row">
                        <div class="col-md-3">
                            {{Form::label('category_name', 'Category', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                            {{Form::text('category_name',$category_name, ['class' => 'form-control', 'readonly' => 'true'])}}
                         
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-3">
                            {{Form::label('age_group', 'Age Group', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                          <!--   {{Form::text('age_group','' , ['class' => 'form-control'])}} -->

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
                    <br/>
                    <div class="row">
                        <div class="col-md-3">
                            {{Form::label('type', 'Notification Type', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                               <input type="radio" id="inlineradio1" name="type[]" value="url"> Url
                         &nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="radio" id="inlineradio2" name="type[]" value="normal"> Normal
                         
                        </div>
                     </div>

                <div class= "divurl" style="display:none">
                       <div class="row">
                       <div class="col-md-3">
                            {{Form::label('title', 'Notification Title', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                               {{Form::text('title','', ['class' => 'form-control'])}}
                        </div>
                     </div>
                     <br/>
                      <div class="row">
                        <div class="col-md-3">
                            {{Form::label('message', 'Notification Message', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                               {{Form::textarea('message','', ['class' => 'form-control'])}}
                        </div>
                     </div>
                      <br/>
                      <div class="row">
                        <div class="col-md-3">
                            {{Form::label('url', 'URL link', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                               {{Form::text('url','', ['class' => 'form-control'])}}
                        </div>
                     </div>
                     
                 </div>


                  <div class= "divnormal" style="display:none">
                       <div class="row">
                       <div class="col-md-3">
                            {{Form::label('normaltitle', 'Notification Title', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                               {{Form::text('normaltitle','', ['class' => 'form-control'])}}
                        </div>
                     </div>
                     <br/>
                      <div class="row">
                        <div class="col-md-3">
                            {{Form::label('normalmessage', 'Notification Message', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                               {{Form::textarea('normalmessage','', ['class' => 'form-control'])}}
                        </div>
                     </div>
                      <br/>
                      <div class="row">
                        <div class="col-md-3">
                            {{Form::label('image', 'Upload Image', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                               <input type="file" id ="image "name="image" />
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
                               {{Form::text('question','', ['class' => 'form-control'])}}
                        </div>
                     </div>
                     <br/>

                      <div class="row">
                        <div class="col-md-3">
                            {{Form::label('option1', 'Option 1', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                               {{Form::text('option1','', ['class' => 'form-control'])}}
                        </div>
                     </div>
                     <br/>

                      <div class="row">
                        <div class="col-md-3">
                            {{Form::label('option2', 'Option 2', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                               {{Form::text('option2','', ['class' => 'form-control'])}}
                        </div>
                     </div>
                     <br/>

                       <div class="row">
                        <div class="col-md-3">
                            {{Form::label('option3', 'Option 3', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                               {{Form::text('option3','', ['class' => 'form-control'])}}
                        </div>
                     </div>
                     <br/>
                       <div class="row">
                        <div class="col-md-3">
                            {{Form::label('option4', 'Option 4', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                               {{Form::text('option4','', ['class' => 'form-control'])}}
                        </div>
                     </div>
                       <br/>
                      <div class="row">
                        <div class="col-md-3">
                            {{Form::label('correctoption', 'Correct Option', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                               <!-- {{Form::text('correctoption','', ['class' => 'form-control'])}} -->
                               <select name="correctoption" class="form control">
                                 <option value="Option1">Option 1</option>
                                 <option value="Option2">Option 2</option>
                                 <option value="Option3">Option 3</option>
                                 <option value="Option4">Option 4</option>
                            </select>
                      
                        </div>
                     </div>
                      <br/>

                     <div class="row">
                        <div class="col-md-3">
                            {{Form::label('correctpoints', 'Correct Option Points', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                               {{Form::text('correctpoints','', ['class' => 'form-control'])}}
                        </div>
                     </div>
                      <br/>
                      <div class="row">
                        <div class="col-md-3">
                            {{Form::label('wrongpoints', 'Wrong Option Points', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                               {{Form::text('wrongpoints','', ['class' => 'form-control'])}}
                        </div>
                     </div>


                 </div> 
                   

              <br/>
      
              <div class="centerButton">
                    <button type="submit" class="btn btn-warning btn-lg yellowButton"> Send Notification </button>
                   
                       
                    </div>







    </div>
       
    </div>
    {!! Form::close() !!}

</div>
</div>

 <script src="/vendor/adminlte/vendor/jquery/dist/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function () {


    $('input[type="radio"]').click(function () {
        if ($(this).attr("value") == "url") {
            $(".divurl").show('slow');
             $(".divnormal").hide();
             


        }
        if ($(this).attr("value") == "normal") {
            $(".divurl").hide();
            $(".divnormal").show('slow');

        }
    });

   // $('input[type="radio"]').trigger('click');  // trigger the event
});

  </script>

 @endsection

