<?php
include('../../../../exterior/cardhappeningConnection.php');
if(isset($_POST['email']))
{	//checks whether or not the email already exists in the database
	$q = "SELECT * FROM `retailer_contact` WHERE `email` = '$_POST[email]'";
	$r = mysqli_query($dbc, $q);
	if($r){
		if(mysqli_num_rows($r) > 0){
		 	echo "false";
		}
		else{
			echo "true";
		}
	}
	else { echo "false"; }
}
?>