@extends('adminlte::page')
@section('content')
<div class="container" id="divtable">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="display:none">
                <div class="card-header">Hi Dashboard</div>

                <div class="card-body" visible = "false">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>

            <div>
            	
            	  <a href="{{action('NotificationController@create')}}" class="btn btn-success">New Notification</a>
                <br/><br/>
                       
            </div>

            <div>

                   <table class="table table-striped table-bordered" width="400px" cellspacing="0" id="mytable"> 
                    <thead> 
                            <tr>
                           		 <th> Category Name </th>
                           		 <th>  Age group   </th>

                           		  <th colspan = "3" width="4%">Actions</th>
                            </tr>
                    </thead>
                    <tbody> 
             @foreach($notification as $notifications)
                <tr>
              
                    <td>{{$notifications->category_name}} </td>
                    <td>{{$notifications->age_group}}</td>
                    <td>
                        <a href="{{action('NotificationController@edit',$notifications->id)}}" class="btn btn-warning">Edit</a> &nbsp;
                      </td>
                      <td> 

                         {!!Form::open(['action' => ['NotificationController@destroy',              $notifications->id],'onsubmit' => 'return ConfirmDelete()', 'method' => 'POST'])!!}

                              {{Form::hidden('_method', 'DELETE')}}
                              {{Form::submit('Delete', ['class' => 'btn btn-danger action-buttons'])}}
                            {!!Form::close()!!}
                    </td>
                    
                </tr>
                @endforeach
                    </tbody>
                    </table>
                </div>
        </div>
    </div>
</div>


<script type="text/javascript">
     
 $(document).ready(function () {
   console.log( "window loaded" );
           // var oTable = $('#mytable').DataTable();
   });


 function ConfirmDelete(){
return confirm('THIS ACTION WILL DELETE IT!\n\nAre you sure?');
}
    </script>
  @endsection


