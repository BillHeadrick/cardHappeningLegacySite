<?php

/*
 * 1. Check for Contact Information
 * 2. Check for Terms and Conditions
 * 3. Check for Sample Policies
*/

//check for contact information
if(!$_SESSION['retailer']->contact->contactExists()) //we need to prompt them to register their contact information
{
	echo "
	<div class='row'>
	<div class='hidden-xs col-sm-3 col-md-3 col-lg-3'></div>
	<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
		<div class='panel panel-default'>
			<div class='panel-body standard-color'>
			<p class='text-center statement'><b>Retailer Contact</b></p>
			<form name='retailContact' action='". htmlentities($_SERVER['PHP_SELF']) ."' method='post' id='retailContact'>
			<div class='form-group has-feedback' id='companyFormGroup'>
				<label class='control-label' for='company'>Company*</label>
				<input type='text' class='form-control' id='company' name='company'>
			</div>
			<div class='row'>
				<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
					<div class='form-group has-feedback' id='firstNameFormGroup'>
						<label class='control-label' for='firstName'>Contact First Name*</label>
						<input type='text' class='form-control' id='firstName' name='firstName'>
					</div>
				</div>
				<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
					<div class='form-group has-feedback' id='lastNameFormGroup'>
						<label class='control-label' for='lastName'>Contact Last Name*</label>
						<input type='text' class='form-control' id='lastName' name='lastName'>
					</div>
				</div>
			</div>
			<div class='form-group has-feedback' id='positionFormGroup'>
				<label class='control-label' for='position'>Position</label>
				<input type='text' class='form-control' id='position' name='position'>
			</div>
			<div class='form-group has-feedback' id='emailFormGroup'>
				<label class='control-label' for='email'>Email*</label>
				<input type='text' class='form-control' id='email' name='email'>
			</div>
			<div class='form-group has-feedback' id='phoneFormGroup'>
				<label class='control-label' for='phone'>Phone Number*</label>
				<input type='tel' class='form-control' id='phone' name='phone'>
			</div>
			<div class='panel panel-body panel-warning' id='emailFeedback'>
			<p class='text-center'>That email account is already registered to a retailer account. <a href='https://www.cardhappening.com/retailer/signOut.php'>Try logging in or recovering your account.</a></p>
			</div>
			<button type='button' class='btn btn-block btn-default' id='contactSubmit' name='contactSubmit'><b>Update Retailer Contact</b></button>
			</form>
			<b>*Required Field</b>
			</div>
		</div>
	</div>
	<div class='hidden-xs col-sm-3 col-md-3 col-lg-3'></div>
	</div>
	";
}
else {
	if(!($_SESSION['retailer']->contact->getPass()))	
	{
	//time to create a password
	echo "
	<div class='row'>
		<div class='hidden-xs col-sm-3 col-md-3 col-lg-3'></div>
		<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
			<div class='panel panel-default panel-body standard-color'>
				<p class='text-center statement'><b>Choose Password</b></p>
				<form name='retailPassword' action='". htmlentities($_SERVER['PHP_SELF']) ."' method='post' id='retailPassword'>
					<div class='form-group has-feedback' id='emailFormGroup'>
						<label class='control-label' for='email'>Login Email</label>
						<input type='text' class='form-control' id='email' name='email' value='". $_SESSION['retailer']->contact->getEmail()."'readonly>
					</div>
					<div class='form-group has-feedback' id='password1FormGroup'>
						<label class='control-label' for='password1'>Password*</label>
						<input type='password' class='form-control' id='password1' name='password1'>
					</div>
					<div class='form-group has-feedback' id='password2FormGroup'>
						<label class='control-label' for='password2'>Confirm Password*</label>
						<input type='password' class='form-control' id='password2' name='password2'>
					</div>
					<p class='text-center'>Password must be at least 6 characters long.</p>
					<div class='panel panel-body panel-warning' id='passwordFeedback'>
					</div>
					<button type='button' class='btn btn-default btn-block' id='submitPassword'><b>Submit Password</b></button>
				</form>
			</div>
		</div>
		<div class='hidden-xs col-sm-3 col-md-3 col-lg-3'></div>
	</div>
	";
	}
}

?>