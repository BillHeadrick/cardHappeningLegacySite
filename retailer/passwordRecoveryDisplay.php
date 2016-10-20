<?php

/*
 * recovery:
 * 0 = need an email
 */
if($_SESSION['recovery'] == 0)
{
	echo "
	<p class='statement text-center'>Password Recovery</p>
	<form name='recoverPassword' action='". htmlentities($_SERVER['PHP_SELF'])."' method='post' id='newOrder'>
		<div class='form-group'>
			<label for='email'>Email</label>
			<input type='text' name='email' placeholder='Email' class='form-control'>
		</div>
		<input type='submit' class='btn btn-default btn-block' value='Submit!'>
	</form>
	<p class='text-center'><b>If you are still having trouble accessing your account please email: <br> william@cardhappening.com</b></p>
	";
	
}

?>