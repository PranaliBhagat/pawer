@extends('adminlte::page')

@section('title', 'User | Pawer')


@section('content_header')

  
@stop

@section('content')

 {!! Form::open(['action' =>['ReguserController@update',$user-> id],'method'=> 'POST']) !!}
            {{csrf_field()}}  
<div class="container-fluid">
    <div class="pageContent">
        <h3 class="title">Edit User</h3>
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
                         {{Form::label('firstname', 'First Name', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                            {{Form::text('firstname', $user-> user_firstname, ['class' => 'form-control'])}}
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-md-3">
                         {{Form::label('lastname', 'Last Name', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                            {{Form::text('lastname', $user-> user_lastname, ['class' => 'form-control'])}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                         {{Form::label('image', 'Image', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">                     
                        <img class="img-responsive" src="data:image/png;base64,{{$user->image}}" width="400px"  height="300px"alt="Image">
                        </div>
                    </div>
                    


                      <div class="row">
                        <div class="col-md-3">
                         {{Form::label('username', 'User Name', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                            {{Form::text('username', $user-> name, ['class' => 'form-control'])}}
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-md-3">
                         {{Form::label('dob', 'Date of Birth', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                            {{Form::date('dob', $user-> user_dob, ['class' => 'form-control'])}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            {{Form::label('email', 'Email', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                            {{Form::text('email', $user-> email, ['class' => 'form-control'])}}
                        </div>
                    </div>
                       <div class="row">
                        <div class="col-md-3">
                            {{Form::label('parent_name', 'Parent Name', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                            {{Form::text('parent_name', $user-> parent_name, ['class' => 'form-control'])}}
                        </div>
                    </div>
                       <div class="row">
                        <div class="col-md-3">
                            {{Form::label('parent_contact', 'Parent Contact', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                            {{Form::text('parent_contact', $user-> parent_contact, ['class' => 'form-control'])}}
                        </div>
                    </div>
                       <div class="row">
                        <div class="col-md-3">
                            {{Form::label('parent_address', 'Parent Address', ['class' => 'formLabel'])}}
                        </div>
                        <div class="col-md-9">
                            {{Form::text('parent_address', $user-> parent_address, ['class' => 'form-control'])}}
                        </div>
                    </div>
                      <div class="row">
                        <div class="col-md-3">
                            {{Form::label('status', 'Status', ['class' => 'formLabel'])}}
                        </div>
                       
                        <div class="col-md-6">
                            <!-- {{Form::hidden('status',$status ,['class' => 'form-control','readonly' => 'true'])}} -->
                            <select name="status" class="form control">
                                 <option value="1" {{ $user->status_id=="1" ? "selected" : ''}}>Pending</option>
                                 <option value="2" {{ $user->status_id=="2" ? "selected" : ''}}>Approved</option>
                                 <option value="3" {{ $user->status_id=="3" ? "selected" : ''}}>Rejected</option>
                            </select>
                      </div>
                  </div>
          
<br/>
            {{Form::hidden('_method','PUT')}}

         <div class="row">
                        <div class="col-md-3">
                <button type="submit" class="btn btn-success btn-lg yellowButton">SAVE</button>
              </div>
                <div class="col-md-3">
                <button type="cancel" class="btn btn-danger btn-lg yellowButton">Cancel</button>
              </div>  
            </div>
        </div>
    </div>
</div>

  </div>

 <br/> <br/><br/>


    {!! Form:: close()!!}
    
@endsection