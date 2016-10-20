<?php
function newCart($dbc){
	$q = "INSERT INTO `session`(`status`) VALUES ('1');";
	$r = mysqli_query($dbc, $q);
	if($q){
		$id = mysqli_insert_id($dbc);
		return $id;
	} 
}
?>