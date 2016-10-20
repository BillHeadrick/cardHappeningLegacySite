<?php 
$ppc = 6; //price per card
?>
<div class='row'>
	<div class='hidden-xs col-sm-2 col-md-3 col-lg-3'></div>
	<div class='col-xs-12 col-sm-8 col-md-6 col-lg-6'>
		<div class='panel panel-default panel-body standard-color'>
			<?php 
			checkoutPagination(); 
			?>
			<h2 class='text-center'><i class="fa fa-check"></i> Your order has been placed!</h2>
			<?php
			echo "<p class='text-center'>Your order id is <b>$order_id</b></p>";
			$q = "SELECT * FROM `session` WHERE `session_id` = '$order_id';";
			$r = mysqli_query($dbc, $q);
			if($r){
				$r = mysqli_fetch_assoc($r);
				echo "<p class='text-center'>A confirmation email has been sent to <b>$r[email]</b>.</p>";
			}
			?>
		</div>
			<?php 
			$q = "SELECT * FROM `address` WHERE `session_id` = '$order_id';";
			$r = mysqli_query($dbc, $q);
			if($r){
				$r = mysqli_fetch_assoc($r);
				echo "<div class='panel panel-default panel-body standard-color'>";
				echo "<h3 class='text-center'>Shipping Address</h3>";
				echo "<p class='text-center'>$r[first] $r[last]<br>";
				echo "$r[address1] $r[address2]<br>
				$r[city] $r[state] $r[zipcode] <br> 
				$r[country]</p>";
				echo "</div>";
			}
				$q = "SELECT * FROM `cart` WHERE `session_id` = '$order_id';";
				$r = mysqli_query($dbc, $q);
				if($r){
					echo "<div class='panel panel-default panel-body standard-color'>";
					echo "<h3 class='text-center'>Purchased Items</h3>";
					echo "<table class='table table-hover'>
						<thead>
						<tr>
							<th>Style</th>
							<th>Quantity</th>
							<th>Price</th>
						</tr>
						</thead>
						<tbody class='purchased_body' id='purchased'>";
						while($result = mysqli_fetch_assoc($r)){
							echo "
							<tr>
								<td class='purchased_style' id='purchased_style$result[cart_id]'>$result[style]</td>
								<td class='purchased_quantity' id='purchased_quantity$result[cart_id]'>$result[quantity]</td>
								<td class='purchased_price' id='purchased_price$result[quantity]'>$".$result['quantity'] * $ppc."</td>	
							</tr>
							";
						}
					echo "</tbody></table></div>";
				}
				echo "
					<div class='panel panel-default panel-body standard-color'>
						<h3 class='text-center'>Total Purchase: $".$total."</h3>
						<p class='text-center'>Your items will ship in 2-3 business days.</p>
						<p class='text-center'>Thank you for your order!</p>
					</div>";
					
			?>
			
			<a href='http://www.cardhappening.com' class='btn btn-primary btn-block'><b class='text-center white-text'>Find more awesome cards!</b></a>
			<br>
			<br>
			
		</div>
	</div>
	<div class='hidden-xs col-sm-2 col-md-3 col-lg-3'></div>
</div>