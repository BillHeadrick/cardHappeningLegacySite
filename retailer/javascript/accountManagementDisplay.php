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
				<input type="text" class="form-control" id="company">
			</div>
			<div class="form-group">
				<label for="firstName">First Name</label>
				<input type="text" class="form-control" id="firstName">
			</div>
			<div class="form-group">
				<label for="lastName">Last Name</label>
				<input type="text" class="form-control" id="lastName">
			</div>
			<div class="form-group">
				<label for="position">Position</label>
				<input type="text" class="form-control" id="position">
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="text" class="form-control" id="email">
			</div>
			<div class="form-group">
				<label for="phone">Phone</label>
				<input type="text" class="form-control" id="phone">
			</div>
			<div class="form-group">
				<label for="newPassword">New Password</label>
				<input type="text" class="form-control" id="newPassword">
				<p class="help-block">Must be 6 or more characters.</p>
			</div>
			<div class="form-group">
				<label for="currentPassword">Current Password*</label>
				<input type="text" class="form-control" id="currentPassword">
			</div>
			<button type='button' class='btn btn-default btn-block'><b>Update!</b></button>
			</form>
		</div>
	</div>
	<div class='hidden-xs col-sm-2 col-md-2 col-lg-2'></div>
</div>
