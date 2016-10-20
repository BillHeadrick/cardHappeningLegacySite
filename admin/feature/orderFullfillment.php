<div class='hidden-xs col-sm-2 col-md-2 col-lg-2'></div>
<div class='col-xs-12 col-sm-8 col-md-8 col-lg-8'>
	<div class='panel standard-color panel-body'>
		<p class='text-center statement'>www.CardHappening.com Order Fullfillment</p>
<?php
		$q = "SELECT sale.session_id, sale.address_id, sale.date, sale.total, sale.shipping, cart.cart_id, cart.style, cart.style_id, cart.quantity, cart.status, address.first, address.last, address.address1, address.address2, address.zipcode, address.city, address.state, address.country, session.email 
FROM `sale`, `cart`, `address`, `session`
WHERE sale.status = 1 AND cart.session_id = sale.session_id AND address.address_id = sale.address_id AND sale.session_id = session.session_id;";
		$r = mysqli_query($dbc, $q);
		$id = null;
		$i = mysqli_num_rows($r);
		while($result = mysqli_fetch_assoc($r)){
			$i++;//use i to keep track of where we are
			$id = $result['session_id'];
			echo "<div class='panel panel-default panel-body'>
			<p class='text-center'><b>Order #$id</b> $result[date]</p><p class='text-center'>Customer Contact: $result[email]</p>
			<p class='text-center'><b>$result[first] $result[last]</b><br>$result[address1]<br>";
			if($result['address2'] != ""){
			echo "$result[address2]<br>";
			}
			echo "$result[city], $result[state] $result[zipcode] <br> $result[country]</p>
			<p class='pull-left'>Shipping: ";
			if($result['shipping'] == 0){
				echo "complimentary";
			} else {
				if($result['shipping'] > 0){
					echo "$".$result['shipping'];
				}
			}
echo "		</p>
			<p class='pull-right'>Order Total: $$result[total]</p>
			<table class='table table-hover'><tr><th>Item Id</th><th>Item</th><th>Quantity</th><th>Packaged</th></tr>
			<tr><td>$result[cart_id]</td><td>$result[style]</td><td>$result[quantity]</td>"; //this handles the first case
			if($result['status'] == 1){
				echo "<td><button class='btn btn-default pack' id='pack$result[cart_id]'>Pack</td></tr>";
			}
			else if($result['status'] == 2){
				echo "<td><button class='btn btn-primary pack' id='pack$result[cart_id]'>Packed<i class='fa fa-check'></i></td></tr>";
			}
			//to handle all the future cases
			while($result = mysqli_fetch_assoc($r) AND $id == $result['session_id']){
				$i++;
				echo "<tr><td>$result[cart_id]</td><td>$result[style]</td><td>$result[quantity]</td>"; //this handles the first case
				if($result['status'] == 1){
					echo "<td><button class='btn btn-default pack' id='pack$result[cart_id]'>Pack</td></tr>";
				}
				else if($result['status'] == 2){
					echo "<td><button class='btn btn-primary pack' id='pack$result[cart_id]'>Packed<i class='fa fa-check'></i></td></tr>";
				}
			}
			mysqli_data_seek($r, $i);
			
			
			
			
echo    "</table><button type='button' class='btn btn-default btn-block orderShipped' id='orderShipped$id'>Ship Order <i class='fa fa-truck'></i></button></div>";
		}


?>
	<form name="orderFullfillment" id='orderFullfillment' action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
	</form>
	</div>
	<?php //right here start with the retailer order fullfillment ?>
	<div class='panel panel-body standard-color'>
		<p class='text-center statement'>Wholesale Order Fullfillment</p>
		<?php
		$q = "SELECT retailer_order.retailer_order_id, retailer_order.retailer_id, retailer_order.date, retailer_order.retailer_address_id, retailer_order.braintree_transaction_id, retailer_order.status, retailer_order.total, retailer_order.shipping_method, retailer_order.shipping_cost, retailer_order.order_cost, retailer_order.tracking_number, retailer_order.purchase_order, retailer_item.style_id, retailer_item.retailer_item_id, retailer_item.quantity, retailer_item.price, retailer_item.retailer_item_status, retailer_address.company, retailer_address.retailer_address_id, retailer_address.attention, retailer_address.address_1, retailer_address.address_2, retailer_address.city, retailer_address.state, retailer_address.postal_code, retailer_address.country, style.style, style.upc, retailer_payment_profile.cost_per_card, retailer_payment_profile.minimum_order
FROM retailer_order, retailer_item, retailer_address, style, retailer_payment_profile
WHERE retailer_order.status = '0' AND retailer_order.retailer_order_id = retailer_item.retailer_order_id AND retailer_order.retailer_address_id = retailer_address.retailer_address_id AND style.style_id = retailer_item.style_id AND retailer_payment_profile.retailer_id = retailer_order.retailer_id
ORDER BY retailer_order.date DESC;";
		$r = mysqli_query($dbc, $q);
		if($r)
		{
			$rid = 0;
			$array_index = 0;
			while($result = mysqli_fetch_assoc($r))
			{
				if($rid == 0)
				{	//case that we are starting
					$rid = $result['retailer_order_id'];
					if($result['date'] != "")
					{
							$date = explode(" ",$result['date']);
							$date = explode("-", $date[0]);
							$day = $date[2];
							$month = nameMonth($date[1]);
							$year = $date[0];
							$date = $day . " ".$month." ".$year;
					}
					else
					{
						$date = "";
					}
					$address = "";
					if($result['company'] != "")
					{
						$address = $address . $result['company'] . "<br>";
					}
					if($result['attention'] != "")
					{
						$address = $address . "Attn: ". $result['attention'] . "<br>";
					}
					if($result['address_1'] != "")
					{
						$address = $address . $result['address_1'] . "<br>";
					}
					if($result['address_2'] != "")
					{
						$address = $address . $result['address_2'] . "<br>";
					}
					if($result['city'] != "")
					{
						$address = $address . $result['city'];
					}
					if($result['state'] != "")
					{
						$address = $address .", ". $result['state'];
					}
					if($result['postal_code'] != "")
					{
						$address = $address ." ". $result['postal_code'] . "<br>";
					}
					if($result['country'] != "")
					{
						$address = $address . $result['country'] . "<br>";
					}
					$shippingCost = $result['shipping_cost'];
					if($shippingCost == 0)
					{
						$shippingCost = "Complimentary";
					}
					echo "
					<div class='panel panel-body panel-default'>";
					if($result['purchase_order'] != "")
					{
						echo "<p class='statement text-center'>Purchase Order:".$result['purchase_order']."</p>";
					}
					echo "
						<div class='panel panel-body panel-default'>
							<table class='table'>
								<tr>
									<th>Order ID</th>
									<th>Company</th>
									<th>PPC</th>
									<th>Minimum Order</th>
									<th>Date</th>
								</tr>
								<tr>
									<td>".$result['retailer_order_id']."</td>
									<td>".$result['company']."</td>
									<td>$".$result['cost_per_card']."</td>
									<td>$".$result['minimum_order']."</td>
									<td>$date</td>
								</tr>
							</table>
						</div>
						
						<div class='panel panel-body panel-default'>
							<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
								<p class='statment text-center'>Address:</p>
								<p class='text-center'>
								$address
								</p>
							</div>
							<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
								<table class='table'>
									<tr>
										<th><p class='text-center'>Shipping Method</p></th>
										<th><p class='text-center'>Shipping Cost</p></th>
									</tr>
									<tr>
										<td><p class='text-center'>".$result['shipping_method']."</p></td>
										<td><p class='text-center'>$shippingCost</p></td>
									</tr>
								</table>
							</div>
						</div>
						<p class='text-center statement'>Order Total: $".$result['total']."</p>
						<form name='retailerOrderProcess' action='". htmlentities($_SERVER['PHP_SELF'])."' method='post' id='form".$result['retailer_order_id']."'>
							<div class='row'>
								<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
									<div class='form-group'>
									<label for='trackingNumber'>Tracking Number</label>
									<input type='text' class='form-control' name='trackingNumber' id='trackingNumber".$result['retailer_order_id']."'>
									</div>
								</div>
								<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
									<button type='button' class='btn btn-block btn-default btn-lg retailerShip' id='retailerShip".$result['retailer_order_id']."'>Ship!</button>
									<input type='hidden' name='orderID' value='".$result['retailer_order_id']."'>
								</div>
							</div>
						</form>
						<div class='panel panel-body panel-default'>
							<table class='table'>
								<tr>
									<th><p class='text-center'>UPC</p></th>
									<th><p class='text-center'>Style</p></th>
									<th><p class='text-center'>Quantity</p></th>
									<th><p class='text-center'>Price</p></th>
									<th><p class='text-center'>Packed</p></th>
								</tr>
								<tr>
									<td><p class='text-center'>".$result['upc']."</p></td>
									<td><p class='text-center'>".$result['style']."</p></td>
									<td><p class='text-center'>".$result['quantity']."</p></td>
									<td><p class='text-center'>$".$result['quantity']*$result['cost_per_card']."</p></td>
									<td><button type='button' id='retailerPack".$result['retailer_item_id']."' class='btn btn-block retailerPackButton ";
						if($result['retailer_item_status'] == 0)
						{
							echo "btn-default";
						}
						else
						{
							echo "btn-primary";
						}
						echo "
									'>";
						if($result['retailer_item_status'] == 0)
						{
							echo "Pack";
						}
						else
						{
							echo "Packed";
						}		
								"</button></td>
								</tr>
					";
				}
				else if($rid == $result['retailer_order_id'])
				{	//we have another item in the same order
					echo "								
						<tr>
						<td><p class='text-center'>".$result['upc']."</p></td>
						<td><p class='text-center'>".$result['style']."</p></td>
						<td><p class='text-center'>".$result['quantity']."</p></td>
						<td><p class='text-center'>$".$result['quantity']*$result['cost_per_card']."</p></td>
						<td><button type='button' id='retailerPack".$result['retailer_item_id']."' class='btn btn-block retailerPackButton ";
						if($result['retailer_item_status'] == 0)
						{
							echo "btn-default";
						}
						else
						{
							echo "btn-primary";
						}
						echo "
									'>";
						if($result['retailer_item_status'] == 0)
						{
							echo "Pack";
						}
						else
						{
							echo "Packed";
						}		
								"</button></td>
								</tr>
					";
				}
				else if($rid != $result['retailer_order_id'])
				{	//we have a new order id
					$rid = $result['retailer_order_id'];
					echo "
					</table>
					</div>
					</div>
					";
					if($result['date'] != "")
					{
							$date = explode(" ",$result['date']);
							$date = explode("-", $date[0]);
							$day = $date[2];
							$month = nameMonth($date[1]);
							$year = $date[0];
							$date = $day . " ".$month." ".$year;
					}
					else
					{
						$date = "";
					}
					$address = "";
					if($result['company'] != "")
					{
						$address = $address . $result['company'] . "<br>";
					}
					if($result['attention'] != "")
					{
						$address = $address . "Attn: ". $result['attention'] . "<br>";
					}
					if($result['address_1'] != "")
					{
						$address = $address . $result['address_1'] . "<br>";
					}
					if($result['address_2'] != "")
					{
						$address = $address . $result['address_2'] . "<br>";
					}
					if($result['city'] != "")
					{
						$address = $address . $result['city'];
					}
					if($result['state'] != "")
					{
						$address = $address .", ". $result['state'];
					}
					if($result['postal_code'] != "")
					{
						$address = $address ." ". $result['postal_code'] . "<br>";
					}
					if($result['country'] != "")
					{
						$address = $address . $result['country'] . "<br>";
					}
					$shippingCost = $result['shipping_cost'];
					if($shippingCost == 0)
					{
						$shippingCost = "Complimentary";
					}
					echo "
					<div class='panel panel-body panel-default'>";
					if($result['purchase_order'] != "")
					{
						echo "<p class='statement text-center'>Purchase Order:".$result['purchase_order']."</p>";
					}
					echo "
						<div class='panel panel-body panel-default'>
							<table class='table'>
								<tr>
									<th>Order ID</th>
									<th>Company</th>
									<th>PPC</th>
									<th>Minimum Order</th>
									<th>Date</th>
								</tr>
								<tr>
									<td>".$result['retailer_order_id']."</td>
									<td>".$result['company']."</td>
									<td>$".$result['cost_per_card']."</td>
									<td>$".$result['minimum_order']."</td>
									<td>$date</td>
								</tr>
							</table>
						</div>
						
						<div class='panel panel-body panel-default'>
							<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
								<p class='statment text-center'>Address:</p>
								<p class='text-center'>
								$address
								</p>
							</div>
							<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
								<table class='table'>
									<tr>
										<th><p class='text-center'>Shipping Method</p></th>
										<th><p class='text-center'>Shipping Cost</p></th>
									</tr>
									<tr>
										<td><p class='text-center'>".$result['shipping_method']."</p></td>
										<td><p class='text-center'>$shippingCost</p></td>
									</tr>
								</table>
							</div>
						</div>
						<p class='text-center statement'>Order Total: $".$result['total']."</p>
						<form name='retailerOrderProcess' action='". htmlentities($_SERVER['PHP_SELF'])."' method='post' id='form".$result['retailer_order_id']."'>
							<div class='row'>
								<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
									<div class='form-group'>
									<label for='trackingNumber'>Tracking Number</label>
									<input type='text' class='form-control' name='trackingNumber' id='trackingNumber".$result['retailer_order_id']."'>
									</div>
								</div>
								<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
									<button type='button' class='btn btn-block btn-default btn-lg retailerShip' id='retailerShip".$result['retailer_order_id']."'>Ship!</button>
									<input type='hidden' name='orderID' value='".$result['retailer_order_id']."'>
								</div>
							</div>
						</form>
						<div class='panel panel-body panel-default'>
							<table class='table'>
								<tr>
									<th><p class='text-center'>UPC</p></th>
									<th><p class='text-center'>Style</p></th>
									<th><p class='text-center'>Quantity</p></th>
									<th><p class='text-center'>Price</p></th>
									<th><p class='text-center'>Packed</p></th>
								</tr>
								<tr>
									<td><p class='text-center'>".$result['upc']."</p></td>
									<td><p class='text-center'>".$result['style']."</p></td>
									<td><p class='text-center'>".$result['quantity']."</p></td>
									<td><p class='text-center'>$".$result['quantity']*$result['cost_per_card']."</p></td>
									<td><button type='button' id='retailerPack".$result['retailer_item_id']."' class='btn btn-block retailerPackButton ";
						if($result['retailer_item_status'] == 0)
						{
							echo "btn-default";
						}
						else
						{
							echo "btn-primary";
						}
						echo "
									'>";
						if($result['retailer_item_status'] == 0)
						{							
							echo "Pack";
						}
						else
						{
							echo "Packed";
						}		
								"</button></td>
								</tr>
					";
				} 
			}
			if($i > 0)
			{
				echo "</table></div></div>";
			}
		}
		?>
	</div>
</div>
<div class='hidden-xs col-sm-2 col-md-2 col-lg-2'></div>


