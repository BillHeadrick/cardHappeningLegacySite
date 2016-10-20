<?php
session_start();
include('../../../exterior/cardhappeningConnection.php');
include('feature/retailerNav.php');
include('handler/passwordRecoveryHandler.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Retailers | Card Happening</title>
		<meta name="description" content="Hand-Painted greeting cards for all occasions. Painted by artists in Austin, Texas.">
		<meta name="keywords" content="card happening, cardhappening, shop hand-painted cards, shop handmade card, maelstrom, maelstrom card, skypunch, skypunch card, mandarin, mandarin twilight, skyhole, sky hole, mandarin hour, twilight, mandarin twilight card,hand-painted greeting cards, handmade greeting cards, hand painted, handpainted, acrylic artist, greeting card, process, artistic process, porcess, artist statement, cardhappening artist statement">
		<meta name="author" content="William Headrick">
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
		<?php
		include('../config/css.php');
		include('../config/js.php');
		include('../css/mainCSS.php');		
		?>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<div class='container'>
			<?php include('../feature/header.php');  ?>
			<br>
			<br>
			<?php retailerNav(null); ?>
			<br>
			<br>
			<div class='panel panel-default standard-color'>
			<?php include('feature/passwordRecoveryDisplay.php'); ?>
			</div>
		</div>
	</body>
</html>