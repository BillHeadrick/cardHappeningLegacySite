<?php
	echo "the carriage paid level is".$_SESSION[retailer]->shippingProfile->getCarriagePaid()." dollars";
	
	echo "<div class='panel panel-default standard-color'>
			<div class='row'>
				<div class='col-xs-4 col-sm-4 col-md-4 col-lg-4'>
					<p class='statement text-center'>Minimum Order: $".$_SESSION[retailer]->paymentProfile->getMinimumOrder()."<br> Price Per Card: $".$_SESSION[retailer]->paymentProfile->getCostPerCard()."</p>
				</div>
				<div class='col-xs-4 col-sm-4 col-md-4 col-lg-4'>
					<p class='statement text-center'>Free standard shipping on orders greater than $".$_SESSION[retailer]->shippingProfile->getCarriagePaid()."</p>
				</div>
				<div class='col-xs-4 col-sm-4 col-md-4 col-lg-4'>
					<p class='statement text-center'>Order Total: <b id='orderTotal'>$0</b></p>
				</div>
			</div>
			</div>";
?>