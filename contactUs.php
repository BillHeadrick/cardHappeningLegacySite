<?php
	session_start();

?>

<!DOCTYPE html>
<html>
	<head>		
		<?php 	

		include('config/css.php');
		include('config/js.php');
		include('css/mainCSS.php');
		include('feature/nav.php');
	
		?>
		<title>Contact Us || CardHappening</title>
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

		<div class="container">
			<?php include('feature/header.php'); ?>
			<?php displayNav("null"); ?>
			
			<?php include('feature/styleBanner.php'); 
			//include('feature/productImages.php');
			?>
			
			<div class='row'>
				<div class='hidden-xs col-sm-2 col-md-3 col-lg-3'></div>
				<div class='col-xs-12 col-sm-8 col-md-6 col-lg-6'>
					<div class='panel panel-default panel-body order'>
						
						<h1 class='text-center'>Contact Us</h1>
						<p class='text-center statement'>For concerns, returns, or wholesale information please contact <b>william@cardhappening.com</b> or call <b>214-728-2262</b></p>
					</div>
				</div>
				<div class='hidden-xs col-sm-2 col-md-3 col-lg-3'></div>
			</div>		
			
		</div><!--end of container-->
	</body>
	
	<footer>
		<?php include('feature/footer.php') ?>
	</footer>
	
	
</html>