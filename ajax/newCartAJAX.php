<?php
//purpose: answer an ajax call to return the value of a new status
//will echo id if valid, else it will echo 'none'
include('../../../exterior/cardhappeningConnection.php');
$q = "INSERT INTO `session`(`status`) VALUES ('1');";
$r = mysqli_query($dbc, $q);
if($q){
	$id = mysqli_insert_id($dbc);
	echo $id;
	exit;
} else { echo "none";}
?>