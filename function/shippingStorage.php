<?php
/*
 * Updates the session email
 * adds the address to the database
 * adds address id to $_SESSION[address]
 */
 
function shippingStorage($dbc){
	$email = strip_tags($_POST['email']);
	$first = strip_tags($_POST['firstName']);
	$last = strip_tags($_POST['lastName']);
	$address1 = strip_tags($_POST['address1']);
	$address2 = strip_tags($_POST['address2']);
	$zipcode = strip_tags($_POST['zipcode']);
	$city = strip_tags($_POST['city']);
	$state = strip_tags($_POST['state']);
	$country = strip_tags($_POST['country']);
	
	//add email to session
	$q = "UPDATE `session` SET `email`='$email' WHERE `session_id` = $_SESSION[id];";
	$r = mysqli_query($dbc, $q);
	
	//insert address
	$q = "INSERT INTO `address`(`session_id`, `first`, `last`, `address1`, `address2`, `zipcode`, `city`, `state`, `country`) VALUES ('$_SESSION[id]','$first','$last','$address1','$address2','$zipcode','$city','$state','$country');";
	$r = mysqli_query($dbc, $q);
	if($r){
		$_SESSION['shipping'] = mysqli_insert_id($dbc);
		//echo $_SESSION['shipping'];
		return true;
	}	
}
?>
