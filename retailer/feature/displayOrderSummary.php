<?php
if($_SESSION['retailer']->cart->getPurchaseOrder() != "")
{
	echo "<p class='statement text-center'><b>Order ".$_SESSION['retailer']->cart->getPurchaseOrder()."</b></p>";
}
else 
{
	echo "<p class='statement text-center'><b>Order</b></p>";
}


//output the cart
$q = "SELECT * FROM `product_images` WHERE `status` = 1;";	//only have to run the query once
$r = mysqli_query($dbc, $q);
if($r)
{
	echo "	
		<form name='completeOrder' action='". htmlentities($_SERVER['PHP_SELF'])."' method='post' id='completeOrder'>
		<div class='panel panel-body'>
			<div class='row'>
				<table class='table'>
				<tr>
					<th class='col-xs-3 col-sm-3 col-md-3 col-lg-3'></th>
					<th class='col-xs-3 col-sm-3 col-md-3 col-lg-3'><p class='text-center statement'>Style</p></th>
					<th class='col-xs-2 col-sm-2 col-md-2 col-lg-2'><p class='text-center statement'>UPC</p></th>
					<th class='col-xs-2 col-sm-2 col-md-2 col-lg-2'><p class='text-center statement'>Quantity</p></th>
					<th class='col-xs-2 col-sm-2 col-md-2 col-lg-2'><p class='text-center statement'>Price</p></th>
				</tr>";
	for($i = 0; $i < $_SESSION['retailer']->cart->getLength(); $i++)
	{
		echo "
				<tr>
					<td>";
		if(mysqli_data_seek($r, 0))
		{	//set the result index to 0
			while($images = mysqli_fetch_assoc($r))
			{
				if($images['style_id'] == $_SESSION['retailer']->cart->cart[$i]->getStyleID())
				{
					echo "<img src='$images[src]' alt='$images[alt]' class='product-order-image img-rounded'>";
					break;
				}
			}
		}
		echo "	
					</td>
					<td>
						<p class='text-center statement'>".$_SESSION['retailer']->cart->cart[$i]->getStyle()."</p>
					</td>
					<td>
						<p class='text-center statement'>".$_SESSION['retailer']->cart->cart[$i]->getUPC()."</p>
					</td>
					<td>
						<p class='text-center statement'>".$_SESSION['retailer']->cart->cart[$i]->getQuantity()."</p>
					</td>
					</td>
					<td>
						<p class='text-center statement'>$"; 
						$total = $_SESSION['retailer']->cart->cart[$i]->getQuantity() * $_SESSION['retailer']->paymentProfile->getCostPerCard();
						echo $total;
		echo "
					</td>
				</tr>
		";
	}
	echo "
				
				</table>
			</div>
		</div>
		<div class='row'>
		<p class='pull-right statement'><b>Total without shipping: $".$_SESSION['retailer']->cart->getTotal()."</b></p>
		</div>";
}
?>
<p class='statement text-center'><b>Shipping</b></p>
	<div class='panel panel-body'>
		<div class='col-xs-6 col-sm-6 col-md-6 col-lg-6'>
			<p class='statement text-center'>Ship to:</p>
			<?php echo $_SESSION['retailer']->address->getAddress() ?>
		</div>
		<div class='col-xs-6 col-sm-6 col-md-6 col-lg-6'>
			<p class='statement text-center'>Shipping Method:</p>
			<?php 
			$service = $_SESSION['retailer']->address->getService();
			$cost = "";
			if($service == "standard")
			{
				$service = "Standard";
				if($_SESSION['retailer']->cart->getTotal() >= $_SESSION['retailer']->shippingProfile->getCarriagePaid())
				{
					$cost = "Complimentary";
				}
				else 
				{
					$cost = $_SESSION['retailer']->shippingProfile->getStandardShipping();
				}
			}
			else
			{
				if($service == "expediated")
				{
					$service = "Expediated";
					$cost = $_SESSION['retailer']->shippingProfile->getExpediatedShipping();
				}
			}
			echo "
			<p class='text-center statement'>$service service:"; 
			if($cost != "Complimentary"){
				echo "$";
			}
			echo "$cost</p>
			</div>
			</div>
			";
			$total = $_SESSION['retailer']->cart->getTotal();
			if($cost != "Complimentary")
			{
				$total = $total + $cost;
			}
			echo "<div class='row'><p class='pull-right statement'><b>Grand Total: $$total</b></p></div>
				<p class='statement text-center'><b>Payment</b></p>";
		
			if($_SESSION['error'] == 2)
			{//there was an error in the payment processing, prompt the user
				echo "
				<div class='panel panel-body error'>
					<p class='statement text-center'>There was an error in your payment. Please try again. If problem continues, consider paying through PayPal or email william@cardhappening.com</p>
				</div>";
			}
			//check if payment is due up front or not
			/*
			if($_SESSION['retailer']->getPaymentDue() != 0)
			{
				echo "<div class='panel panel-body'>
				<p class='statement text-center'>Payment is due ".$_SESSION['retailer']->getPaymentDue()." days after payment has arrived.</p>
				</div>
				";
			}*/
			
			/*
			 * As of the 21st of April, 2015 we are not able to accept payments at a later time.
			 * ALL PAYMENTS MUST BE MADE UP FRONT
			 * EDIT THIS TO AFFECT THAT
			 * ALSO NEED TO EDIT ORDER HANDLER
			 */
			echo "
			 <div id='dropin'></div>
  			<button type='submit' class='btn btn-block btn-default' id='pay'><b class='statement'>Place Order</b></button>
			</form>
				</div>";	
			?>
