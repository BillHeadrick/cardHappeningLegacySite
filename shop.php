<?php
	session_start();
	include('../../exterior/cardhappeningConnection.php');
	include('function/state.php');	//$_SESSION[id] & $_SESSION[accepts_cookies]

?>

<!DOCTYPE html>
<html>
	<head>	
		<meta charset="UTF-8">	
		<?php 	

		include('config/css.php');
		include('config/js.php');
		include('css/mainCSS.php');
		include('javascript/cartJS.php');
		include('javascript/placeOrderJS.php');
		include('javascript/styleObject.php');
		include('plugin/cycle.php');
		include('javascript/styleBannerJS.php');
		include('feature/nav.php');
		//include('javascript/productImagesObjectJS.php');
		
		?>
		<title>Card Happening || Shop Hand-Painted Cards</title>
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
		
		
		<meta name="description" content="Shop for hand-painted cards by Card Happening. Each card is hand-painted in Austin, Texas.">
		<meta name="keywords" content="card happening, cardhappening, shop hand-painted cards, shop handmade card, hand-painted greeting cards, handmade greeting cards, hand painted, handpainted, acrylic artist, greeting card">
		<meta name="author" content="William Headrick">
	</head>
	<body>
			<div class='overlay'>
			</div>
		<div class="container">
			<?php include('feature/header.php'); ?>
			<?php displayNav("shop"); ?>
			<br>
			<br>
			
			<?php include('feature/styleBanner.php'); 
			//include('feature/productImages.php');
			?>
			
			<div class="row text-center">
				<p class="statement">Using art as a form of expression, our cards will perfectly complement your message.</p>
			</div><!--end of statement row-->
			
			
			<div class="row">
				<?php include('feature/orderDisplay.php'); ?>	
			</div><!--end of order row-->
			
			<br>
			<br>
			<div class="row">
				<?php include('feature/cartDisplay.php'); ?>
				
			</div><!--end of cart row-->
			
			<br>
			<br>
			
			
			
		</div><!--end of container-->
		<footer>
			<?php include('feature/footer.php') ?>
		</footer>
	</body>
	
	
	
</html>