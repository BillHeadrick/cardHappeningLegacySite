<?php
/* 1. Check for contact form
 * 2. Check for password form
 */
 
if(isset($_POST['company']))
{
	$company = strip_tags($_POST['company']);
	$first = strip_tags($_POST['firstName']);
	$last = strip_tags($_POST['lastName']);
	$position = strip_tags($_POST['position']);
	//all emails are stored in lower case
	$email = strip_tags($_POST['email']);
	$email = strtolower($email);
	$phone = strip_tags($_POST['phone']);

	$_SESSION['retailer']->contact->newContact($first, $last, $email, $position, $company, $phone, $_SESSION['retailer']->getRetailerId(), $dbc);
}
if(isset($_POST['password1']))
{	
	$_SESSION['retailer']->contact->updatePass($_POST['password1'], $dbc, $_SESSION[retailer]->getRetailerId());
	if($_SESSION['retailer']->contact->getPass())
	{
		header("location: https://www.cardhappening.com/retailer");
	}

}

?>