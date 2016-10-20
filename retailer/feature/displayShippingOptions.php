<p class='statement text-center'><b>Shipping Options</b></p>
<div class='panel panel-body default-color'>
	<div class='radio'>
		<table class='table'>
		<tr>
			<th>Service</th>
			<th>Price</th>
			<th>Shipment Time</th>
		</tr>
		<label for='standardShipping'>

			<tr>
			<td>
				<input type='radio' id='standardShipping' name='shippingOptions' value='standardShipping' checked>
				<p>Standard Shipping</p>
			</td>
			<td>
				<p>
			<?php
				if($_SESSION['retailer']->cart->getTotal() >= $_SESSION['retailer']->shippingProfile->getCarriagePaid())
				{	//the total order is greater than their carriage paid level
					echo "Complementary";
				}
				else{
					echo "$".$_SESSION['retailer']->shippingProfile->getStandardShipping() ."  (Complementary on orders $".$_SESSION['retailer']->shippingProfile->getCarriagePaid()." and above.)";
				}
			?>
				</p>
			</td>
			<td>
			<p>1-3 Business Days*</p>
			</td>
			</tr>
		</label>
		<label for="expediatedShipping">
			<tr>
			<td>
			<input type='radio' id='expediatedShipping' name='shippingOptions' value='expediatedShipping'>
			<p>Expediated Shipping</p>
			</td>
			<td>
				<p>
			<?php
					echo "$".$_SESSION['retailer']->shippingProfile->getExpediatedShipping();
			?>
			</p>
			</td>
			<td>
			<p>
			Package arrives overnight*
			</p>
			</td>
			</tr>
		</label>
		</table>
	</div>
	<p class='pull-right'>*Arrival date is specified after order has shipped. Shipping dates may vary. Shipping time may vary for international orders.</p>
</div>
