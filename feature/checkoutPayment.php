<div class='row'>
	<div class='hidden-xs col-sm-2 col-md-3 col-lg-3'></div>
	<div class='col-xs-12 col-sm-8 col-md-6 col-lg-6'>
		<?php
		if(isset($_SESSION['error']) && $_SESSION['error'] == 2){
			echo "<div class='alert alert-danger' role='alert'>
			<p class='text-center'><b>Payment Validation Failed: Processor Declined</b></p><br><p class='text-center'>For security reasons you must re-enter your credit card information.</p><p class='text-center'><i>Tip: you may use a different credit card or checkout with paypal.</i></p>
			</div>";
		}
		?>
		
		<div class='panel panel-body panel-default standard-color'>
			<?php
				checkoutPagination();
			?>
			<br>
			<br>
			<h2 class='text-center'>
				Billing Information
			</h2>
			<form role='form' method='post' id='checkoutPayment' action='<?php echo htmlentities($_SERVER['PHP_SELF']); ?>'>
			<div id='dropin'></div>
			<b class='text-center'>Total Payment: $<?php echo $_SESSION['total']; ?></b>
			<button type='submit' id='checkoutPaymenySubmit' class='btn btn-primary btn-block'><b class='text-center'>Submit</b></button>
			</form>
		</div>
	</div>
	<div class='hidden-xs col-sm-2 col-md-3 col-lg-3'></div>
</div>