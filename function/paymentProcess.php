<?php
require_once 'lib/Braintree.php';
Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('ywg2cdpqbzfmpfh2');
Braintree_Configuration::publicKey('d8tpfvtkgd4fjn3t');
Braintree_Configuration::privateKey('ae68a1b7bee6a725d3e7fdcc4ea00f37');

$nonce = strip_tags($_POST["payment_method_nonce"]);
$q = "SELECT `email` FROM `session` WHERE `session_id` = '$_SESSION[id]';";
$r = mysqli_query($dbc, $q);
if($r){
	$r = mysqli_fetch_assoc($r);
	$email = $r['email'];
	echo $email;
} else {
	$email = "";
}

$q = "SELECT * FROM `address` WHERE `address_id` = '$_SESSION[address]';";
$r = mysqli_query($dbc, $q);
if($r){
	$r = mysqli_fetch_assoc($r);
	$first = $r['first'];
	$last = $r['last'];
	$address1 = $r['address1'];
	$address2 = $r['address2'];
	$city = $r['city'];
	$zipcode = $r['zipcode'];
	$state = $r['state'];
	$country = $r['country'];

	$result = Braintree_Transaction::sale(array(
  'amount' => "$_SESSION[total]",
  'orderId' => "$_SESSION[id]",
 // 'merchantAccountId' => 'ywg2cdpqbzfmpfh2',
  'paymentMethodNonce' => "$nonce",
  'customer' => array(
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
	echo "this is the result ".$result;
}




?>