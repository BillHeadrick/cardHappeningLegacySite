<?php
/*
 * Handles state for the webstie
 * 1. check if able to have cookies
 * 2. check if cookie set
 * 3. set new cookie if not
 * 4. people who do not have cookies enabled will be limited to the session
 */

	if (!isset($_COOKIE['auth']) && $_SESSION['accepts_cookies'] == null && $_SESSION['id'] == null){ //check if the user allows cookies
		//setcookie('foo', 'bar', time()+3600); 
		//header("location: checkCookie.php");
	}
	$_SESSION['accepts_cookies'] = true;
	if(isset($_COOKIE['auth'])){	//returning user
		$_SESSION['id'] = $_COOKIE['auth'];
		$_SESSION['accepts_cookies'] = true;
		//update last login in database
		$q = "UPDATE `session` SET `date`= now() WHERE `session_id` = '$_SESSION[id]';";
		$r = mysqli_query($dbc, $q);
	}
	if(!isset($_COOKIE['auth']) && $_SESSION['id'] == null){
		include('newCart.php');
		$_SESSION['id'] = newCart($dbc);		
	}
	if($_SESSION['accepts_cookies'] == true){ //set/update cookies
		$id = $_SESSION['id'];
		//setcookie( 'auth', $id, time()+3600*24*30, '/', 'www.cardhappening.com', isset($_SERVER["HTTPS"]), true); //set semi-secure cookie for 30 days
		setcookie('auth', $id, time()+3600*24*30);
	}
	if(isset($_SESSION['checkout'])){
		$_SESSION['checkout'] = 0;
	}


?>