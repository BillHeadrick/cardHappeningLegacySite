<?php
	session_start();
	include('../../../exterior/cardhappeningConnection.php');
	include('handler/adminState.php');
	include('handler/formHandler.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<?php
			include('../config/css.php');
			include('../config/js.php');
			include('javascript/orderFullfillmentJS.php');
			include('../css/mainCSS.php');
		?>
		<title>Cardhappening Administration</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--icons-->
		<link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
		<link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
		<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
		<meta name="msapplication-TileColor" content="#da532c">
		<!--end of icons-->
	</head>
	<body>
		<div class='container-fluid'>
		<?php
		include('handler/orderDisplay.php');
		?>
		</div>
	</body>
</html>