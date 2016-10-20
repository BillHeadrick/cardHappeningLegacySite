<?php

if(isset($_POST['id'])){
	$id = strip_tags($_POST['id']);
	include('../../../exterior/cardhappeningConnection.php');
	$q = "DELETE FROM `cart` WHERE `cart_id` = '$id';";
	$r = mysqli_query($dbc, $q);
	if($r){
		echo "it was a success";
	} else {echo "it was a failure";}
}


?>