<?php
include('../../../../exterior/cardhappeningConnection.php');
if(isset($_POST['id']) && isset($_POST['value'])){
	$id = strip_tags($_POST['id']);
	$value = strip_tags($_POST['value']);
	$q = "UPDATE `cart` SET `status`='$value' WHERE `cart_id` = '$id';";
	$r = mysqli_query($dbc, $q);
	if($r){
		echo $id . "SDFSFDFSWER";	
	}
}
?>