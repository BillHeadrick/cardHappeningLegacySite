<p class='statement text-center'><b>Shipping Address:</b></p>
<?php
$q = "SELECT * FROM `retailer_address` WHERE `retailer_id` = '".$_SESSION['retailer']->getRetailerId()."'";
$r = mysqli_query($dbc, $q);

if($r && mysqli_num_rows($r) > 0)
{
	echo "<p class='statement'>Select a previously used address:</p>
	<div class='radio'>";
	while($results = mysqli_fetch_assoc($r))
	{
		echo "
		<div class='panel panel-body'>
		<label>
			<input type='radio' class='previousAddress' name='address' value='".$results['retailer_address_id']."'>
			<p class='text-center'>
				$results[company] <br>";
				if($results['attention'] != ""){
					echo $results['attention'] ."<br>";
				}
		echo"
			$results[address_1] <br>";
				if($results['address_2'] != "")
				{
					echo $results['address_2'] . "<br>";
				}
		echo "
			$results[city], ";
			if($results['state']!= "")
			{
				echo $results['state'].", ";
			}
		echo"
			$results[postal_code] <br>
			$results[country]
			</p>	
		</div>";
	}
	echo "
	<p class='statement'>New shipping address:</p>
	<div class='panel panel-body'>
	<label for='newAddress' class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
		<input type='radio' id='newAddress' name='address' value='newAddress'>
	<div class='row'>
		<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
			<div class='form-group' id='companyFormGroup'>
				<label for='company' class='control-label'>
					Company*
				</label>
				<input class='form-control newRetailerAddress' type='text' id='company' name='company'>
			</div>
		</div>
		<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
			<div class='form-group'>
				<label for='attention' class='control-label'>
					Attention:
				</label>
				<input class='form-control newRetailerAddress' type='text' id='attention' name='attention'>
			</div>
		</div>
		</div>
		<div class='form-group' id='address1FormGroup'>
			<label for='address1' class='control-label'>
				Address Line 1*
			</label>
			<input type='text' class='form-control newRetailerAddress' id='address1' name='address1'>
		</div>
		<div class='form-group' id='address2FormGroup'>
			<label for='address2'>
				Address Line 2 (optional)
			</label>
			<input type='text' class='form-control newRetailerAddress' id='address2' name='address2'>
		</div>
		<div class='row'>
			<div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
				<div class='form-group' id='cityFormGroup'>
					<label for='city' class='control-label'>
						City*
					</label>
					<input type='text' class='form-control newRetailerAddress' name='city' id='city'>
				</div>
			</div>
			<div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
				<div class='form-group' id='stateFormGroup'>
					<label for='state' class='control-label'>
						State* (If in U.S.)
					</label>
					";include('../feature/stateSelect.php'); 
				echo "
				</div>
			</div>
			<div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
				<div class='form-group' id='postalCodeFormGroup'>
					<label for='postalCode' class='control-label'>
						Postal Code* 
					</label>
					<input type='text' class='form-control newRetailerAddress' name='postalCode' id='postalCode'>
				</div>
			</div>
		</div>
	
		<div class='form-group' id='countryFormGroup'>
			<label for='country' class='control-label'>
				Country*
			</label>
			";
			include('../feature/countrySelect.php');
			echo"
		</div>
	</label>
	</div>
	</div><!--end of radio-->
		";
} 
else
{	//there are no previous addresses on record so the only option is to include our address
	echo "
	<p class='statement'>Shipping Address:</p>
	<div class='panel panel-body'>
	<div class='row'>
	<label for='newAddress' class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
		<input type='radio' id='newAddress' name='address' value='newAddress'>
		<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
			<div class='form-group' id='companyFormGroup'>
				<label for='company' class='control-label'>
					Company*
				</label>
				<input class='form-control newRetailerAddress' type='text' id='company' name='company'>
			</div>
		</div>
		<div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'>
			<div class='form-group' id='attentionFormGroup'>
				<label for='attention' class='control-label'>
					Attention:
				</label>
				<input class='form-control newRetailerAddress' type='text' id='attention' name='attention'>
			</div>
		</div>
		</div>
		<div class='form-group' id='address1FormGroup'>
			<label for='address1' class='control-label'>
				Address Line 1*
			</label>
			<input type='text' class='form-control newRetailerAddress' id='address1' name='address1'>
		</div>
		<div class='form-group' id='address2FormGroup'>
			<label for='address2'>
				Address Line 2 (optional)
			</label>
			<input type='text' class='form-control newRetailerAddress' id='address2' name='address2'>
		</div>
		<div class='row'>
			<div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
				<div class='form-group' id='cityFormGroup'>
					<label for='city' class='control-label'>
						City*
					</label>
					<input type='text' class='form-control newRetailerAddress' name='city' id='city'>
				</div>
			</div>
			<div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
				<div class='form-group' id='stateFormGroup'>
					<label for='state' class='control-label'>
						State* (If in U.S.)
					</label>";
					include('../feature/stateSelect.php');
				echo "
				</div>
			</div>
			<div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
				<div class='form-group' id='postalCodeFormGroup'>
					<label for='postalCode' class='control-label'>
						Postal Code* 
					</label>
					<input type='text' class='form-control newRetailerAddress' name='postalCode' id='postalCode'>
				</div>
			</div>
		</div>
	
		<div class='form-group' id='countryFormGroup'>
			<label for='country' class='control-label'>
				Country*
			</label>"; 
			include('../feature/countrySelect.php');
	echo"</input>
	</label>
		</div>
</div>";
}
?>

<button type='button' class='btn btn-block btn-primary' id='submitShipping'><p class='statement'><b>Submit Shipping Information!</b></p></button>

