<?php 
$_SESSION['error'] = 0;
if(isset($_POST['update']))
{
	/*
	 * 1 if the wrong password was used
	 * 2 if an email was inserted that already is in the database
	 */
	//check if the password is correct
	$pass = strip_tags($_POST['currentPassword']);
	$password = '12jkrjsf@#$sf'.$pass;
	$password = sha1($password);
	$q = "SELECT `password` FROM `retailer_contact` WHERE `retailer_id` = '".$_SESSION['retailer']->getRetailerId()."';";
	$r = mysqli_query($dbc, $q);
	if($r)
	{
		//echo "query was a success";
		$r = mysqli_fetch_assoc($r);
		if($r['password'] == $password)
		{
			//echo "the passwords matched";
			if($_POST['company'] != "")
			{
				$_SESSION['retailer']->contact->updateCompany($dbc, $_SESSION['retailer']->getRetailerId(), $_POST['company']);
			}
			if($_POST['firstName'] != "")
			{
				$_SESSION['retailer']->contact->updateFirstName($dbc, $_SESSION['retailer']->getRetailerId(), $_POST['firstName']);
			}
			if($_POST['lastName'] != "")
			{
				$_SESSION['retailer']->contact->updateLastName($dbc, $_SESSION['retailer']->getRetailerId(), $_POST['lastName']);
			}
			if($_POST['position'] != "")
			{
				$_SESSION['retailer']->contact->updatePosition($dbc, $_SESSION['retailer']->getRetailerId(), $_POST['position']);
			}
			if($_POST['email'] != "")
			{
				if(strtolower($_POST['email']) != strtolower($_SESSION['retailer']->contact->getEmail()))
				{
					$q = "SELECT * FROM `retailer_contact` WHERE `email` = '".strtolower($_POST['email'])."';";
					$r = mysqli_query($dbc, $q);
					if($r)
					{
						if(mysqli_num_rows($r) == 0)
						{
							$_SESSION['retailer']->contact->updateEmail($dbc, $_SESSION['retailer']->getRetailerId(), $_POST['email']);
						}
						else
						{
							$_SESSION['error'] = 2;
						}
					}
				}
			}
			if($_POST['phone'] != "")
			{
				$_SESSION['retailer']->contact->updatePhone($dbc, $_SESSION['retailer']->getRetailerId(), $_POST['phone']);
			}
			if($_POST['newPassword'] != "" && strlen($_POST['newPassword']) >= 6)
			{
				$_SESSION['retailer']->contact->updatePass($_POST['newPassword'], $dbc, $_SESSION['retailer']->getRetailerId());
			}
		}
		else 
		{
			$_SESSION['error'] = 1;
		}
	}
}
?>
