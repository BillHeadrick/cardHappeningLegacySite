<script type='text/javascript'>
	$(function(){
		$('#updateContactForm').hide(); <?php //initially we hide the update contact form ?>
		
		$(document.body).on('click', '#updateContact', function(){
			$('#updateContactForm').fadeIn(500); <?php //reveal the update contact form ?>
		})
		
		$(document.body).on('click', '#submitUpdate', function(){
			$('#currentPasswordGroup').removeClass('has-error');
			$('#newPasswordGroup').removeClass('has-error');
			$('#emailGroup').removeClass("has-error");
			var error = false;
			if($('#currentPassword').val() == "")
			{
				$('#currentPasswordGroup').addClass('has-error');
				error = true;
			}
			if($('#newPassword').val() != "" && $('#newPassword').val().length < 6)
			{
				$('#newPasswordGroup').addClass('has-error');
				error = true;
			}
			if($('#email').val() != "")
			{
				if(!isEmail($('#email').val()))
				{
				$('#emailGroup').addClass("has-error");
				error = true;
				}
			}
			if(!error)
			{
				$('form#updateContactForm').submit();
			}			
		})
	})
	
	function isEmail(email){
		return /^([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22))*\x40([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d))*$/.test( email );
	} 
</script>
