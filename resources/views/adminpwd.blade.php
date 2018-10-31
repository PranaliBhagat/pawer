@extends('adminlte::page')

@section('content')

<div class="container-fluid">
            <div class="pageContent">
                <h3 class="title">Change Password</h3>
                @if(count($errors) > 0)
             @foreach($errors->all() as $error)
                     <div class="alert alert-danger">
                           {{$error}}
                     </div>
              @endforeach
            @endif 
           
             
               {!! Form::open(['action' =>['ReguserController@adminpwd'],'method'=> 'POST']) !!}
            {{csrf_field()}}  
                <div class="row">

                    <div class="col-md-3">
                        {{Form::label('newpassword', 'New Password', ['class' => 'form-label'])}}
                    </div>
                    <div class="col-md-9">
                        {{Form::password('newpassword', ['class' => 'form-control'])}}
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-3">
                        {{Form::label('confirmpassword', 'Confirm Password', ['class' => 'form-label'])}}
                    </div>
                    <div class="col-md-9">
                        {{Form::password('confirmpassword', ['class' => 'form-control'])}}
                    </div>
                </div>
				
            <hr>
            <div class="row">
                <div class= "col-md-2">
                    <button  type="submit" class="btn btn-warning btn-lg yellowButton">Change Password</button>
                </div>
                  
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        @endsection