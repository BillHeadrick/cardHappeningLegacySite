<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<?php
		include('config/css.php');
		include('config/js.php');
		include('javascript/productImagesObjectJS.php');
		include('javascript/imageStyleJS.php');
		include('css/mainCSS.php');
		include('plugin/cycle.php');
		include('feature/nav.php');
		?>
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
		
		<meta name="description" content="The team at Card Happening hand-paint cards out of Austin, Texas.">
		<meta name="keywords" content="card happening, cardhappening, hand-painted cards, handmade card, hand-painted greeting cards, handmade greeting cards, hand painted, handpainted, acrylic artist, greeting card, Elizabeth Grant, William Headrick, William H Headrick, about hand painting cards">
		<meta name="author" content="William Headrick">
		<title>Card Happening || About Us</title>
	</head>
	
	<body>
		<div class="container">
			<?php include('feature/header.php'); ?>
			<br>
			<br>
			<?php displayNav("about"); ?>
			<br>
			<br>
			<?php include('feature/productImages.php'); ?>
			<br>
			<br>
			<br>
			<?php include('feature/ourStory.php'); ?>
			<br>
			<br>
			<br>
			
			
			<?php include('feature/team.php'); ?>
			
		
			
		</div><!-- end of container-->
		<footer>
			<?php include('feature/footer.php'); ?>
		</footer>
	</body>

	
	
	
</html>