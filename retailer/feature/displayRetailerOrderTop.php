<?php
/*	echo "
		<div class='panel panel-default standard-color'>
			<div class='row'>
				<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
					<p class='pull-left statement'>Wholesale Information:</p>
				</div>
				<div class='col-xs-6 col-sm-6 col-md-6 col-lg-6'>
					<p class='statement text-center'>Minimum Order: $".$_SESSION[retailer]->paymentProfile->getMinimumOrder()."<br> Price Per Card: $".$_SESSION[retailer]->paymentProfile->getCostPerCard()."</p>
				</div>
				<div class='col-xs-6 col-sm-6 col-md-6 col-lg-6'>
					<p class='statement text-center'>Free standard shipping on orders greater than $".$_SESSION[retailer]->shippingProfile->getCarriagePaid()."</p>
				</div>
			</div>
		</div>";*/
?>
<div class='panel panel-default standard-color'>
	<table class='table'>
		<tr>
			<th><p class='statement text-center'>Minimum Order</p></th>
			<th><p class='statement text-center'>Price Per Card</p></th>
			<th><p class='statement text-center'>Carriage Paid</p></th>
		</tr>
		<tr>
			<td><p class='statement text-center'>$<?php echo $_SESSION[retailer]->paymentProfile->getMinimumOrder(); ?></p></td>
			<td><p class='statement text-center'>$<?php echo $_SESSION[retailer]->paymentProfile->getCostPerCard(); ?></p></td>
			<td><p class='statement text-center'>Orders greater than or equal to $<?php echo $_SESSION[retailer]->shippingProfile->getCarriagePaid();?></p></td>
		</tr>
	</table>
</div>