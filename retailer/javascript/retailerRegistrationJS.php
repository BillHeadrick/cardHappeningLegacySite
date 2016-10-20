<script type='text/javascript'>
	$(function(){
		$('#passwordFeedback').hide();
		$('#emailFeedback').hide();
		
		$(document.body).on("click", "#contactSubmit", function()
		{
			var error = false;
			if($('#company').val() == "")
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
			
			if($('#firstName').val() == "")
			{
				$('#firstNameFormGroup').removeClass("has-success");
				$('#firstNameFormGroup').addClass("has-error");
				error = true;
			}
			else
			{
				$('#firstNameFormGroup').removeClass("has-error");
				$('#firstNameFormGroup').addClass("has-success");
			}
			
			if($('#lastName').val() == "")
			{
				$('#lastNameFormGroup').removeClass("has-success");
				$('#lastNameFormGroup').addClass("has-error");
				error = true;
			}
			else
			{
				$('#lastNameFormGroup').removeClass("has-error");
				$('#lastNameFormGroup').addClass("has-success");
			}
			
			if($('#phone').val() == "")
			{
				$('#phoneFormGroup').removeClass("has-success");
				$('#phoneFormGroup').addClass("has-error");
				error = true;
			}
			else
			{
				$('#phoneFormGroup').removeClass("has-error");
				$('#phoneFormGroup').addClass("has-success");
			}
			
			if(!isEmail($('#email').val()))
			{
				$('#emailFormGroup').removeClass("has-success");
				$('#emailFormGroup').addClass("has-error");
				error = true;
			}
			else
			{	<?php //check if email is unique ?>
				$.post("ajax/emailVerificationAJAX.php", {email:$('#email').val()}, function(data){
					console.log(data);
					if(data == "false")
					{
						console.log("the email was not unique");
						$('#emailFormGroup').removeClass("has-success");
						$('#emailFormGroup').addClass("has-error");
						$('#emailFeedback').show();
						error = true;
					}
					if(data == "true")
					{
						console.log("the email was unique");
						$('#emailFormGroup').removeClass("has-error");
						$('#emailFormGroup').addClass("has-success");
						$('#emailFeedback').hide();
					}
					
					if(!error)
					{
						$('#retailContact').submit();
					}
					
				});
			}			
			
		})
		
			function isEmail(email){
 
			return /^([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22))*\x40([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d))*$/.test( email );
			} 
			
			$(document.body).on("click", "#submitPassword", function()
			{	<?php //delete previous messages, hide message box, remove success/error statuses ?>
				$('#passwordFeedback').empty();
				$('#passwordFeedback').hide();
				$('#password1FormGroup').removeClass("has-error");
				$('#password2FormGroup').removeClass("has-error");
				$('#password1FormGroup').removeClass("has-success");
				$('#password2FormGroup').removeClass("has-success");
				
				if($('#password1').val().length < 6)
				{
					$('#passwordFeedback').append("<p class='text-center'>The password must be at least 6 characters.</p>");
					$('#passwordFeedback').show();
				} 
				else if($('#password1').val() != $('#password2').val())
				{
					$('#passwordFeedback').append("<p class='text-center'>The two passwords do not match.</p>");
					$('#passwordFeedback').show();						
				} else 
				{
					$('#retailPassword').submit();
				}
			});
			
	})
</script>

