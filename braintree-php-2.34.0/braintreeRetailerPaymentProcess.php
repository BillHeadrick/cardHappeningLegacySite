<?php
	$_SESSION['error'] = 0;//set to 2 if payment error
	require_once 'lib/Braintree.php';
	//credentials
	Braintree_Configuration::environment('production');
	Braintree_Configuration::merchantId('n3hkbjcxdj8hw3vy');
	Braintree_Configuration::publicKey('46668f4dqynptqp4');
	Braintree_Configuration::privateKey('1ce8964476480a8d0ac9435ef78256b7');
	
	//get nonce
	$nonce = $_POST["payment_method_nonce"];
		
	//calculate order total
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
	$total = $_SESSION['retailer']->cart->getTotal();
	if($cost != "Complimentary")
	{
		$total = $total + $cost;
	}
$id = $_SESSION['retailer']->getRetailerID();
$first = $_SESSION['retailer']->contact->getFirstName();
$last = $_SESSION['retailer']->contact->getLastName();
$email = $_SESSION['retailer']->contact->getEmail();
$address1 = $_SESSION['retailer']->address->getAddressLine1();
$address2 = $_SESSION['retailer']->address->getAddressLine2();
$city = $_SESSION['retailer']->address->getCity();
$state = $_SESSION['retailer']->address->getState();
$zipcode = $_SESSION['retailer']->address->getPostalCode();
$country = $_SESSION['retailer']->address->getCountry();

//braintree transaction	
$result = Braintree_Transaction::sale(array(
  'amount' => "$total",
  'paymentMethodNonce' => "$nonce",
  'customer' => array(
  	'id' => "retailer$id",
    'email' => "$email"
  ),
  'shipping' => array(
    'firstName' => "$first",
    'lastName' => "$last",
    'streetAddress' => "$address1",
    'extendedAddress' => "$address2",
    'locality' => "$city",
    'region' => "$state",
    'postalCode' => "$zipcode",
    'countryCodeAlpha2' => "$country"
  ),
  'options' => array(
    'submitForSettlement' => true
  ),
));

if($result->success){
	$_SESSION['retailer']->cart->setPaid(true);
	//store in database
	if($cost == "Complimentary")
	{
		$cost = 0;
	}
	if($_SESSION['retailer']->cart->getPurchaseOrder() != "")
	{
		$po = $_SESSION['retailer']->cart->getPurchaseOrder();
	}
	else 
	{
		$po = "";
	}	
	$q = "INSERT INTO `retailer_order`(`retailer_id`, `retailer_address_id`, `braintree_transaction_id`, `total`, `shipping_method`, `shipping_cost`, `order_cost`, `purchase_order`) VALUES ('$id','".$_SESSION['retailer']->address->getAddressID()."','".$result->transaction->id."','$total','$service','$cost','".$_SESSION['retailer']->cart->getTotal()."','$po');";
	$r = mysqli_query($dbc, $q);
	if($r)
	{
		$orderID = mysqli_insert_id($dbc);
	} else
	{
		$orderID = 0;	//if the order id is 0, there was an error sending the order
	}
	$_SESSION['retailer']->cart->setOrderID($orderID);
	for($i = 0; $i < $_SESSION['retailer']->cart->getLength(); $i++)
	{
		$q = "INSERT INTO `retailer_item`(`retailer_order_id`, `style_id`, `quantity`, `price`) VALUES ('$orderID', '".$_SESSION['retailer']->cart->cart[$i]->getStyleID()."','".$_SESSION['retailer']->cart->cart[$i]->getQuantity()."','".$_SESSION['retailer']->cart->cart[$i]->getQuantity()*$_SESSION['retailer']->paymentProfile->getCostPerCard()."');";
		$r = mysqli_query($dbc, $q);
	}
}
if(!$result->success){
	$_SESSION['error'] = 2;
}
?>