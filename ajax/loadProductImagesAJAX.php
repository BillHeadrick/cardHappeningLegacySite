<?php
include('../../../exterior/cardhappeningConnection.php');
$q="SELECT * FROM `product_images` WHERE `status` = '1';";
$r = mysqli_query($dbc, $q);
if($r){ //split = "<987&789*#$2"
	while($result = mysqli_fetch_assoc($r)){
		$output = "<987&789*#$2".$result['style'].",".$result['style_id'].",".$result['src'].",".$result['alt'].",".$result['order'];
		echo $output;
	}
}

?>