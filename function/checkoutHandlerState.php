<?php
if(!isset($_COOKIE['auth']) && !isset($_SESSION['id'])){ //if the user does not have a session started and does not have a cookie set send them to the homepage
 	header('location: https://www.cardhappening.com');
 }
 if(isset($_COOKIE['auth'])){ //make sure session and cookie are same
 	$_SESSION['id'] = $_COOKIE['auth'];
 }
if(!isset($_SESSION['checkout']) || $_SESSION['checkout'] == 3){
	$_SESSION['checkout'] = 0;
	/*
	 * checkout 0: confirmation
	 */
} 
if($_SESSION['checkout'] == 0 && isset($_POST['confirmOrder'])){ //we are moving on to the next item
		$_SESSION['checkout'] = 1; //we are at email, shipping address
		$_SESSION['error'] = null;
}
if($_SESSION['checkout'] == 1 && isset($_POST["email"])){
	//need to do form validation
	//need to store order information
	//include('braintree-php-2.34.0/paymentProcess.php');
	include('function/shippingStorage.php');
	if(shippingStorage($dbc)){
		$_SESSION['checkout'] = 2;
	}
}
if($_SESSION['checkout'] == 2 && isset($_POST["payment_method_nonce"])){
	//$_SESSION['checkout'] = 3;
	include('braintree-php-2.34.0/paymentProcess.php');
	if($_SESSION['checkout'] == 3){
		include('function/confirmationEmail.php');
	}
}
//print_r($_SESSION);


?>