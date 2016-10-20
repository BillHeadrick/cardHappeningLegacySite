<?php
$q = "SELECT * FROM `style` WHERE `status` = 1;";
$r = mysqli_query($dbc, $q);
if($r)
{
	while($result = mysqli_fetch_assoc($r))
	{
		$q = "SELECT * FROM `product_images` WHERE `style_id` = '$result[style_id]' AND `status` = '1';";
		$r1 = mysqli_query($dbc, $q);
		if($r1){
		echo "
			<div class='panel panel-body panel-default'>
				<div class='row'>
					<div class='col-xs-6 col-sm-3 col-md-3 col-lg-3'>
						<p class='statement text-center'>$result[style]</p>
						<p class='text-center'>UPC: $result[upc]</p>
					</div>";
					if($image_array = mysqli_fetch_assoc($r1)){
						echo "
					<div class='col-xs-6 col-sm-3 col-md-3 col-lg-3'>
						<img src='$image_array[src]' alt='$image_array[alt]' class='product-order-image img-rounded'>
					</div>";
					}
					if($image_array = mysqli_fetch_assoc($r1)){
						echo "
					<div class='hidden-xs col-sm-3 col-md-3 col-lg-3'>
						<img src='$image_array[src]' alt='$image_array[alt]' class='product-order-image img-rounded'>
					</div>";
					}
					if($image_array = mysqli_fetch_assoc($r1)){
						echo "
						<div class='hidden-xs col-sm-3 col-md-3 col-lg-3'>
							<img src='$image_array[src]' alt='$image_array[alt]' class='product-order-image img-rounded'>
						</div>";
					}
					echo "
				</div>
				<div class='row'>
					<div class='col-xs-12 col-sm-9 col-md-9 col-lg-9'>
						<p class='text-center statement'>Description:</p>
						<p class='text-center'>$result[description]</p>
					</div>
					<div class='col-xs-6 col-sm-3 col-md-3 col-lg-3'>
						<p class='text-center statement'>Quantity</p>
						<input type='number' min='0' class='form-control' placeholder='0' name='style$result[style_id]' id='style$result[style_id]'>
						<p class='text-center statement'>
							Price: <br>
							<b id='style$result[style_id]Cost'>
							$0
							</b>
						</p>
					</div>

				</div>
			</div>";
		}

	}
}
?>