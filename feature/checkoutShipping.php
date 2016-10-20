<div class='row'>
	<div class='hidden-xs col-sm-2 col-md-3 col-lg-3'></div>
	<div class='col-xs-12 col-sm-8 col-md-6 col-lg-6'>
		<div class='panel panel-default'>
			<div class='panel-body standard-color'>
				<?php
				checkoutPagination();
				?>
				<br>
				<br>
				<!--testing!!!!!!!!!!!!!!-->
				<form role='form' method='post' id='checkoutShipping' action='<?php echo htmlentities($_SERVER['PHP_SELF']); ?>'>
				<div class='form-group'>
					<label for='email' class='control-label'>
						Email*
					</label>
					<input class='form-control' type='email' id='email' name='email'>
				</div>
				<h2 class='text-center'>
					Shipping Address
				</h2>
				<div class='row'>
					<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6'>
						<div class='form-group'>
							<label for='firstName' class='control-label'>
								First Name*
							</label>
							<input class='form-control' type='text' id='firstName' name='firstName'>
						</div>
					</div>
					<div class='col-xs-12 col-sm-12 col-md-6 col-lg-6'>
						<div class='form-group'>
							<label for='lastName' class='control-label'>
								Last Name*
							</label>
							<input class='form-control' type='text' id='lastName' name='lastName'>
						</div>
					</div>
				</div>
				<div class='form-group'>
					<label for='address1' class='control-label'>
						Address Line 1*
					</label>
					<input type='text' class='form-control' id='address1' name='address1'>
				</div>
				<div class='form-group'>
					<label for='address2'>
						Address Line 2 (optional)
					</label>
					<input type='text' class='form-control' id='address2' name='address2'>
				</div>
				<div class='row'>
					<div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
						<div class='form-group'>
							<label for='city' class='control-label'>
								City*
							</label>
							<input type='text' class='form-control' name='city' id='city'>
						</div>
					</div>
					<div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
						<div class='form-group'>
							<label for='state' class='control-label'>
								State*
							</label>
							<?php include('feature/stateSelect.php'); ?>
						</div>
					</div>
					<div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
						<div class='form-group'>
							<label for='zipcode' class='control-label'>
								ZIP code*
							</label>
							<input type='number' class='form-control' min='0' maxlength='5' name='zipcode' id='zipcode'>
						</div>
					</div>
				</div>
			
				<div class='form-group'>
					<label for='country' class='control-label'>
						Country*
					</label>
					<?php 
					include('feature/countrySelect.php');
					?>
				</div>
				<button class='btn btn-primary btn-block' type='button' id='checkout_payment' name='checkout_payment'><b class='text-center'>Submit</b></button>
				
				</form>
				<div id='error-message' class='error'>
					
				</div>
				<!--end of teseting-->
			</div>
		</div>
	</div>
	<div class='hidden-xs col-sm-2 col-md-3 col-lg-3'></div>
</div>
