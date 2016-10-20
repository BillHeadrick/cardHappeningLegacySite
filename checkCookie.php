<?php
//this function checks if cookie has been set, if so it returns the user to the homepage
session_start();


  if(isset($_COOKIE['foo']) && $_COOKIE['foo']=='bar'){
	$_SESSION['accepts_cookies'] = true;
	header("location: index.php");
}
else {
	$_SESSION['accepts_cookies'] = true;
	header("location: index.php");
}


?>