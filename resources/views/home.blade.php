@extends('adminlte::page')

@section('content')


<div class="container" id="divtable">

    <div class="row justify-content-center">
        <div class="col-md-8">
        @if (session('status'))
                <div class="alert alert-success">
                     {{ session('status') }}
                </div>
          @endif

        @if(count($errors) > 0)
             @foreach($errors->all() as $error)
                     <div class="alert alert-danger">
                           {{$error}}
                     </div>
              @endforeach
            @endif 
           
             </div>   
           
             <div class="row panel justify-content-center">
				<div class = "col-lg-6" >
                 <div class = "form-group">
               
				<form action="{{url('home/user/search')}}"  >
				{{ csrf_field() }}
                 <input type="text" class="form-control" name="q"
                 placeholder="Search User" value= "<?php echo(isset($_GET['q'])?$_GET['q']:'');?>"> <span class="input-group-btn"> 	            
				</div>
               </div>    
			    <div class = "col-lg-6">
                 <div class = "form-group">
                  {{ Form::submit('Search', ['class'=>'btn btn-primary'])  }}   
                <a href="{{url('home/user/search')}}" > &nbsp; &nbsp;
                <input  class="btn btn-warning" type="button" value="Clear"></a>
                </div>  
               
				</form>    
				 </div>
		
				 <div class = "col-lg-6">
                 <div class = "form-group">
			     <form action="{{url('home/user/approve')}}"  >
                 &nbsp; &nbsp;    <select name="status" id="status" onchange="this.form.submit()"">
								<option value="4">Select Status</option>
								<option value="0">All</option>
								<option value="1">Pending</option>
								<option value="2">Approved</option>
								<option value="3">Rejected</option>
								  </select>
              
               
            </form>
			  </div>  
         </div>  
				</div>
                    
              
               
               
                      
      
            <div class= " box-body" width ="40%">
            @if(count($users)>0)
                   <table  id="homeTable" class="DT table  table-bordered" width="1000px" cellspacing="0"> 
                    <thead> 
                            <tr>
                            <th width="100%"  >  Name </th>
                            <th>  Email  </th>
                            <th>  DOB  </th> 
                            <th>  Status  </th> 
                            <th>  Parent Name  </th> 
                            <th>  Parent Contact  </th> 
                            <th>  Parent Address  </th> 
                            <th>  Points  </th> 
                            <th width="0%" text-align="center"></th>
                            <th>Action</th>
                            <th></th>
                            </tr>
                    </thead>
                    <tbody > 
                  @foreach($users as $user)
                    <tr>
              
                    <td>{{$user->user_firstname}} {{$user->user_lastname}} </td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->user_dob}}</td>
                    <td>
                        @if($user->status_id == 1) Pending
                        @elseif($user->status_id == 2) Approved
                        @elseif($user->status_id == 3) Rejected
                        @endif
                    </td>

                    <td>{{$user->parent_name}}</td>
                    <td>{{$user->parent_contact}}</td>
                    <td>{{$user->parent_address}}</td>
                    <td>{{$user->points}}</td>
                    
                    <td>
                        <a href="{{action('ReguserController@edit',$user->id)}}" class="btn btn-primary">
                        <span class="glyphicon glyphicon-edit"></span>
                         </a> &nbsp;
                    </td>
                    <td>
                    <a href="{{action('ReguserController@changepwd',$user->id)}}" class="btn btn-warning">
                    <span class="glyphicon glyphicon-cog"></span>
                        </a> 
                     </td>
                     <td>
                     <!-- <a href="{{action('ReguserController@destroy',$user->id)}}" onclick="return ConfirmDelete()" class="btn btn-danger">Delete</a> &nbsp; -->
                         {!!Form::open(['action' => ['ReguserController@destroy',    $user->id],'onsubmit' => 'return ConfirmDelete()', 'method' => 'POST'])!!}
                       
                              {{Form::hidden('_method', 'DELETE')}}
                              {{Form::button('<i class="glyphicon glyphicon-trash"></i>', array('type' => 'submit', 'class' => 'btn btn-danger action-buttons'))}}
                              
                            {!!Form::close()!!}
                    </td>
                    
                </tr>
                @endforeach
                    </tbody>
                    </table>
                    @else
                  No User Found
              @endif
                </div>
        </div>
    </div>



<div id="myModal" class="modal">


</div>
<script src="/vendor/adminlte/vendor/jquery/dist/jquery.min.js"></script>

@section('js')
 
 <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
 <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
 
 @stop
 
  
<script type="text/javascript" >
  
 $(document).ready(function () {

      $('#homeTable').DataTable({
                dom: 'Bfrtip',
                'responsive': true,
                "bFilter": true,
                "pageLength": 20,
                "oLanguage": {
                    "sEmptyTable": "No data available"
                },
               
                searching: false,
                columnDefs: [{targets: [2,4,5,6,7], visible: false}]
                ,
                buttons: [   
                    { 
                     extend: 'excelHtml5',
                     exportOptions: {
                     columns: [0, 1, 2, 3,4,5,6,7]
                     }
                             
                    }
           
                ]
               
     } );

  // $('#mytable').DataTable();
   console.log( "window loaded" );
           // var oTable = $('#mytable').DataTable();
       
var modal = document.getElementById('myModal');

// Get the button that opens the modal
//var btn = document.getElementById("myBtn");

var btn = document.getElementsByClassName("myBtn");
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 

btn.onclick = function() {
	console.log( "modal loaded" );
    modal.style.display = "block";
    divtable.style.display ="none";
};


// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
     divtable.style.display ="block";
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
	
    if (event.target == modal) {
		console.log( "modal loaded" );
        modal.style.display = "none";
         divtable.style.display ="block";
    }
}

});


 


function ConfirmDelete(){
return confirm('THIS ACTION WILL DELETE IT!\n\nAre you sure?');
}
</script>
  @endsection



