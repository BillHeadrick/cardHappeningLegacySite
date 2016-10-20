<?php
session_start();
if(isset($_POST['admin_user']) || isset($_POST['admin_password'])){
	if($_POST['admin_user'] == "" || $_POST['admin_password'] == ""){
		echo "blank";
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Admin Verification|Card Happening</title>
		<?php
		include('config/css.php');
		include('config/js.php');
		include('css/mainCSS.php');
		?>
	</head>
	<body>
		<div class="container-fluid">
			<?php 
			include('feature/header.php'); 
			include('feature/adminLogIn.php');
			?>
			
			
		</div>
	</body>
</html>