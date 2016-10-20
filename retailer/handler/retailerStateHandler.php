<?php
/*Retailer Session Values
 * retailer_id = unique id that corresponds to retailer
 * 		-if retailer_id is not set prompt retailer to log in
 * 	
 * login_error = keeps tracks of errors that occur while attempting to log in to retailer account
 * 		-1 means invalid registration code
 */

 //redirect the client to log in page if they are not logged in or not currently on log in page
if($_SESSION['retailer'] == null && $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] != "www.cardhappening.com/retailer/login.php"){
	header('Location: https://www.cardhappening.com/retailer/login.php');
} elseif($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] != "www.cardhappening.com/retailer/login.php" AND !($_SESSION['retailer']->contact->contactExists()) AND $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] != "www.cardhappening.com/retailer/register.php"){
		header('Location: https://www.cardhappening.com/retailer/register.php');
} 
elseif($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] != "www.cardhappening.com/retailer/login.php" AND !($_SESSION['retailer']->contact->getPass()) AND $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] != "www.cardhappening.com/retailer/register.php"){
	header('Location: https://www.cardhappening.com/retailer/register.php');
}

?>