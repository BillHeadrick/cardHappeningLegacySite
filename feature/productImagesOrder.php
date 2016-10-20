<!--<div class='row'>-->
<?php

$q = "SELECT * FROM `product_images` WHERE status = '1';";
$r = mysqli_query($dbc, $q);
if($r){

	while($result = mysqli_fetch_assoc($r)){
		$d = "<div class='col-xs-4 col-sm-4 col-md-4 col-lg-4'><img src='$result[src]' class='style$result[style_id] 240 product-order-image img-rounded' alt='$result[alt]'></div>";
		echo $d;
	}
}

echo "<p class='text-center'><b>Click to Enlarge Image</b></p>";

?>
<?php /*

							<div class='col-xs-6 col-sm-6 col-md-6 col-lg-6' id='product_images1'>
								image one
							</div><!--end of image one-->
							<div class='col-xs-6 col-sm-6 col-md-6 col-lg-6' id='product_images2'>
								image two
							</div><!--end of image 2-->
						</div>
						<div class='row'>
							<div class='col-xs-6 col-sm-6 col-md-6 col-lg-6' id='product_images3'>
								image three
							</div><!--end of image 3-->
							<div class='col-xs-6 col-sm-6 col-md-6 col-lg-6' id='product_images4'>
								image four
							</div><!--end of image 4-->
</div>
 * 
 */
 ?>
