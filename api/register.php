<?php

include "config.php";

if(isset($_POST["user_firstname"]))
 {
  $user_firstname = $_POST["user_firstname"]; 
  
}
if(isset($_POST["user_lastname"]))
 {
  $user_lastname = $_POST["user_lastname"]; 
   
}

if(isset($_POST['email']))
 {
  $email = $_POST['email']; 
 
}
if(isset($_POST["name"]))
 {
 
  $name = $_POST["name"]; 
   
}

if(isset($_POST['user_dob']))
 {
  $user_dob = $_POST['user_dob']; 
  
}
if(isset($_POST["password"]))
 {
 
   $password1 = $_POST["password"]; 
   $password = password_hash($password1,PASSWORD_DEFAULT );
	  
  
}

if(isset($_POST['parent_contact']))
 {
  $parent_contact = $_POST['parent_contact']; 
   
}

if(isset($_POST['parent_address']))
 {
  $parent_address = $_POST['parent_address']; 
  
 }

if(isset($_POST['parent_name']))
 {
  $parent_name = $_POST['parent_name']; 
 }
//$hash = sha1($password);

if( $parent_address != null)
{
	$status_id =1; //Pending
}
else
{
	$status_id =2; //Approved
}
	
if(isset($_POST['token']))
 {
  $token = $_POST['token']; 
 }


$query_insert_user = "INSERT INTO users
			(user_firstname, user_lastname, email, name, user_dob, password, parent_name, parent_contact, parent_address,status_id,role,token,created_at,updated_at)
			VALUES 
			('$user_firstname', '$user_lastname', '$email', '$name', '$user_dob', '$password', '$parent_name', '$parent_contact', '$parent_address','$status_id',2,'$token',NOW(),NOW());
			";

$query_check_user = "SELECT * FROM users WHERE email = '$email';";


$message_200 = "OK";
$message_201 = "User Pending";
$message_203 = "User Rejected";

$message_401 = "Unauthorized";
$message_400 = "duplicate";
if ($conn) {
	 $resultset = mysqli_query($conn, $query_check_user) or die(json_encode($response["error"] = mysqli_error($conn)));

	$data = array();
	while ($rows = mysqli_fetch_assoc($resultset)) {
		$data[] = $rows;
	}
	if (count($data) == 1) {
		jsonResponse(404, "You have already registered for PAWER under this email!", $data, "Already Registered", "Already Registered for Pawer", null);
	} 
	else{		
		$result = addUser($conn, $query_insert_user);
		  $resultset = mysqli_query($conn, "SELECT * FROM users WHERE email='$email';") or die(json_encode($response["error"] = mysqli_error($conn)));
		$data = array();
		while ($rows = mysqli_fetch_assoc($resultset)) {
			$data[] = $rows;
		}
		if ($data != []) {
       // echo "Status= ".$status_id;
		if($status_id ==2) // approved
		{
		   $resultemail=sendApproveEmail($email, "Welcome to PAWER");
		   
					   if($resultemail)
			{
				//echo "sendApproveEmail";
			}
		   jsonResponse(200, $message_200, $data, "Almost There!", "Thanks! For Registration ");
		}
		else if($status_id ==1)
		{
			$resultemail=sendPendingEmail($email, "Registration");
			if($resultemail)
			{
				//echo "sendPendingEmail";
			}
					   
		   jsonResponse(200, $message_200, $data, "Almost There!", "Thanks! For Registration ");
		}
		   
		   
		       if($data[0]['parent_address'] != null)
			   {
				   //updated on 27 jul by pranali
				    //jsonResponse(200, $message_200, $data, "Almost There!", "Thanks! Your Approval is pending");
				$resultparentemail=sendParent($parent_address,$email, "Parent Confirmation");
			   }
			 
			   
		}
		}	
   
}

function jsonResponse($status, $status_message, $data, $display_title, $display_message) 
{
	$response['status'] = $status;
	$response['message'] = $status_message;
	$response['users'] = $data;
	$response['display_title'] = $display_title;
	$response['display_message'] = $display_message;
	$json_response = json_encode($response);
	echo $json_response;
}

	

		
		function sendPendingEmail($email, $subject) {
   
   $headers = "From: " . "etechcentre123@gmail.com" . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	$message = "<html>
	<head>
		<meta charset='utf-8' />
		<meta http-equiv='X-UA-Compatible' content='IE=edge'>
		<title>Registration Successful</title>
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' crossorigin='anonymous'>
		<style>
			.container {
				width: 100%;
				padding: 0;
			}

			.whiteBackground {
				background: white;
				width: 70%;
				padding: 5%;
				margin: auto;
			}

			.centerContent {
				text-align: center;
			}

			.link {
				border: 1px solid;
				padding: 2%;
				text-decoration: none !important;
			}
		</style>
	</head>
	<body>
		<p>You have successfully registered for PAWER App.
		<br/><br/><br/><br/><br/><br/>

<b>PAWER LEARNING</b> App is supported by Lifelong learning Council
<br/><br/>
<img src=\"http://ehostingcentre.com/pawer/pawerlogo.png\" alt=logo width=\"80\" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<img src=\"http://ehostingcentre.com/pawer/skillsfuturesg.png\" alt=logo width=\"80\" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<img src=\"http://ehostingcentre.com/pawer/wsg.png\" alt=logo width=\"80\" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<img src=\"http://ehostingcentre.com/pawer/lifelong-logo.png\" alt=logo width=\"80\"/>
<br/><br/><br/>
Kelvin Goh<br/>
Bachelor of Business Admin (NUS) <br/>
Master of Arts, Education Management (NIE/NTU)<br/>
Chief Trainer/Founder - PAWER Skills Consultancy<br/>
O:65841051  H/P:96521700 <br/>
Email              :admin@pawer.com.sg <br/>
Website          : www.pawer.com.sg<br/>
Add us in FACEBOOK: www.facebook.com/pawerskills<br/>


</p>
	</body>
</html>";
	if (mail($email, $subject, $message, $headers)) {
		return true;
	} else {
		return false;
	}
}



function sendApproveEmail($email, $subject) {
   
   $headers = "From: " . "etechcentre123@gmail.com" . "\r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	$message = "<html>
	<head>
		<meta charset='utf-8' />
		<meta http-equiv='X-UA-Compatible' content='IE=edge'>
		<title>Registration Successful</title>
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' crossorigin='anonymous'>
		<style>
			.container {
				width: 100%;
				padding: 0;
			}

			.whiteBackground {
				background: white;
				width: 70%;
				padding: 5%;
				margin: auto;
			}

			.centerContent {
				text-align: center;
			}

			.link {
				border: 1px solid;
				padding: 2%;
				text-decoration: none !important;
			}
		</style>
	</head>
	<body>
		<p> <b>Welcome on Board.</b> Your Learning Journey Starts Today.<br/><br/>

We're all works in progress. The App will ready in a month or two and you will be served with thousands of incredible content (videos/articles/films/stories etc), interpersed with games and fun activities that will help to make you even more hungrier for more learning. Our aim is to make learning fun and excite you to want to make learning as a lifelong pursuit.
<br/><br/>
1. It’s curated for you<br/>
We hand-select only the best contents, identify the key ideas from each title and distill them into refined summaries of key insights. That way, you can be sure that you’re really getting the essence of the writer’s ideas.
<br/><br/>
 2. You can learn on-the-go <br/>
Learn wherever, whenever you have a moment with our PAWER LEARNING App function in your phone. Whether you’re commuting, out for a run, or just want to learn something while you’re brushing your teeth, you never have to stop moving to learn something new. Our contents are specially curated to give you the best, most intimate learning experience possible.
<br/><br/>
 3. Join a growing community<br/>
 PAWER LEARNING now has a growing community of learners from schools and private institutions. The parents/guardians of our students come from many different walks of life — from grandmothers and homemakers, to CEOs of companies, to teachers of schools etc. What do they all have in common? Endless curiosity and a hunger to become their best selves. 
<br/><br/>
4. A diverse team is dedicated to your experience. PAWER LEARNING App has one very important thing at its core: real people. The contents aren’t chosen by algorithms. We select each one carefully to make sure that the quality you’re getting is nothing but the best. Our team comes from highly qualified teachers  (NIE trained) and tutors (more than 10 to 20 years teaching experience)  and our collective experience means we know a thing or two about what makes a powerful, life-changing learning adventure. Download the PAWER LEARNING app and get the best learning from over thousands of incredible contents. It’s a surefire way to becoming a better you!
<br/><br/>
5. Our App makes reading and learning fun. With 14 different themes (Happenings around the World, Fun Facts, Motivation and Character Building, Inspiring Phrases, Word of the Day, Idioms, Beautiful Phrases to use in your composition etc), you are sure to be spoilt for choice and you will be hungry for more. Games and rewards make learning more fun 
<br/><br/>
6. People often say that motivation doesn't last. Well, neither does bathing - that's why we recommend it daily. The App will cover the tools, strategies and tactics students need to learn in order to get extraordinary performance by using the most powerful and effective theroies to come out of the world of behavioral psychology.
<br/><br/>
PAWER LEARNING App adopts teaching and learning methodology that are proven effective in NTU/NIE 
<br/><br/>
(PICTURE of Proven effective in attached file)
<br/><br/><br/><br/>


<b>PAWER LEARNING</b> App is supported by Lifelong learning Council
<br/><br/>
<img src=\"http://ehostingcentre.com/pawer/pawerlogo.png\" alt=logo width=\"80\" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<img src=\"http://ehostingcentre.com/pawer/skillsfuturesg.png\" alt=logo width=\"80\" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<img src=\"http://ehostingcentre.com/pawer/wsg.png\" alt=logo width=\"80\" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<img src=\"http://ehostingcentre.com/pawer/lifelong-logo.png\" alt=logo width=\"80\"/>
<br/><br/><br/>
Kelvin Goh<br/>
Bachelor of Business Admin (NUS) <br/>
Master of Arts, Education Management (NIE/NTU)<br/>
Chief Trainer/Founder - PAWER Skills Consultancy<br/>
O:65841051  H/P:96521700 <br/>
Email              :admin@pawer.com.sg <br/>
Website          : www.pawer.com.sg<br/>
Add us in FACEBOOK: www.facebook.com/pawerskills<br/>


</p>
	</body>
</html>";
	if (mail($email, $subject, $message, $headers)) {
		return true;
	} else {
		return false;
	}
}



function sendParent($email,$user_email, $subject) {
	   
	 $headers = "From: " . "<PAWER>noreply@pawer.com.sg" . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$message = "<html>
		<head>
			<meta charset='utf-8' />
			<meta http-equiv='X-UA-Compatible' content='IE=edge'>
			<title>Reset password successful</title>
			<meta name='viewport' content='width=device-width, initial-scale=1'>
			<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' crossorigin='anonymous'>
			<style>
				.container {
					width: 100%;
					padding: 0;
				}

				.whiteBackground {
					background: white;
					width: 70%;
					padding: 5%;
					margin: auto;
				}

				.centerContent {
					text-align: center;
				}

				.link {
					border: 1px solid;
					padding: 2%;
					text-decoration: none !important;
				}
			</style>
		</head>
	<body>
			<div class='container'>
					<div class='whiteBackground'>
						<div class='image' style='text-align:center;'>
						 <!--   <img src='http://ehostingcentre.com/redcampadmin/storage/logo/logo.png' class='logo' style='width: 7%;position:absolute;margin-top:-4%;margin-left:-4%;'> -->
						 
						</div>
						<div>
							<p>Your Child has applied for PAWER . Please Approve or Reject this application. Thank you</p>
							<br>
						   
							<br><br>
							
							
						</div>
						 <table cellspacing=\"0\" cellpadding=\"0\">
			<tr>
			<td align=\"center\" width=\"150\" height=\"40\" bgcolor=\"#FFD700\" style=\"-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; 					color: #ffffff; display: block;\">
				<a href=\"http://www.ehostingcentre.com/pawer/api/confirmapi.php?email=$email&status_id=2 \" style=\"font-size:16px; font-weight: bold; font-family: Helvetica, Arial, sans-serif; text-decoration: none; line-height:40px; width:100%; display:inline-block\"><span style=\"color: #6A6C6D\">Approve</span></a>
</td>
<td align=\"center\" width=\"20\" height=\"40\" bgcolor=\"#FFFFFF\" style=\"-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; color: #ffffff; display: block;\">
</td>
<td align=\"center\" width=\"150\" height=\"40\" bgcolor=\"#04eaf2\" style=\"-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; 					color: #ffffff; display: block;\">
				<a href=\"http://www.ehostingcentre.com/pawer/api/confirmapi.php?email=$email&status_id=3 \" style=\"font-size:16px; font-weight: bold; font-family: Helvetica, Arial, sans-serif; text-decoration: none; line-height:40px; width:100%; display:inline-block\"><span style=\"color: #6A6C6D\">Reject</span></a>
</td>
</tr>
</table>
					</div>
			</div>
			<p>
			<b>PAWER LEARNING App </b>is supported by Lifelong learning Council
<br/><br/>
<img src=\"http://ehostingcentre.com/pawer/pawerlogo.png\" alt=logo width=\"80\" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<img src=\"http://ehostingcentre.com/pawer/skillsfuturesg.png\" alt=logo width=\"80\" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<img src=\"http://ehostingcentre.com/pawer/wsg.png\" alt=logo width=\"80\" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<img src=\"http://ehostingcentre.com/pawer/lifelong-logo.png\" alt=logo width=\"80\"/>
<br/><br/><br/>
Kelvin Goh<br/>
Bachelor of Business Admin (NUS) <br/>
Master of Arts, Education Management (NIE/NTU)<br/>
Chief Trainer/Founder - PAWER Skills Consultancy<br/>
O:65841051  H/P:96521700 <br/>
Email              :admin@pawer.com.sg <br/>
Website          : www.pawer.com.sg<br/>
Add us in FACEBOOK: www.facebook.com/pawerskills<br/>
</p>

		</body>
	</html>";
		if (mail($email, $subject, $message, $headers)) {
			return true;
		} else {
			return false;
		}
	}

function addUser($conn, $query)
 {
	$resultset = mysqli_query($conn, $query) or die(json_encode($response["error"] = mysqli_error($conn)));
	return $resultset;
}

function checkEmail($conn, $query) {
	$resultset = mysqli_query($conn, $query) or die(json_encode($response["error"] = mysqli_error($conn)));

	$data = array();
	while ($rows = mysqli_fetch_assoc($resultset)) {
		$data[] = $rows;
	}
	return $data;
}

 ?>