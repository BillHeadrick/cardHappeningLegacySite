<?php
	session_start();

?>

<!DOCTYPE html>
<html>
	<head>		
		<meta charset="UTF-8">
		<?php 	

		include('config/css.php');
		include('config/js.php');
		include('css/mainCSS.php');
		include('feature/nav.php');

	
		?>
		<title>Returns || CardHappening</title>
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
		<meta name="description" content="At Card Happening we stand by our hand-painted cards with a satisfaction guarantee. If you don't love your hand-painted cards we will be more than happy to replace them for you.">
		<meta name="keywords" content="card happening, cardhappening, hand-painted cards, handmade card, hand-painted greeting cards, handmade greeting cards, hand painted, handpainted, acrylic artist, greeting card, Elizabeth Grant, William Headrick, William H Headrick, about hand painting cards, card happening return, cardhappening return policy, card happening satisfaction guarantee">
		<meta name="author" content="William Headrick">
	</head>
	<body>

		<div class="container">
			<?php include('feature/header.php'); ?>
			<?php displayNav("null"); ?>
			<br>
			<br>
			
			
			<?php include('feature/styleBanner.php'); 
			//include('feature/productImages.php');
			?>
			
			<div class='row'>
				<div class='hidden-xs col-sm-2 col-md-3 col-lg-3'></div>
				<div class='col-xs-12 col-sm-8 col-md-6 col-lg-6'>
					<div class='panel panel-default panel-body order'>
						
						<h1 class='text-center'>Return Policy</h1>
						<p class='text-center statement'>At CardHappening we stand by our cards. We will gladly replace any card with a defect/error or that is not up to your satisfaction. If you have an issue or are not satisfied with your purchase please email <b>william@cardhappening.com</b> for details on how to return or exchange your cards.</p>
					</div>
				</div>
				<div class='hidden-xs col-sm-2 col-md-3 col-lg-3'></div>
			</div>		
			
		</div><!--end of container-->
		<footer>
			<?php include('feature/footer.php') ?>
		</footer>
	</body>
	
	
	
</html>