<?php
//will handle the states through retailer order
//state 1 is display the order form
//state 2 is display the shipping choices

if($_SESSION['retailerOrderState'] == 1)
{	//display the order form
	
	if($_SESSION['order_complete'] == true)
	{	//will be true only if we have completed the order and have gone back to stage 1
		echo "
		<div class='panel panel-body standard-color'>
			<p class='text-center statement'><b>Your order has been placed successfully!</b> <br> A confirmation email has been sent to ".$_SESSION['retailer']->contact->getEmail()."<br>You will recieve another email when your order ships.</p>
		</div>";
	}
	include('feature/displayRetailerOrderTop.php');
	echo"
			<div class='panel panel-body standard-color'>
			<form name='newOrder' action='". htmlentities($_SERVER['PHP_SELF'])."' method='post' id='newOrder'>
			<input type='hidden' name='newOrder' value='newOrder'>";
			include('feature/displayMerchandise.php');
	echo"	
			</form>
			</div>";
			include('feature/displayRetailerOrderBottom.php');
}
if($_SESSION['retailerOrderState'] == 2)
{
	echo "
		<div class='panel panel-body standard-color'>
		<div class='panel panel-body' id='errorMessage'></div>
		<form name='shipping' action='". htmlentities($_SERVER['PHP_SELF'])."' method='post' id='shipping'>
			<input type='hidden' name='shipping' value='shipping'>";
		include('feature/displayShippingOptions.php');
		include('feature/displayRetailerAddress.php');
	echo "
		</form>
		</div>";
}
if($_SESSION['retailerOrderState'] == 3)
{
	echo "<div class='panel panel-body standard-color'>";
  	include('feature/displayOrderSummary.php');	
	echo "</div>";
}


?>