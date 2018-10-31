<?php



include 'config.php';
$email= $_POST['email'];

//echo $id;
$query_get_user = "SELECT * FROM users WHERE email= '$email'";

if ($conn) 
    {
		
	$data =	CheckEmail($conn, $query_get_user);
	
        if (CheckEmail($conn, $query_get_user) != []) 
		{
			//generate token and check role
			//$email =$data[0]['email'];
			$id =$data[0]['id'];
			//	echo $email;
			$token = str_shuffle(base64_encode(date('mdyhis').date('mdyhis')));
			//echo $token;
			$query_update = "update users set remember_token= '$token' where email= '$email'";
			$storeToken = updatetoken($conn, $query_update);
			echo $storeToken;
			if($storeToken)
			{
			 $checkemail = SendEmail($email,$id, $token,"Password Changing Request");
                if ($checkemail) {
                    JSONResponse(200, "An email has been sent to you.", $checkemail);
                }
				else{
					JSONResponse(401, "Mail sending failed", null);
				}
			}
			else
			{
				 JSONResponse(402, "Token Not valid", null);
			}
          
			
			
        } else {
            JSONResponse(404, "User has not registered", null);
        }
    
} 
	else {
			JSONResponse(403, "Unauthorized", null);
		}

function JSONResponse($status, $status_message, $data)
{
    $response['status'] = $status;
    $response['message'] = $status_message;
    $response['result'] = $data;

    $json_response = json_encode($response);
    echo $json_response;
}

//To change this license header, choose License Headers in Project Properties.
//To change this template file, choose Tools | Templates
//and open the template in the editor.
function updatetoken($conn, $query)
{
    $resultset = mysqli_query($conn, $query) or die(json_encode($response["error"] = mysqli_error($conn)));
    return $resultset;
}

function CheckEmail($conn, $query)
{
    $resultset = mysqli_query($conn, $query) or die(json_encode($response["error"] = mysqli_error($conn)));
    $data = array();
    while ($rows = mysqli_fetch_assoc($resultset)) {
        $data[] = $rows;
    }
    return $data;
}

function SendEmail($email,$id, $token,$subject)
{
	$headers = "From: " . "<PAWER>noreply@pawer.com.sg" . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

   /* session_start();
    $_SESSION['name'] = $name;
    $_SESSION['token'] = $token;
    $_SESSION['type'] = $type;

    ob_start();
    include "changepassword.php";
    $message = ob_get_clean();

*/
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
							<p>Please click the below link to change the password</p>
							<br>
						   
							<br><br>
							
							
						</div>
						 <table cellspacing=\"0\" cellpadding=\"0\">
			<tr>
			<td align=\"center\" width=\"150\" height=\"40\" bgcolor=\"#FFD700\" style=\"-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; 					color: #ffffff; display: block;\">
				<a href=\"http://www.ehostingcentre.com/pawer/api/changepassword.php?id=$id&token=$token\" style=\"font-size:16px; font-weight: bold; font-family: Helvetica, Arial, sans-serif; text-decoration: none; line-height:40px; width:100%; display:inline-block\"><span style=\"color: #6A6C6D\">Change Password</span></a>
</td>
<td align=\"center\" width=\"20\" height=\"40\" bgcolor=\"#FFFFFF\" style=\"-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; color: #ffffff; display: block;\">
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
