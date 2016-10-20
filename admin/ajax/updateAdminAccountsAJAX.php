<?php
include('../../../../exterior/cardhappeningConnection.php');
if(isset($_POST['user']) && isset($_POST['id']) && isset($_POST['level'])){
	$user = strip_tags($_POST['user']);
	$id = strip_tags($_POST['id']);
	$level = strip_tags($_POST['level']);
	if($user != "" AND $level != "#"){
		$q = "UPDATE `admin` SET `user`='$user',`level`='$level' WHERE `admin_id` = $id;";
		$r = mysqli_query($dbc, $q);
		return;
	}
	if($user != "" AND $level == "#"){
		$q = "UPDATE `admin` SET `user`='$user' WHERE `admin_id` = $id;";
		$r = mysqli_query($dbc, $q);
		return;
	}
	if($user == "" AND $level != "#"){
		$q = "UPDATE `admin` SET `level`= '$level' WHERE `admin_id` = $id;";
		$r = mysqli_query($dbc, $q);
		return;
	}
}

?>