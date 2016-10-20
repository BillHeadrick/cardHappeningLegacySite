<?php
//take contents of a cart and add them to database
//retrieve values from database and calculate them into a string to be echoed and processed by javascript into cart object,



include('../../../exterior/cardhappeningConnection.php');
include('../function/nameMonth.php');

if(isset($_POST['style_id']) && isset($_POST['style']) && isset($_POST['quantity']) && isset($_POST['price']) && isset($_POST['session_id'])){
	$style_id = strip_tags($_POST['style_id']);
	$style = strip_tags($_POST['style']);
	$quantity = strip_tags($_POST['quantity']);
	$price = strip_tags($_POST['price']);
	$session_id = strip_tags($_POST['session_id']);
	$q = "INSERT INTO `cart`( `session_id`, `style`, `style_id`, `quantity`) VALUES ('$session_id', '$style', '$style_id', '$quantity');";
	$r = mysqli_query($dbc, $q);
	if($r){
		$id = mysqli_insert_id($dbc);
		$q = "SELECT * FROM `cart` WHERE `cart_id` = '$id';";
		$r = mysqli_query($dbc, $q);
		if($r){
			$result = mysqli_fetch_assoc($r);
			list($year, $month, $day) = split("-", $result['date']);
			list($day, $junk) = split(" ", $day);
			$month = nameMonth($month);
			echo "$style,$style_id,$quantity,$price,$day $month $year,$id";
			exit;
		}
	} else {echo "false";}
}



//style_id:style_id, style:style, quantity:quantity, price:price, session_id:cart_id

?>