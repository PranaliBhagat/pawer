@extends('adminlte::page')
@section('content')
<div class="container" id="divtable">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="display:none">
                <div class="card-header">Hi Dashboard</div>

                <div class="card-body">
                   
                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                   
                </div>
            </div>

            <div>
            @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
             @endif
            	  <a href="{{action('CategoryController@create')}}" class="btn btn-success">Add New Category</a>
                <br/> <br/>
              
            </div>

            <div>

                   <table class="table table-striped table-bordered"  cellspacing="0" id="tbCategory"> 
                    <thead> 
                            <tr>
                           		 <th> Category Name </th>
                                    <th>  Age group   </th>
                                    <th>  Color   </th>
                                     <th width="4%">Actions</th>
                                     <th></th>
                            </tr>
                    </thead>
                    <tbody> 
             @foreach($category as $categorys)
                <tr>
              
                    <td>{{$categorys->category_name}} </td>
                    <td>{{$categorys->age_group}}</td>
                    <td  bgcolor={{ $categorys->color }}></td>
                    
                    <td>
                        <a href="{{action('CategoryController@edit',$categorys->id)}}" class="btn btn-warning">Edit</a> &nbsp;
                    </td>
                      <td> 

                         {!!Form::open(['action' => ['CategoryController@destroy',              $categorys->id],'onsubmit' => 'return ConfirmDelete()', 'method' => 'POST'])!!}

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

<script src="/vendor/adminlte/vendor/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
     
 $(document).ready(function () {

    $('#tbCategory').DataTable();
   console.log( "window loaded" );
           // var oTable = $('#mytable').DataTable();
   });


 function ConfirmDelete(){
return confirm('THIS ACTION WILL DELETE IT!\n\nAre you sure?');
}
    </script>
  @endsection


