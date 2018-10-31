<?php

include 'config.php';
//confirmapi.php
 if(isset($_GET['email']))
 {
  $email= $_GET['email']; 
}

if(isset($_GET['status_id']))
 {
	 
  $status_id = $_GET['status_id']; 
  
}

$query_getuser = "SELECT * FROM users WHERE email = '$email'";
$query_updatestatus = "Update users set status_id ='$status_id' where email ='$email'";
if ($conn) {
   
        $checkuser = getUser($conn, $query_getuser);
		$parent_email= $checkuser[0]['parent_address'];
        if ($checkuser != []) 
			{
				if ($checkuser[0]['status_id']  == 1 ) // if status is pending i.e 1 then only update the to 2 or 3
				{
					
					 $update = updateuser($conn, $query_updatestatus);
					 
					// if($update) {} // if update successful
					// jsonResponse(200, $message_403, "Update", "Update Successful", null);
					//echo "Thanks for your Confirmation"; 
					
				
						if($status_id ==2) // approved if approved send email to student
							{
								header( 'Location: http://www.ehostingcentre.com/pawer/api/thank.html' ) ;
								$resultemail=sendApproveEmail($email, "Welcome to PAWER");
								if($resultemail)
									{
										//echo "sendApproveEmail";
									}
							
							}
							else if($status_id ==3) // Rejected - if rejected send email to parent
							{
								header( 'Location: http://www.ehostingcentre.com/pawer/api/reject.html' ) ;
								$resultemail=sendRejectEmail($parent_email, "PAWER Application Rejected");
							}
				}
								else 
				{
				//	jsonResponse(201, $message_403, "Update", "Already Approved/ Rejected.Please Contact Admin", null);
				//echo "Already Approved/ Rejected.Please Contact Admin";
					header( 'Location: http://www.ehostingcentre.com/pawer/api/oiuytrdfgjk.html' ) ;
					
				}
				
			}
}
 else 		{
			jsonResponse(403, $message_403, "DATABASE ERROR", "Unable to connect to database", null);
			}
			

/*
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
	echo "Database connection successful   ";
}
*/

/*
if ($status_id == '2') {
	echo $email;
    $sql = "UPDATE users SET status_id='2' WHERE email='$email';";
    if ($conn->query($sql) === TRUE) {
    	echo "Accepted";
    }
} 

else if ($status_id == '3')  // Rej
{
   $sql = "UPDATE users SET status_id='3' WHERE email='$email';";
    if ($conn->query($sql) === TRUE) {
    	echo "Rejected";
    } 
}
*/


function sendApproveEmail($email, $subject) {
   
   $headers = "From: " . "<PAWER>noreply@pawer.com.sg" . "\r\n";
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
1. It's curated for you<br/>
We hand-select only the best contents, identify the key ideas from each title and distill them into refined summaries of key insights. That way, you can be sure that you're really getting the essence of the writer's ideas.
<br/><br/>
 2. You can learn on-the-go <br/>
Learn wherever, whenever you have a moment with our PAWER LEARNING App function in your phone. Whether you're commuting, out for a run, or just want to learn something while you're brushing your teeth, you never have to stop moving to learn something new. Our contents are specially curated to give you the best, most intimate learning experience possible.
<br/><br/>
 3. Join a growing community<br/>
 PAWER LEARNING now has a growing community of learners from schools and private institutions. The parents/guardians of our students come from many different walks of life - from grandmothers and homemakers, to CEOs of companies, to teachers of schools etc. What do they all have in common? Endless curiosity and a hunger to become their best selves. 
<br/><br/>
4. A diverse team is dedicated to your experience. PAWER LEARNING App has one very important thing at its core: real people. The contents aren't chosen by algorithms. We select each one carefully to make sure that the quality you're getting is nothing but the best. Our team comes from highly qualified teachers  (NIE trained) and tutors (more than 10 to 20 years teaching experience)  and our collective experience means we know a thing or two about what makes a powerful, life-changing learning adventure. Download the PAWER LEARNING app and get the best learning from over thousands of incredible contents. It's a surefire way to becoming a better you!
<br/><br/>
5. Our App makes reading and learning fun. With 14 different themes (Happenings around the World, Fun Facts, Motivation and Character Building, Inspiring Phrases, Word of the Day, Idioms, Beautiful Phrases to use in your composition etc), you are sure to be spoilt for choice and you will be hungry for more. Games and rewards make learning more fun 
<br/><br/>
6. People often say that motivation doesn't last. Well, neither does bathing - that's why we recommend it daily. The App will cover the tools, strategies and tactics students need to learn in order to get extraordinary performance by using the most powerful and effective theroies to come out of the world of behavioral psychology.
<br/><br/>
PAWER LEARNING App adopts teaching and learning methodology that are proven effective in NTU/NIE 
<br/><br/>

<br/><br/>


<b>PAWER LEARNING</b> App is supported by Lifelong learning Council
<br/><br/>
<img src=\"http://ehostingcentre.com/pawer/pawerlogo.png\" alt=logo width=\"80\" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<img src=\"http://ehostingcentre.com/pawer/skillsfuturesg.png\" alt=logo width=\"80\" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<img src=\"http://ehostingcentre.com/pawer/wsg.png\" alt=logo width=\"80\" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<img src=\"http://ehostingcentre.com/pawer/lifelong-logo.png\" alt=logo width=\"80\"/>


<br/><br/><br/><br/>
Kelvin Goh<br/>
Bachelor of Business Admin (NUS) <br/>
Master of Arts, Education Management (NIE/NTU)<br/>
Chief Trainer/Founder - PAWER Skills Consultancy<br/>
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




function sendRejectEmail($email, $subject) {
   
   $headers = "From: " . "<PAWER>noreply@pawer.com.sg" . "\r\n";
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
		<p> We are sorry to let you go  ...<br/><br/>

But you can still change your mind and join us anytime.<br/>
Just log into the App and click \"Accept\"<br/>
We promise that it will be an exciting learning adventure for your child.<br/><br/>

We're all works in progress. The App will ready in a month or two and you will be served with thousands of incredible content (videos/articles/films/stories etc), interpersed with games and fun activities that will help to make you even more hungrier for more learning. Our aim is to make learning fun and excite you to want to make learning as a lifelong pursuit.
<br/><br/>
1. It's curated for you<br/>
We hand-select only the best contents, identify the key ideas from each title and distill them into refined summaries of key insights. That way, you can be sure that you're really getting the essence of the writer's ideas.
<br/><br/>
 2. You can learn on-the-go <br/>
Learn wherever, whenever you have a moment with our PAWER LEARNING App function in your phone. Whether you're commuting, out for a run, or just want to learn something while you're brushing your teeth, you never have to stop moving to learn something new. Our contents are specially curated to give you the best, most intimate learning experience possible.
<br/><br/>
 3. Join a growing community<br/>
 PAWER LEARNING now has a growing community of learners from schools and private institutions. The parents/guardians of our students come from many different walks of life - from grandmothers and homemakers, to CEOs of companies, to teachers of schools etc. What do they all have in common? Endless curiosity and a hunger to become their best selves. 
<br/><br/>
4. A diverse team is dedicated to your experience. PAWER LEARNING App has one very important thing at its core: real people. The contents aren't chosen by algorithms. We select each one carefully to make sure that the quality you're getting is nothing but the best. Our team comes from highly qualified teachers  (NIE trained) and tutors (more than 10 to 20 years teaching experience)  and our collective experience means we know a thing or two about what makes a powerful, life-changing learning adventure. Download the PAWER LEARNING app and get the best learning from over thousands of incredible contents. It's a surefire way to becoming a better you!
<br/><br/>
5. Our App makes reading and learning fun. With 14 different themes (Happenings around the World, Fun Facts, Motivation and Character Building, Inspiring Phrases, Word of the Day, Idioms, Beautiful Phrases to use in your composition etc), you are sure to be spoilt for choice and you will be hungry for more. Games and rewards make learning more fun 
<br/><br/>
6. People often say that motivation doesn't last. Well, neither does bathing - that's why we recommend it daily. The App will cover the tools, strategies and tactics students need to learn in order to get extraordinary performance by using the most powerful and effective theroies to come out of the world of behavioral psychology.
<br/><br/>
PAWER LEARNING App adopts teaching and learning methodology that are proven effective in NTU/NIE 
<br/><br/>

<br/><br/>


<b>PAWER LEARNING</b> App is supported by Lifelong learning Council
<br/><br/>
<img src=\"http://ehostingcentre.com/pawer/pawerlogo.png\" alt=logo width=\"80\" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<img src=\"http://ehostingcentre.com/pawer/skillsfuturesg.png\" alt=logo width=\"80\" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<img src=\"http://ehostingcentre.com/pawer/wsg.png\" alt=logo width=\"80\" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<img src=\"http://ehostingcentre.com/pawer/lifelong-logo.png\" alt=logo width=\"80\"/>


<br/><br/><br/><br/>
Kelvin Goh<br/>
Bachelor of Business Admin (NUS) <br/>
Master of Arts, Education Management (NIE/NTU)<br/>
Chief Trainer/Founder - PAWER Skills Consultancy<br/>
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



function jsonResponse($status, $status_message, $display_title, $display_message, $data) {
    $response['status'] = $status;
    $response['message'] = $status_message;
    $response['display_title'] = $display_title;
    $response['display_message'] = $display_message;
    $response['users'] = $data;
    
    $json_response = json_encode($response);
    echo $json_response;
}

function getUser($conn, $query) {
    $resultset = mysqli_query($conn, $query) or die(json_encode($response["error"] = mysqli_error($conn)));

    $data = array();
    while ($rows = mysqli_fetch_assoc($resultset)) {
        $data[] = $rows;
    }
    return $data;
}

function updateuser($conn, $query) {
    $resultset = mysqli_query($conn, $query) or die(json_encode($response["error"] = mysqli_error($conn)));

    return $resultset;
}


//$conn->close();

?>