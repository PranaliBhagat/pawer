	<?php

  
	include 'config.php';
	$id = $_GET['id'];
	$token = $_GET['token'];
 //echo $token;
	$query_user = "SELECT * FROM users where id = '$id'" ;
	//echo $email;
	if ($conn) {
    $getuser = Getuser($conn, $query_user);
		if (!empty($getuser)) {
			 $email = $getuser[0]['email'];
			 
			 $usertoken = $getuser[0]['remember_token'];
			 
			// echo $usertoken;
			 if($usertoken != $token)
			 {
				$validtoken = 0; // 0= invalid
			 }
			 else
			 {
				$validtoken = 1; // 0= valid
			 }
			 
			 
        
	
		
    } 
		
	}
	
	function Getuser($conn, $query) {
    $resultset = mysqli_query($conn, $query) or die(json_encode($response["error"] = mysqli_error($conn)));
    $data = array();
    while ($rows = mysqli_fetch_assoc($resultset)) {
        $data[] = $rows;
    }
    return $data;
	
	}
	
	
	?>
	
	<html>
	<head>    
	<title>Change Password </title>
	<script language="javascript" type="text/javascript" src="jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	 <link rel="stylesheet" href="bootstrap.min.css" />
	</head>

	<body>
	 <!-- Navigation Bar -->
<div class="topnav">
<a class= "active" href="#"><img src="pawer_redlogo.png" alt="logo" width="52" height="28"></a> 


   
 </div>
</div>
	
	<br/><br/>

	
	
	
		<table border="0">
			
			
			<tr> 
				<td class="col-md-3">New Password</td>
				<td class="col-md-10"><input class="form-control"  type="password" id="password" value=""></td>
			</tr>
			<tr> 
				<td class="col-md-3">Confirm Password</td>
				<td class="col-md-10"><input  class="form-control" type="password" id="confirm_password" value=""></td>
			</tr>
		
			
			<tr>
				<td ><input type="hidden" id="email" value=<?php echo $email;?>></td>  
				
				<td><input type="submit" name="update" value="Update" method = "Post" class="btn btn-success" onclick = "updatepassword();" ></td>
			</tr>
			
			<tr>
				<td ><input type="hidden" id="email" value=<?php echo $email;?>></td>  
				<td ><input type="hidden" id="token" value=<?php echo $token;?>></td>  
				
			</tr>
		</table>
		
		<div id= "message"  ></div>
		<div id= "result" ></div>
		
	
	
	<script type = "text/javascript">
	var var1 = "";
	$('#confirm_password').on('keyup', function () {
	if ($('#password').val() != $('#confirm_password').val()) {
		$('#message').html('Password Not Matching').css('color', 'red');
		 
	} 
	else
	{
		$('#message').html('').css('color', 'red');
		var1 = "match";
	}
   
	});
	
	function updatepassword()
	{
		var email = $('#email').val();
		var password = $('#password').val();
		var token = $('#token').val();
		var msg = $('#message').val();
		console.log('hi');
		if(var1 == "match")
		{
			//console.log(msg);
		$.post('forgetpassword.php',{email:email,password:password,remember_token:token}, 
		function(data) 
		{
			
		var json = JSON.parse(data);
		if(json.status == 200)
		{
			$('#result').html("Password Update Successful");
		}
		else
		{
			$('#result').html("Password Failed");
		}
		

			
		
		});
		}
		else
		{
			console.log(msg);
			$('#result').html('Password Update Failed ');
		}
	}
	
	

		</script>
	</body>
	</html>