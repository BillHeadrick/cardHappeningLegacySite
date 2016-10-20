<?php
/*
 * recovery
 * 0 means no attempt made and to show them the display
 * 1 means that there email was not found
 * 2 means success and email sent
 * 3 means we have encountered a weird server side error or the email didnt send
 */
if($_SESSION['recovery'] == null)
{
	$_SESSION['recovery'] = 0;
}
if($_SESSION['recovery'] == 0 && isset($_POST['email']) || $_SESSION['recovery'] == 1 && isset($_POST['email'])) 
{
	$email = strip_tags($_POST['email']);
	$email = strtolower($email);
	$q = "SELECT `retailer_id` FROM `retailer_contact` WHERE `email` = '$email';";
	echo $q;
	$r = mysqli_query($dbc, $q);
	if($r)
	{
		if(mysqli_num_rows($r) > 0)
		{	//the email account exists
			$r = mysqli_fetch_assoc($r);
			$randomPassword = randomPassword();
			//echo $randomPassword;
			$password = '12jkrjsf@#$sf'.$randomPassword;
			$password = sha1($password);
			$q = "UPDATE `retailer_contact` SET `password`= '$password' WHERE `retailer_id` = '".$r['retailer_id']."';";
			$r = mysqli_query($dbc, $q);
			if($r)
			{	//now we need to send an email
				$_SESSION['recovery_email'] = $email;
				$message = "
	<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
		<html xmlns='http://www.w3.org/1999/xhtml'>
			<head>
    	 		<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
        		<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
    			<title>Card Happening Retailer Password Recovery</title>
			</head>
			<body style='margin: 0; padding: 0;'>
  			<table border='0' cellpadding='0' cellspacing='0' width='100%'>
            	<tr>
                	<td bgcolor='#E6EAFA'>
           				<table align='center' border='0' cellpadding='0' cellspacing='0' width='600' style='border-collapse: collapse;' bgcolor='#E6EAFA'>
                        	<tr>
                            	<td>
                                 	<img style='max-height:120px; display:block; margin-left:auto; margin-right:auto;' class='logo' src='https://www.cardhappening.com/images/logo.jpg' alt='Card Happening'></img>
                             	</td>
                         	</tr>
                         	<tr>
                         	<td>
                         	<p>Your password has been reset to: $randomPassword</p>
                         	<br>
                         	<a href='https://www.cardhappening.com/retailer'>Click here to log in with your new password.</a>
                         	<br>
                         	<p>To reset your password:
                         	<br>
                         	1. Log in with your new password: $randomPassword
                         	<br>
                         	2. Once logged in go to 'Account Management'
                         	<br>
                         	3. Once on the account management page click 'Update Contact Info'
                         	<br>
                         	4. Enter your new desired password and your current one which is: $randomPassword
                         	<br>
                         	<br>
                         	<br>
                         	Thank you for carrying Card Happening's hand-painted cards.
                         	<br>
                         	<br>
                         	If you need any assistance please call William at 214-728-2262 or email him at william@cardhappening.com</p>
                         	</td>
                         	</tr>
                         </table>
                        </td>
                       </tr>
                      </table>
                     </body>
                    </html>";
                    $subject = "Card Happening Retailer Password Recovery";
            $message = wordwrap($message, 70, "\r\n");			
			$header = "From:cardhappening@cardhappening.com \r\n";
			$header = $header . "Bcc: receipts@cardhappening.com \r\n";
			$header = $header . "Reply-To: william@cardhappening.com \r\n";
			$header = $header . "MIME-Version: 1.0 \r\n";
			$header = $header . "Content-type:text/html; charset=UTF-8 \r\n";
			$i = mail($email, $subject, $message, $header);
			if($i)
			{
				$_SESSION['recovery'] = 2;
			}
			else{
				$_SESSION['recovery'] = 3;
			}
			}
			else 
			{	//we need to tell the user we had a server side error and that they should try again
			$_SESSION['recovery'] = 3;	
			}
		}
		else 
		{
			$_SESSION['recovery'] = 1;	
		}
	}
}

function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
?>