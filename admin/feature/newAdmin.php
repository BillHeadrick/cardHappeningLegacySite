
<?php

if($_SESSION['admin_level'] == 1){
	echo "<div class='row'>
	<div class='hidden-xs col-sm-2 col-md-3 col-lg-3'></div>
	<div class='col-xs-12 col-sm-8 col-md-6 col-lg-6'>
		<div class='panel panel-default panel-body'>
			<h2 class='text-center'>New Admin Account</h2>";
	if(isset($_SESSION['error']) && $_SESSION['error'] == 3){ //if there was an error with the previous submitted new admin
		echo"<p class='text-center'><b>There was an error in your previous submission.</b></p>";
	}
	if(isset($_SESSION['error']) && $_SESSION['error'] == 4){
		echo "<p class='text-center'><b>The username is already in use. Choose another.</b></p>";
	}
	echo	"<form id='newAdmin' name='newAdmin' action='";
			echo htmlentities($_SERVER['PHP_SELF']);
			echo "' method='post'>
				<div class='form-group'>
					<label for='adminName'>Admin Name</label>
					<input type='text' class='form-control' name='adminName' id='adminName' placeholder='Admin Name'>
					<p class='help-block'>200 characters maximum length.</p>
				</div>
				<div class='form-group'>
					<label for='adminPassword'>Password</label>
					<input type='password' class='form-control' name='adminPassword' id='adminPassword'>
				</div>
				<div class='form-group'>
					<label for='adminPasswordConfirm'>Confirm Password</label>
					<input type='password' class='form-control' name='adminPasswordConfirm' id='adminPasswordConfirm'>
				</div>
				<div class='form-group'>
					<label for='adminLevel'> Access Level</label>
					<select class='form-control' name='adminLevel'>
						<option value='#'>------</option>
						<option value='1'>All Access</option>
						<option value='2'>Manager</option>
					</select>
				</div>
				<button type='submit' name='newAdmin' class='btn btn-default btn-block' id='newAdminButton'>Add Admin Account</button>
			</form>
		</div>
	</div>
	<div class='hidden-xs col-sm-2 col-md-3 col-lg-3'></div>
</div>";
}

?>
