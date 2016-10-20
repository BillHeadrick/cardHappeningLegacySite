<?php

if(isset($_POST['session_id'])){
	$session_id = strip_tags($_POST['session_id']);
	include('../../../exterior/cardhappeningConnection.php');
	include('../function/nameMonth.php');
	$session_id = strip_tags($_POST['session_id']);
	
	$q = "SELECT * FROM `cart` WHERE `session_id` = '".$session_id."' AND `status` = 1;";
	$r = mysqli_query($dbc, $q);
	if($r){
		//item split = "123###456-987~!~!"
		while($result = mysqli_fetch_assoc($r)){
				list($year, $month, $day) = split("-", $result['date']);
				list($day, $junk) = split(" ", $day);
				$month = nameMonth($month);
				 $output = "123###456-987~!~!".$result['cart_id'].",".$result['style'].",".$result['style_id'].",".$result['quantity'].",".$result['price'].",$day $month $year";
				echo $output;
			 /*
					 
					cart->id (correlates to database from ajax call) 
					cart->style
					cart->style_id
					cart->quantity
					cart->date
					cart->price
					cart->active
					
				*/
		}
	}
}


?>