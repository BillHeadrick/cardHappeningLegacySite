<?php
if(isset($_SESSION['admin_level'])){
	
	include('feature/navbar.php');
	switch($_SESSION['admin_level']){
		case 0://need to log in
			include('feature/login.php');
			break;
		case 1://all access
			
			break;
		case 2://manager access
			break;
	}
}
?>