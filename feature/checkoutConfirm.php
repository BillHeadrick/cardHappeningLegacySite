<div class="row">
	<div class="hidden-xs col-sm-2 col-md-3 col-lg-3"></div>
	<div class="xs-12 col-sm-8 col-md-6 col-lg-6">
		<div class="panel panel-default panel-body standard-color">
			
				<?php
				checkoutPagination();
				?>
		
			
				<?php
				$q = "SELECT * FROM `cart` WHERE `session_id` = '$_SESSION[id]';";
				$r = mysqli_query($dbc, $q) or die(mysqli_error($dbc));
				if(mysqli_num_rows($r)==0 || !$r){//if there are no items in the cart or query failed
					
					echo "<p class='text-center'>Looks like your cart is empty.</p>";
					echo "<div class='row'>
					<div class='col-xs-3 col-sm-3 col-md-3 col-lg-3'></div>
					<div class='col-xs-6 col-sm-6 col-md-6 col-lg-6'>
					<a href='http://www.cardhappening.com' class='btn btn-default btn-block'><b class='text-center'>Find Awesome Cards!</b></a>
					<br>
					</div>
					<div class='col-xs-3 col-sm-3 col-md-3 col-lg-3'></div>
					</div>";
				} else{ //output order in table
					echo "<form id='checkoutConfirmForm' action='";
					echo htmlentities($_SERVER['PHP_SELF'])."'"; 
					echo" method='post'>";
					echo '
					<table class="table table-hover">
						<thead>
						<tr>
							<th> </th>
							<th>Style</th>
							<th>Quantity</th>
							<th>Price</th>
						</tr>
						</thead>
						<tbody class="confirm_body" id="confirm">
						';
						
						$q = "SELECT SUM(quantity) FROM `cart` WHERE `session_id` = $_SESSION[id];";
						$quantity = mysqli_query($dbc, $q);
						if($quantity){ //get the ammount of cards in order to determine prices
							$quantity = mysqli_fetch_assoc($quantity);
							$quantity = $quantity['SUM(quantity)'];
							if($quantity > 75){
								$ppc = 6;
							} else {
								$ppc = 6;
							}
							$totalPrice = 0;
							//ouput order information
							while($result = mysqli_fetch_assoc($r)){
								//print_r($result);
								settype($result['quantity'], 'integer');
								echo "
								<tr>
									<td><button type='button' class='btn btn-default confirmRemove' id='confirmRemove$result[cart_id]'><span class='fa fa-times'></span></button></td>
									<td class='confirmStyle' id='confirmStyle$result[cart_id]'>$result[style]</td>
									<td class='confirmQuantity' id='confirmQuantity$result[cart_id]'>$result[quantity]</td>
									<td class='confirmPrice' id='confirmPrice$result[quantity]'>$".$result['quantity'] * $ppc."</td>	
								</tr>
									";
								$totalPrice = $totalPrice + $result['quantity'] * $ppc;
							}
							echo "</tbody>";
							echo "</table>";
							echo "</form>";
							echo "</div>";
							echo "<div class='panel panel-default panel-body standard-color'>";
							echo "
							
							<div class='row'>
								<div class='col-xs-6 col-sm-6 col-md-8 col-lg-8'>
									<form name='confirmOrderForm' action = '";
									echo htmlspecialchars($_SERVER['PHP_SELF']);
									
							echo "' method='post'>
									<button class='btn btn-primary btn-block' name='confirmOrder' id='confirmOrder'><h3 class='text-center'>Confirm Order</button>
									</form>
								</div>
								<div class='col-xs-6 col-sm-6 col-md-4 col-lg-4'>
									<b id='confirmShipping' >Shipping: ";
									if($totalPrice >= 50){
										$shipping = "complimentary";
										echo $shipping;
									} else{
										$shipping = 3.5;
										echo "$".$shipping;
									}
									echo "</b><br>
									<b id='confirmTotal'>Total: $";
									
									if ($shipping == "complimentary"){ //store total price and shipping price to be stored in database
										$_SESSION['total'] = $totalPrice;
										$_SESSION['shipping_total'] = 0;
										echo $totalPrice;
									} else {
										$_SESSION['total'] = $totalPrice + 3.5;
										$_SESSION['shipping_total'] = 3.5;
										echo $totalPrice+3.5;
									}
								echo "	
								</div>
							</div>
							";
							echo "</div>";
							
						}
						
						
					
				}
				?>
		<div class='row'>		
			<a href='http://www.cardhappening.com' class="btn btn-default btn-block" id="revise_order">
				<b class="text-center"><i class="fa fa-arrow-left"></i> Revise Order</b>
			</a>
		</div>
	</div>
	<div class="hidden-xs col-sm-2 col-md-3 col-lg-3"></div>
</div>
<br>
<br>
