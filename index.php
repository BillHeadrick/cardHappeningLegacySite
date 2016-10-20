<?php

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Card Happening</title>
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
		include('config/css.php');
		include('config/js.php');
		include('css/mainCSS.php');
		include('feature/nav.php'); 
		?>
		<meta name="google-site-verification" content="2TdI-mtBlziNKqFG0Qu4r4-Q1kTa6-VkMGI8mntyRgs" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<div class='container'>
			<?php include('feature/header.php');  ?>
			<?php displayNav("home"); ?>
			<br>
			<br>
			<div class='row'>
				<div class='panel panel-body standard-color'>
					<p class='statement text-center'>"Beauty is a Happening"</p>
					<p class='text-center'>At Card Happening, each card is hand-painted and completely unique. Our fundamental belief is that "Beauty is a Happening". We incorporate this into our design process by focusing on how colors and paint are applied to each card. By combining colors in a particular order we are able to create unique moments and original works of art.</p>
				</div>
			</div>
			
			<div class='row'>
					<div class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>
						<div class='thumbnail standard-color'>
						<div class='caption'>
							<p class='text-center statement'><b>Hand-Painted</b></p>
						</div>
						<img class='center-block' src='https://www.cardhappening.com/images/hand-painted.jpg' alt='Our cards are always hand-painted'>
						<div class='caption'>
							<p class='text-center'>Every one of our cards is hand-painted by one of our artists. Their attention to detail gives our cards the colorful and painterly style they are appreciated for. All cards are hand-painted in Austin, Texas.</p>
						</div>
						<a href='https://www.cardhappening.com/process.php' class='btn btn-default btn-block'><b>Our Process</b></a>
					</div>
					</div>
					<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
						<div class='panel panel-default panel-body standard-color'>
							<img class='main-display img-rounded' src='https://www.cardhappening.com/images/center.jpg' alt='Maelstrom, Mandarin Twilight, and Skypunch style fine hand-painted cards'>
						</div>
						<div class='row'>
							<div class='col-md-3'></div>
							<div class='col-md-6'>
								<a href='https://www.cardhappening.com/shop.php' class='btn btn-primary btn-block'><b>Browse Cards Now</b></a>
							</div>
							<div class='col-md-3'></div>
							<div class='col-xs-12 hidden-sm hidden-md hidden-lg'>
								<br>
							</div>
						</div>
						
					</div>
				<div class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>
					<div class='thumbnail standard-color'>
						<div class='caption'>
							<p class='text-center statement'><b>Share Art</b></p>
						</div>
						<!--<img class='center-block' src='https://www.cardhappening.com/images/'-->
						<img src='https://www.cardhappening.com/images/mandarinTwilight.jpg' alt='Thanks to our unique process, our greeting cards can be displayed as art.'>
						<div class='caption'>
							<p class='text-center'>Inspired by natural phenomenon, our artists skillfully apply layers of paint to envoke the sensation of the phenomenon. Just as no two lightning bolts are the same, every card we make is hand-painted one-of-a-kind.</p>
							
						</div>
					</div>
				</div>
			</div><!-- end of main image-->

			
		</div>
		<footer>
			<?php include('feature/footer.php'); ?>
		</footer>
	</body>
</html>