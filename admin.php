<?php
session_start();
if($_SESSION['access_level'] == null){
	header( 'location: http://www.cardhappening.com/adminVerify.php');
}
?>
<!DOCTYPE html>
<html>
	<head></head>
	<body>
		
	</body>
</html>