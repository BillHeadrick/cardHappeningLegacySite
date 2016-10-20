<?php
//output the login form for the administration side
?>

<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"></div>
<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class='text-center'>Card Happening Management</h3>
		</div>
		<div class="panel-body">
			<form name="admin_log_in" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
				<div class="form-group">
						<b>User</b>
						<input type='text' class='form-control' id='admin_user' max="30" name='admin_user'>
				</div>
				<div class="form-group">
						<b>Password</b>
						<input type='password' class='form-control' id='admin_password' max='30' name='admin_password'>					
				</div>
				<br>
				<button type='submit' class='btn btn-primary btn-block'><b class='text-center'>Submit</b></button>

			</form>
		</div>
	</div>
	<br>
	<br>
	<a href="http://www.cardhappening.com">
		<button class="btn btn-default btn-block">Wrong place? Return to the homepage.</button>
	</a>
</div>
<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"></div>
