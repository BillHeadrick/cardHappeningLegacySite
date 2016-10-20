<?php
include('../../../../exterior/cardhappeningConnection.php');
if(isset($_POST['id']))
{	//check if they sent the id of the order to be packed
	$id = strip_tags($_POST['id']);
	$q = "SELECT `retailer_item_status` FROM `retailer_item` WHERE  `retailer_item_id` = ".$id;
	$r = mysqli_query($dbc, $q);
	if($r && mysqli_num_rows($r) == 1)
	{
		$r = mysqli_fetch_assoc($r);
		$status = 2;
		if($r['retailer_item_status'] == 0)
		{	//the order had not been previously packed
			$status = 1;	//mark the status as being packed
		}
		else if($r['retailer_item_status'] == 1)
		{	//the item had been previously packed
			$status = 0; //mark the status as being unpacked
		}
		if($status != 2)
		{
			$q = "UPDATE `retailer_item` SET `retailer_item_status`= '$status' WHERE `retailer_item_id` = '$id';";
			$r = mysqli_query($dbc, $q);
		}
		echo $status."asdasgdfg".$id;
	}
}
?>