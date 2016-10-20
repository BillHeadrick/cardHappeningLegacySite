<div class='hidden-xs col-sm-2 col-md-3 col-lg-3'></div>
<div class='col-xs-12 col-sm-8 col-md-6 col-lg-6'>
	<div class='panel panel-default panel-body'>
		<h2 class='text-center'>Admin Log In</h2>
		<form name='adminLogin' method='post' action='<?php echo htmlentities($_SERVER['PHP_SELF']); ?>'>
		<div class='form-group'>
			<label for='adminUser'>User</label>
			<input type='text' id='adminUser' name='adminUser' class='form-control'>
		</div>
		<div class='form-group'>
			<label for='adminPassword'>Password</label>
			<input type='password' id='adminPassword' name='adminPassword' class='form-control'>
		</div>
		<button type='submit' id='submitLogin' name='submitLogin' class='btn btn-default btn-block'>Cardhappening Administration Log In</button>
		</form>
	</div>
</div>
<div class='hidden-xs col-sm-2 col-md-3 col-lg-3'></div>
