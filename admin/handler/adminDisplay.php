<?php

if(isset($_SESSION['admin_level'])){
	switch($_SESSION['admin_level']){
		case 0://need to log in
			break;
		case 1://all access
			include('feature/navbar.php');
			include('feature/newAdmin.php');
			include('feature/showAdminAccounts.php');
			break;
		case 2://manager access
			break;
	}
}
?>