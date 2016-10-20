<?php
if(!isset($_SESSION['admin_level'])){
	$_SESSION['admin_level'] = 0;
}
if(isset($_POST['submitLogin'])){//handling log in
	$user = strip_tags($_POST['adminUser']);
	$password = strip_tags($_POST['adminPassword']);
	$password = sha1($password.'342hjhjhs234');
	$q = "SELECT `admin_id`, `level` FROM `admin` WHERE `user` = '$user' AND `password` = '$password';";
	$r = mysqli_query($dbc, $q);
	if(mysqli_num_rows($r) == 1){
		echo "one row";
		$r = mysqli_fetch_assoc($r);
		$_SESSION['admin_level'] = $r['level'];
		$_SESSION['admin_id'] = $r['admin_id'];
		print_r($_SESSION);
	}
}
?>