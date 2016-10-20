<?php

if(isset($_POST['reorder']))
{
	$_SESSION['retailer']->cart->clear();
	$_SESSION['retailer']->cart->build(strip_tags($_POST['reorder']), $dbc);
	$_SESSION['retailerOrderState'] = 1; 	//send the retailer back to the begining of checkout phase
	header('Location: https://www.cardhappening.com/retailer/index.php');
	exit;
}

?>