<?php
$_SESSION['error'] = null;
if($_SESSION['admin_level'] == 1){ //check all forms that could be submitted
	/*
	 * This handles adding a new admin member
	 * The password is encoded with a secret hash and stored in the database
	 */
	if(isset($_POST['newAdmin'])){
		//sha1 secret hash = '342hjhjhs234'
		if($_POST['adminPassword'] == $_POST['adminPasswordConfirm'] && $_POST['adminPassword'] != "" && $_POST['adminName'] != "" && $_POST['adminLevel'] != '#'){
			$password = strip_tags($_POST['adminPassword']);
			$password = sha1($password.'342hjhjhs234');
			$user = strip_tags($_POST['adminName']);
			$level = strip_tags($_POST['adminLevel']);
			$q = "SELECT COUNT(*) FROM `admin` WHERE `user` = '$user';";//make sure the user name is not in use
			$r = mysqli_query($dbc, $q);
			if($r){
				$result = mysqli_fetch_assoc($r);
				if($result['COUNT(*)'] == 0){
					$q = "INSERT INTO `admin`(`user`, `password`, `level`) VALUES ('$user','$password','$level');";
					$r = mysqli_query($dbc, $q);
				} else {
					$_SESSION['error'] = 4;
				}
			}
		}else{
			$_SESSION['error'] = 3;//error = 3 means error in the newAdmin adding section
		}
	}
}

?>