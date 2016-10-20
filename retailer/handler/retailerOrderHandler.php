<?php
//will handle the states through retailer order
//state 1 is display the form too
//state 2 is display the shipping choices
$_SESSION['order_complete'] = false; //order complete will be true if we have finished an order and are going back to stage 1

if(isset($_POST['changeState']))
{
	if(isset($_SESSION['retailerOrderState']) && $_SESSION['retailerOrderState'] >= $_POST['changeState'])
	{
		$_SESSION['retailerOrderState'] = $_POST['changeState'];
	}
}
if($_SESSION['retailerOrderState'] == null){
	$_SESSION['retailerOrderState'] = 1;	
} 
else if($_SESSION['retailerOrderState'] == 1 && isset($_POST['newOrder']))
{
	//we have an order to process
	$q = "SELECT * FROM `style` WHERE `status` = '1';"; //select all valid styles
	$r = mysqli_query($dbc, $q);
	if($r)
	{	//$r holds multiple rows of valid styles 
		$_SESSION['retailer']->cart->clear();
		while($result = mysqli_fetch_assoc($r))
		{	//need to check if there was a quantity on all of the columns
			$name = "style".$result['style_id'];
			if(isset($_POST[$name]) && $_POST[$name] > 0)
			{	//the quantity for that style is set
				$_SESSION['retailer']->cart->add($result['style_id'], $_POST[$name], $dbc);
			}
		}
		if($_SESSION['retailer']->cart->getTotal() >= $_SESSION['retailer']->paymentProfile->getMinimumOrder())
		{
			$_SESSION['retailerOrderState'] = 2;
		}
	}
	if(isset($_POST['purchaseOrder']) && $_POST['purchaseOrder'] != "")
	{
		$_SESSION['retailer']->cart->setPurchaseOrder(strip_tags($_POST['purchaseOrder']));
	}
} else if($_SESSION['retailerOrderState'] == 2 && isset($_POST['shippingOptions']))
{	
	//we need to verify the address and update the shipping information	
	//handling the address
	if(isset($_POST['address']))
	{	//the user had the option to select from a previous address
		if($_POST['address'] != "newAddress")
		{
			$_SESSION['retailer']->address = new RetailerAddress($_POST['address'], $dbc);
		}
		else 
		{	//we have a new address
			//verifying the address
			if($_POST['company'] != "" AND $_POST['address1'] != "" AND $_POST['city'] != "" AND $_POST['postalCode'] != "" AND $_POST['country'] != "")
			{
				$company = strip_tags($_POST['company']);
				$address1 = strip_tags($_POST['address1']);
				$city = strip_tags($_POST['city']);
				$postalCode = strip_tags($_POST['postalCode']);
				$country = strip_tags($_POST['country']);
				$address2 = strip_tags($_POST['address2']);
				$attention = strip_tags($_POST['attention']);
				if($country == "US")
				{
					if($_POST['state'] != "")
					{
						$state = strip_tags($_POST['state']);
					}
					else
					{	//no state given
						exit;
					}
				}
				else 
				{	//not a US country, state = ""
					$state = "";
				}
				$q = "INSERT INTO `retailer_address`(`retailer_id`, `attention`, `address_1`, `address_2`, `city`, `state`, `postal_code`, `country`, `company`) VALUES ('".$_SESSION['retailer']->getRetailerId()."','$attention','$address1','$address2','$city','$state','$postalCode','$country','$company');";
				$r = mysqli_query($dbc, $q);
				if($r)
				{
					$_SESSION['retailer']->address = new RetailerAddress(mysqli_insert_id($dbc), $dbc);
				}
			}
			
		}
		//handling the shipping options
		switch($_POST['shippingOptions'])
		{
			case "standardShipping":
				$_SESSION['retailer']->address->addService("standard");
				break;
			case "expediatedShipping":
				$_SESSION['retailer']->address->addService("expediated");
				break;	
		}
		if($_SESSION['retailer']->address->isComplete() AND $_SESSION['retailer']->address->getService() != null)
		{
			$_SESSION['retailerOrderState'] = 3;
		}
	}
}
else if($_SESSION['retailerOrderState'] == 3 && isset($_POST['payment_method_nonce']))
{	
	//we need to process a payment
	include('../braintree-php-2.34.0/braintreeRetailerPaymentProcess.php');
		
		if($_SESSION['retailer']->cart->getPaid())
		{	//we have paid
			//send email
			$message = $_SESSION['retailer']->createConfirmationEmail();
			$message = wordwrap($message, 70, "\r\n");
			$to = $_SESSION['retailer']->contact->getEmail();
			if($_SESSION['retailer']->cart->getPurchaseOrder() != "")
			{
				$subject = $_SESSION['retailer']->cart->getPurchaseOrder()." Card Happening Retailer Order Confirmation";
			}
			else 
			{
				$subject = "Card Happening Retailer Order #".$_SESSION['retailer']->cart->getOrderID()."Confirmation";
			}			
			$header = "From:cardhappening@cardhappening.com \r\n";
			$header = $header . "Bcc: receipts@cardhappening.com \r\n";
			$header = $header . "Reply-To: william@cardhappening.com \r\n";
			$header = $header . "MIME-Version: 1.0 \r\n";
			$header = $header . "Content-type:text/html; charset=UTF-8 \r\n";
			$i = mail($to, $subject, $message, $header);
			
			//change state
			$_SESSION['retailerOrderState'] = 1;
			//remove cart and order information
			$_SESSION['retailer']->clearOrder();
			$_SESSION['order_complete'] = true;
		}
}


?>