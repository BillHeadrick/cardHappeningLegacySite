<?php
include('../../../exterior/connection.php');
$q = "SELECT * FROM `product_images` WHERE `status` = 1;";
$r = mysqli_query($dbc, $q);
echo $q;
echo $r;
if($r){
	print_r($r);
	while($results = mysqli_fetch_assoc($r)){
		$y = "<img class='style$results[style_id]' alt='$results[alt]' src='$results[src]'>";
		echo $y;
	}
}
?>