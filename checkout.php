<?php 
/*
 * This page will generate the check out for the user
 * Things we must do:
 * 1. Recalculate total price from database to make sure information is correct
 * 2. Provdie use with a way to edit their orders
 */
session_start(); 
include('../../exterior/cardhappeningConnection.php');
include('function/checkoutHandlerState.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<?php 

		include('config/css.php');
		include('config/js.php');
		include('css/mainCSS.php');
		if($_SESSION['checkout'] == 0){
			include('javascript/checkoutConfirmJS.php');
		}
		if($_SESSION['checkout'] == 1){
			include('javascript/paymentProcessJS.php');
		}
		if($_SESSION['checkout'] == 2){
			include('braintree-php-2.34.0/braintreeInitializeJavaScript.php');
		}
		?>
		<script src="https://js.braintreegateway.com/v2/braintree.js"></script>	
			
	</head>
	<body>
		<div class="container-fluid">
			<?php 
			include('feature/header.php'); 
			include('function/checkoutHandlerDisplay.php');
			?>
		
		</div>

		

		<footer>
		<?php include('feature/footer.php') ?>
		</footer>		
	</body>

</html>