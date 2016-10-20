<?php
$_SESSION['login_error'] = null;
/*
 *1 incorrect registration code 
 * 2 incorrect password/account combination
 * 3 connection fail
*/
//client tried to login to existing retailer account
if(isset($_POST['retailer_login'])){
	//check credentials
	//update retailer object if true
	//update all sub objects
	//redirect to index
	if($_POST['retailer_account'] != "" AND $_POST['retailer_password'] != "")
	{
		$pass = strip_tags($_POST['retailer_password']);
		$password = '12jkrjsf@#$sf'.$pass;
		$password = sha1($password);
		$q = "SELECT `retailer_id`, `password` FROM `retailer_contact` WHERE `retailer_id` = '$_POST[retailer_account]' OR `email` = '$_POST[retailer_account]';";
		$r = mysqli_query($dbc, $q);
		if($r)	//query WAS SUCCESS
		{
			if(mysqli_num_rows($r) > 0)
			{
				$r = mysqli_fetch_assoc($r);
				if($r['password'] == $password)	
				{
					//correct credentials
					$_SESSION['retailer'] = new RetailerAccount(false, $r['retailer_id'], $dbc);
					if($_SESSION['retailer']->getEstablished())
					{
						header('Location: https://www.cardhappening.com/retailer');
					}
				}
				else 
				{	//incorrect credentials
				$_SESSION['login_error'] = 2;
				}
			}
			else 
			{	//incorrect credentials
				$_SESSION['login_error'] = 2;
			}
		}
		else 
		{		//connection fail
			$_SESSION['login_error'] = 3;
		}
	}
}

//client tried to create account from a sign up code
if(isset($_POST['retailer_sign_up'])){
	//check code
	//if valid generate a retailer id
	//set up basic characteristics, shipping policy, pricing policy, terms and conditions
	//then pass to main
	if($_POST['registration_code'] != "")		//make sure code is not blank
	{
		$code = strtolower($_POST['registration_code']);
		//check if code is valid
		$q = "SELECT `carriage_paid_level`, `standard_shipping_cost`, `expediated_cost`, `payment_due`, `cost_per_card`, `minimum_order` FROM `retailer_template` WHERE `template_name` = '$code';";
		//echo $q;
		$r = mysqli_query($dbc, $q);
		if(mysqli_num_rows($r) >= 1)			//code is valid now we need to create a new object
		{
			$_SESSION['retailer'] = new RetailerAccount(true, $code, $dbc);
			/*Check if new retailer has been successfully generated, if so send to page to complete registration*/
			if($_SESSION['retailer']->accountApproved())
			{
				header('Location: https://www.cardhappening.com/retailer/register.php');
			}
		}
		else
		{
			$_SESSION['login_error'] = 1;
		}
	}
}

?>