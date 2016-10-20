<?php
if(isset($_SESSION['admin_level'])){
	include('../function/nameMonth.php');
	include('feature/navbar.php');
	switch($_SESSION['admin_level']){
		case 0://need to log in
			include('feature/login.php');
			break;
		case 1://all access
			include('feature/orderFullfillment.php');
			//include('feature/fulfilledOrders.php');
			break;
		case 2://manager access
			include('feature/orderFullfillment.php');
			//include('feature/fulfilledOrders.php');
			break;
	}
}
?>