<?php

/*
 * recovery:
 * 0 = need an email
 */
if($_SESSION['recovery'] == 0)
{
	echo "
	<p class='statement text-center'>Password Recovery</p>
	<p class='text-center'>Please enter your email and a new password will be sent to you.</p>
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
else if($_SESSION['recovery'] == 1)
{
	echo "
	<p class='statement text-center'>Password Recovery</p>
	<p class='statement text-center'><b>Error:</b> We have no records of that email address. Either try a different email address or email william@cardhappening.com and we will get to the bottom of the issue. Sorry for any inconveniance.</p>
	<p class='text-center'>Please enter your email and a new password will be sent to you.</p>
	<form name='recoverPassword' action='". htmlentities($_SERVER['PHP_SELF'])."' method='post' id='newOrder'>
		<div class='form-group'>
			<label for='email'>Email</label>
			<input type='text' name='email' placeholder='Email' class='form-control'>
		</div>
		<input type='submit' class='btn btn-default btn-block' value='Submit!'>
	</form>
	<p class='text-center'><b>If you are still having trouble accessing your account please email: <br> william@cardhappening.com</b></p>
	";
} else if($_SESSION['recovery'] == 2)
{
	echo "<p class='statement text-center'>A new password has been sent to ".$_SESSION['recovery_email'].".<br><br>Thank you for carrying hand-painted cards by Card Happening!<br>If you need any more assistance please email william@cardhappening.com.</p>";
}
else if($_SESSION['recovery'] == 3)
{
		echo "
	<p class='statement text-center'>Password Recovery</p>
	<p class='statement text-center'><b>Error:</b>We have encountered a strange server side error. Please try again. If the problem consists, or if you see this message more than once please email william@cardhappening.com and we will get to the bottom of the issue. Sorry for any inconveniance.</p>
	<p class='text-center'>Please enter your email and a new password will be sent to you.</p>
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