<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	
   
	
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.1/css/bootstrap-colorpicker.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

  

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- appjs -->
    <script src="{{ asset('/js/app.js') }}"></script>
    <script src=" https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<!-- datatable button -->
   <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
   <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<!-- /datatable button -->
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
 

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.1/js/bootstrap-colorpicker.min.js"></script>  

    
 <style>

.tab a {
    display: block;
    background-color: inherit;
    color: black;
     padding: 9px 10px; 
     /* width: 20%;  */
    border: none;
    outline: none;
    text-align: center;
    cursor: pointer;
    font-size: 18px;
}

/* Change background color of buttons on hover */
.tab a:hover {
    background-color: #ed1818;
    color: white;
}

/* Create an active/current "tab button" class */
.tab a.active {
    background-color: #fb1026;
}

<style>
body {
  margin: 0;
  font-family: "Lato", sans-serif;
}

.sidebar {
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: #f1f1f1;
  position: fixed;
  height: 100%;
  overflow: auto;
}

.sidebar a {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
}
 
.sidebar a.active {
  background-color: #4CAF50;
  color: white;
}

.sidebar a:hover:not(.active) {
  background-color: #555;
  color: white;
}

div.content {
  margin-left: 200px;
  padding: 1px 16px;
  height: 1000px;
}

@media screen and (max-width: 700px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
}

@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: center;
    float: none;
  }
}
  </style>
 
   
</head>
<body>
<div class="sidebar">
  <a href="{{ url('/home') }}"><i class="fa fa-fw fa-home"></i> Home</a>
  <a href="{{ url('/category') }}"><i class="fa fa-fw fa-wrench"></i> Category</a>
  
</div>

    <div id="app" >
    

        <main class="py-4">
            @yield('content')
        </main>
    </div>
      <script type="text/javascript">
         $( document ).ready(function() {
            
            $('#tbnotification').DataTable();
            $('#tbCategory').DataTable();
            $('#homeTable').DataTable({
                'lengthChange': false,
                dom: 'Bfrtip',
                'responsive': true,
                "bFilter": true,
                "pageLength": 20,
                "oLanguage": {
                    "sEmptyTable": "No data available"
                },
               
                searching: false,
                columnDefs: [{targets: [2,4,5,6,7], visible: false}],

                buttons: [   
                    { 
                     extend: 'excelHtml5',
                     exportOptions: {
                     columns: [0, 1, 2, 3,4,5,6,7]
                     }
                             
                    }
           
                ]
                             } );
         $('.colorpicker').colorpicker();
        
        });
        </script>
</body>
</html>
