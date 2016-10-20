<?php
include('classes/retailerAccountClass.php');
include('classes/retailerShippingClass.php');
include('classes/retailerPaymentClass.php');
include('classes/retailerContactClass.php');
include('classes/retailerItemClass.php');
include('classes/retailerCartClass.php');
session_start();
include('../../../exterior/cardhappeningConnection.php');
include('handler/retailerLoginHandler.php');
include('handler/retailerStateHandler.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Retailers|Card Happening</title>
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
	</head>
	<body>
		<div class='container'>
			<?php include('../feature/header.php');  
			include('../feature/nav.php');
			displayNav("retailer"); 
			?>
			<br>
			<br>
			<div class='row'>
				<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
					<div class='panel panel-default panel-body standard-color'>
						<p class='statement text-center'>Retailer Login</p>
						<form name="retailer_login" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
							<div class='form-group'>
								<label for='retailer_account'>Email or Retail Account Number</label>
								<input type='text' class='form-control' name='retailer_account'>
							</div>
							<div class='form-group'>
								<label for='retailer_password'>Password</lable>
								<input type='password' class='form-control' name='retailer_password'>
							</div>
							<div class='form-group'>
								<button type='submit' class='btn btn-default btn-block' id='retailer_login' name='retailer_login'><b>Retailer Login!</b></button>
							</div>
						</form>
						<?php
							if($_SESSION['login_error'] == 2)	//wrong password/account information
							{
								echo "<div class='panel panel-body panel-warning'><p class='text-center'>Invalid password/account combination.<br>Please try again.<br>If problem continues <a href='https://www.cardhappening.com/retailer/passwordRecovery.php'>click here to recover your password.</a></p></div>";
								$_SESSION['login_error'] = null;
							}
						?>
						<?php
							if($_SESSION['login_error'] == 3)	//invalid registration code was submitted
							{
								echo "<div class='panel panel-body panel-warning'><p class='text-center'>Connection error.<br>Please try again.</p></div>";
								$_SESSION['login_error'] = null;
							}
						?>
					</div>
				</div>
				<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
					<div class='panel panel-default panel-body standard-color'>
						<p class='statement text-center'>Sign Up</p>
						<form name="retailer_sign_up" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
							<div class='form-group'>
								<label for='registration_code'>Registration Code</label>
								<input type='text' name='registration_code' class='form-control' id='registration_code'>
							</div>
							<div class='form-group'>
								<button type='submit' id='retailer_sign_up' name='retailer_sign_up' class='btn btn-default btn-block'><b>Retailer Sign Up!</b></button>
							</div>
						</form>
						<?php
							if($_SESSION['login_error'] == 1)	//invalid registration code was submitted
							{
								echo "<div class='panel panel-body panel-warning'><p class='text-center'>Invalid Registration Code.<br>Please try again. <br> Email: william@cardhappening.com if problem continues.</p></div>";
								$_SESSION['login_error'] = null;
							}
						?>
						<p class='text-center'>Don't have a retailer registration code? <br> Email <b>william@cardhappening.com</b> to see if you qualify to become a Card Happening retailer.</p>
					</div>
				</div>
			</div>
			<div class='panel panel-body standard-color'>
				<a href='https://www.cardhappening.com/shop.php' class='btn btn-block btn-default'><p class='text-center statement'>Wrong place? Return to Card Happening!</p></a>
			</div>
		</div>
	</body>
</html>