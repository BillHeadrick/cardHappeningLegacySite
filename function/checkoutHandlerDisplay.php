<?php
include('function/checkoutPagination.php');

switch($_SESSION['checkout']){
	case 0:
		include('feature/checkoutConfirm.php');
		break;
	case 1:
		include('feature/checkoutShipping.php');
		break;
	case 2:
		include('feature/checkoutPayment.php');
		break;
	case 3:
		include('feature/checkoutComplete.php');
	break;
}

?>