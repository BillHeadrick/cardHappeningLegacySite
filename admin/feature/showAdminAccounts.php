<?php

if($_SESSION['admin_level'] == 1){
	echo "
		<div class='hidden-xs col-sm-2 col-md-3 col-lg-3'></div>
		<div class='col-xs-12 col-sm-8 col-md-6 col-lg-6'>
			<div class='panel panel-default'>
				<h2 class='text-center'>Active Admin Account Management</h2>";
	echo	"<form id='showAdminAccountsActive' name='showAdminAccountsActive' action='";
	echo htmlentities($_SERVER['PHP_SELF']);
	echo "' method='post'>
			<table class='table table-hover'>
				<tr><th>Admin ID</th><th>User</th><th>Edit User</th><th>Admin Level</th><th>Edit Level</th><th>Apply Changes</th></tr>";
	$q = "SELECT `admin_id`, `user`, `level` FROM `admin` WHERE `level` >= 1;";
	$r = mysqli_query($dbc, $q);
	if($r){
		while($result = mysqli_fetch_assoc($r)){
			echo "<tr id='activeAdmin$result[admin_id]'><td>$result[admin_id]</td><td>$result[user]</td><td><input type='text' class='form-control' id='updateActiveAdminUser$result[admin_id]'></td><td>$result[level]</td><td><select class='form-control' id='adminActiveLevelEdit$result[admin_id]'><option value='#'>----</option><option value='1'>All Access</option><option value='2'>Manager</option><option value='0'>Remove Access</option></select></td><td><button type='button' class='btn btn-default editActiveAdmin' id='editActiveAdmin$result[admin_id]'>Apply</button></td></tr>";
		}
	}
	echo	"</table>
			</form>
	</div>
</div>
<div class='hidden-xs col-sm-2 col-md-3 col-lg-3'></div>";
}

?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            