<?php
$_SESSION['error'] = 0;
$order_id = $_SESSION['id'];
$total = $_SESSION['total'];

require_once 'lib/Braintree.php';
Braintree_Configuration::environment('production');
Braintree_Configuration::merchantId('n3hkbjcxdj8hw3vy');
Braintree_Configuration::publicKey('46668f4dqynptqp4');
Braintree_Configuration::privateKey('1ce8964476480a8d0ac9435ef78256b7');

$nonce = strip_tags($_POST["payment_method_nonce"]);
$q = "SELECT `email` FROM `session` WHERE `session_id` = '$_SESSION[id]';";
$r = mysqli_query($dbc, $q);
if($r){
	$r = mysqli_fetch_assoc($r);
	$email = $r['email'];
//	echo $email;
} else {
	$email = "";
}

$q = "SELECT * FROM `address` WHERE `address_id` = '$_SESSION[shipping]';";
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
	if($result->success){
		$_SESSION['checkout = 3'];
//		print_r($result);
//		echo "<br><br><br>";
//		echo $result->transaction->id;
		$q = "INSERT INTO `sale`(`session_id`, `address_id`, `status`, `braintree_transaction_id`, `total`, `shipping`) VALUES ('$_SESSION[id]','".$_SESSION['shipping']."','1','".$result->transaction->id."', '".$total."', '".$_SESSION[shipping_total]."');";
		$r = mysqli_query($dbc, $q);
		if($r){
//			echo "insertion into sale was success";
			//successfully inserted sale into db
			$_SESSION['checkout'] = 3;
			include('function/newCart.php');
			$id = newCart($dbc);
			setcookie('auth', $id, time()+3600*24*30);
			$_SESSION['id'] = $id;			
		}
	}
	if(!$result->success){
		//the result did not go through
		//echo "failed transaction";
		$_SESSION['error'] = 2; //flag for a box informing the user that they need to reinsert credit card, enter a different credit card, or try etsy
	}
}




?>