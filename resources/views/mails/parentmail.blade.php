<html>
		<head>
			<meta charset='utf-8' />
			<meta http-equiv='X-UA-Compatible' content='IE=edge'>
			<title>PAWER</title>
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
			<div class='image' style='text-align:center;'></div>
			<div>
				<p>Your Child has applied for PAWER . Please Approve or Reject this application. Thank you</p> <br><br><br>
		</div>
        
        <input type="hidden" name="email"  value = $email/>


		 <table cellspacing=\"0\" cellpadding=\"0\">
			<tr>
			<td align="center" width="150" height="40" bgcolor="#FFD700" style="-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; 					color: #ffffff; display: block;">
				 <a href="{{action('ReguserController@statusaccept', $email )}}" style="font-size:16px; font-weight: bold; font-family: Helvetica, Arial, sans-serif; text-decoration: none; line-height:40px; width:100%; display:inline-block"><span style="color: #6A6C6D">Approve</span></a>
			</td>
			<td align="center" width="20" height="40" bgcolor="#FFFFFF" style="-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; color: #ffffff; display: block;">
			</td>
			<td align="center" width="150" height="40" bgcolor="#04eaf2" style="-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; 	color: #ffffff; display: block;">
				 <a href="{{action('ReguserController@statusreject', $email )}}"style="font-size:16px; font-weight: bold; font-family: Helvetica, Arial, sans-serif; text-decoration: none; line-height:40px; width:100%; display:inline-block"><span style="color: #6A6C6D">Reject</span></a>
			</td>
			</tr>
	</table>
	</div>
	</div>
			<p>
			<b>PAWER LEARNING App </b> is supported by Lifelong learning Council
<br/><br/>
<img src="http://ehostingcentre.com/pawer/pawerlogo.png" alt=logo width="80" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<img src="http://ehostingcentre.com/pawer/skillsfuturesg.png" alt=logo width="80" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<img src="http://ehostingcentre.com/pawer/wsg.png" alt=logo width="80" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<img src="http://ehostingcentre.com/pawer/lifelong-logo.png" alt=logo width="80"/>
<br/><br/><br/>
Kelvin Goh<br/>
Bachelor of Business Admin (NUS) <br/>
Master of Arts, Education Management (NIE/NTU)<br/>
Chief Trainer/Founder - PAWER Skills Consultancy<br/>

Email            : admin@pawer.com.sg <br/>
Website          : www.pawer.com.sg<br/>
Add us in FACEBOOK: www.facebook.com/pawerskills<br/>
</p>

		</body>
	</html>