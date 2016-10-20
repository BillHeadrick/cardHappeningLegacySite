<?php 
if($_SESSION['error'] == 1)
{	//user submitted incorrect password
	echo "
	<div class='row'>
	<div class='hidden-xs col-sm-2 col-md-2 col-lg-2'></div>
	<div class='col-xs-12 col-sm-8 col-md-8 col-lg-8'>
		<div class='panel panel-body standard-color'>
			<p class='error statement text-center'>Incorrect Password!</p>
		</div>
	</div>
	<div class='hidden-xs col-sm-2 col-md-2 col-lg-2'></div>
	</div>
	";
}
if($_SESSION['error'] == 2)
{	//user submitted an email address that is already in the database
	echo "
	<div class='row'>
	<div class='hidden-xs col-sm-2 col-md-2 col-lg-2'></div>
	<div class='col-xs-12 col-sm-8 col-md-8 col-lg-8'>
		<div class='panel panel-body standard-color'>
			<p class='error statement text-center'>That email address is already in use.</p>
		</div>
	</div>
	<div class='hidden-xs col-sm-2 col-md-2 col-lg-2'></div>
	</div>
	";
}
?>

<div class='row'>
	<div class='hidden-xs col-sm-2 col-md-2 col-lg-2'></div>
	<div class='col-xs-12 col-sm-8 col-md-8 col-lg-8'>
		<div class='panel panel-body standard-color'>
			<p class='text-center statement'>Account Information</p>
			<p class='pull-left statement'>
			<?php
			if($_SESSION['retailer']->contact->getCompany() != "")
			{
				echo "Company: ".$_SESSION['retailer']->contact->getCompany()."<br>";
			}
			if($_SESSION['retailer']->contact->getName() != "")
			{
				echo "Contact: ".$_SESSION['retailer']->contact->getName()."<br>";
			}
			if($_SESSION['retailer']->contact->getPosition() != "")
			{
				echo "Contact Position: ".$_SESSION['retailer']->contact->getPosition()."<br>";
			}
			if($_SESSION['retailer']->contact->getPhone() != "")
			{
				echo "Phone: ".$_SESSION['retailer']->contact->getPhone()."<br>";
			}
			if($_SESSION['retailer']->contact->getEmail() != "")
			{
				echo "Email: ".$_SESSION['retailer']->contact->getEmail()."<br>";
			}
			?>
			</p>
				<button type='button' class='btn btn-default btn-block' id='updateContact'><b>Update Contact Info</b></button>
		</div>
	</div>
	<div class='hidden-xs col-sm-2 col-md-2 col-lg-2'></div>
</div>
<div class='row' id='updateContactForm'>
	<div class='hidden-xs col-sm-2 col-md-2 col-lg-2'></div>
	<div class='col-xs-12 col-sm-8 col-md-8 col-lg-8'>
		<div class='panel panel-body standard-color'>
			<p class='text-center statement'>Update Contact Info</p>
			<?php echo "<form name='updateContactForm' action='". htmlentities($_SERVER['PHP_SELF'])."' method='post' id='updateContactForm'>
			<input type='hidden' name='update' value='contact'>"; ?>
			<div class="form-group">
				<label for="company">Company</label>
				<input type="text" class="form-control" id="company" name="company">
			</div>
			<div class="form-group">
				<label for="firstName">First Name</label>
				<input type="text" class="form-control" id="firstName" name="firstName">
			</div>
			<div class="form-group">
				<label for="lastName">Last Name</label>
				<input type="text" class="form-control" id="lastName" name="lastName">
			</div>
			<div class="form-group">
				<label for="position">Position</label>
				<input type="text" class="form-control" id="position" name="position">
			</div>
			<div class="form-group" id='emailGroup'>
				<label for="email" class="control-label">Email</label>
				<input type="text" class="form-control" id="email" name="email">
			</div>
			<div class="form-group">
				<label for="phone">Phone</label>
				<input type="text" class="form-control" id="phone" name="phone">
			</div>
			<div class="form-group" id='newPasswordGroup'>
				<label for="newPassword" class="control-label">New Password</label>
				<input type="text" class="form-control" id="newPassword" name="newPassword">
				<p class="help-block">Must be 6 or more characters.</p>
			</div>
			<div class="form-group" id='currentPasswordGroup'>
				<label for="currentPassword" class="control-label">Current Password*</label>
				<input type="text" class="form-control" id="currentPassword" name="currentPassword">
			</div>
			<button type='button' class='btn btn-default btn-block' id='submitUpdate'><b>Update!</b></button>
			</form>
		</div>
	</div>
	<div class='hidden-xs col-sm-2 col-md-2 col-lg-2'></div>
</div>
