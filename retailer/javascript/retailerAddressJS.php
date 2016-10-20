<script type='text/javascript'>
	$(function(){
		$(document.body).on("click", ".newRetailerAddress", function(){
			var radios = $('input:radio[name=address]');
       		radios.filter('[value=newAddress]').prop('checked', true);
		})
		
		<?php
		/*
		 * Verify the shipping form has been completed, if so submit
		 * 1. Check to make sure that shipping method is clicked
		 * 2. Check if there is an option for existing shippings
		 * -if there is an option check if they selected a new one
		 * -if they selected a new one, verify it
		 * -if there is not an option for existing shippings, verify the new one
		 */
		?>
		$(document.body).on("click", "#submitShipping", function(){
			$("#errorMessage").empty();
			$("#errorMessage").hide();
			if(!$("input[name='shippingOptions']:checked").val())
			{	<?php //there is no shippingOption selected ?>
				$("#errorMessage").append("<p class='statement text-center'><b>Submission Error</b></p><p class='text-center'>You must select a shipping option.</p>");	
				$("#errorMessage").show();
				return;
			}
			if ($('input:radio[name=address]').length) 
			{	<?php //the radio group for address exists ?>
   				var selectedAddress = $('input:radio[name=address]:checked').val();
   				if(selectedAddress == undefined)
   				{
   					$("#errorMessage").append("<p class='statement text-center'><b>Submission Error</b></p><p class='text-center'>You must select a shipping address.</p>");	
					$("#errorMessage").show();
					return;
   				}
   				else
   				{
   					if(selectedAddress == "newAddress")
   					{	<?php //we are shipping to a new address ?>
   						var result = verifyNewAddress();
   						if(!result)
   						{	<?php //the new address was not completed ?>
   							$("#errorMessage").append("<p class='statement text-center'><b>Submission Error</b></p><p class='text-center'>Invalid shipping address.</p>");	
							$("#errorMessage").show();
							return;
   						}
   					}
   				}
			} else
			{	<?php //the retailer did not have any previous addresses ?>
				var result = verifyNewAddress();
				if(!result)
				{	<?php //the new address was not completed ?>
					$("#errorMessage").append("<p class='statement text-center'><b>Submission Error</b></p><p class='text-center'>Invalid shipping address.</p>");	
					$("#errorMessage").show();
					return;
				}
			}
			$("#shipping").submit();
		})
		
		<?php 
		/*
		 * Verifys that the new address is proper
		 * returns true if it is, else returns false
		 * 1. Check if company is not blank
		 * 2. Check if address line one is not blank
		 * 3. Check if city is complete
		 * 4. check if postal code is complete
		 * 5. check if country is U.S.
		 * -if U.S. check if state is selected
		 */
		?>
		function verifyNewAddress(){
			var state = $("#state").val();
			var error = false;
			<?php //1. check company is not blank ?>
			if($("#company").val() == "")
			{
				$('#companyFormGroup').removeClass("has-success");
				$('#companyFormGroup').addClass("has-error");
				error = true;
			}
			else
			{
				$('#companyFormGroup').removeClass("has-error");
				$('#companyFormGroup').addClass("has-success");
			}
			<?php //2. check address line one is not blank ?>
			if($("#address1").val() == "")
			{
				$('#address1FormGroup').removeClass("has-success");
				$('#address1FormGroup').addClass("has-error");
				error = true;
			}
			else
			{
				$('#address1FormGroup').removeClass("has-error");
				$('#address1FormGroup').addClass("has-success");
			}
			<?php //3. check if city is blank ?>
			if($("#city").val() == "")
			{
				$('#cityFormGroup').removeClass("has-success");
				$('#cityFormGroup').addClass("has-error");
				error = true;
			}
			else
			{
				$('#cityFormGroup').removeClass("has-error");
				$('#cityFormGroup').addClass("has-success");
			}
			<?php //4. check if postal code is blank ?>
			if($("#postalCode").val() == "")
			{
				$('#postalCodeFormGroup').removeClass("has-success");
				$('#postalCodeFormGroup').addClass("has-error");
				error = true;
			}
			else
			{
				$('#postalCodeFormGroup').removeClass("has-error");
				$('#postalCodeFormGroup').addClass("has-success");
			}
			<?php 
			//5. check if country is U.S.
			//if us, check state is not blank
 			?>
			if($("#country").val() == "")
			{
				$('#countryFormGroup').removeClass("has-success");
				$('#countryFormGroup').addClass("has-error");
				error = true;
			}
			else
			{
				$('#countryFormGroup').removeClass("has-error");
				$('#countryFormGroup').addClass("has-success");
				if($("#country").val() == "US")
				{
					if($("#state").val() == "")
					{
						$('#stateFormGroup').removeClass("has-success");
						$('#stateFormGroup').addClass("has-error");
						error = true;
					}
					else
					{
						$('#stateFormGroup').removeClass("has-error");
						$('#stateFormGroup').addClass("has-success");
					}
				}
			}
			return !error;			
		};
		
		$("#errorMessage").empty();
		$("#errorMessage").hide();
	})
</script>
