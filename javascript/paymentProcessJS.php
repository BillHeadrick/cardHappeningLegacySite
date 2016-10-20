<script type='text/javascript'>

	$(function(){
		$(document.body).on('click', '#checkout_payment', function(){
			<?php //trigger all changes?>
			validateShipping();
			
		}) 
		<?php //email vaildation ?>
		$(document.body).on('change', '#email', function(){
			var email = $(this).val();
			if(isEmail(email)){
				if($(this).parent().hasClass('has-error')){
					$(this).parent().removeClass('has-error');
				}
				$(this).parent().addClass('has-success');
			} else{
				if($(this).parent().hasClass('has-success')){
					$(this).parent().removeClass('has-success');
				}
				$(this).parent().addClass('has-error');
			}
		})
		<?php //firstname vaildation ?>
		$(document.body).on("change", "#firstName", function(){
			var name = $(this).val();
			if(isName(name)){
				if($(this).parent().hasClass('has-error')){
					$(this).parent().removeClass('has-error');
				}
				$(this).parent().addClass('has-success');
			} else{
				if($(this).parent().hasClass('has-success')){
					$(this).parent().removeClass('has-success');
				}
				$(this).parent().addClass('has-error');
			}
		})
		<?php //lastname vaildation ?>
		$(document.body).on("change", "#lastName", function(){
			var name = $(this).val();
			if(isName(name)){
				if($(this).parent().hasClass('has-error')){
					$(this).parent().removeClass('has-error');
				}
				$(this).parent().addClass('has-success');
			} else{
				if($(this).parent().hasClass('has-success')){
					$(this).parent().removeClass('has-success');
				}
				$(this).parent().addClass('has-error');
			}
		})
		<?php //first address line validation ?>
		$(document.body).on("change", "#address1", function(){
			var address = $(this).val();
			if(isAddress(address)){
				if($(this).parent().hasClass('has-error')){
					$(this).parent().removeClass('has-error');
				}
				$(this).parent().addClass('has-success');
			} else{
				if($(this).parent().hasClass('has-success')){
					$(this).parent().removeClass('has-success');
				}
				$(this).parent().addClass('has-error');
			}
		})
		<?php //zipcode validation ?>
		$(document.body).on("change", "#zipcode", function(){
			var zipcode = $(this).val();
			if(isZipcode(zipcode)){
				if($(this).parent().hasClass('has-error')){
					$(this).parent().removeClass('has-error');
				}
				$(this).parent().addClass('has-success');
			} else{
				if($(this).parent().hasClass('has-success')){
					$(this).parent().removeClass('has-success');
				}
				$(this).parent().addClass('has-error');
			}
		})
		$(document.body).on("change", "#city", function(){
			var city = $(this).val();
			if(isCity(city)){
				if($(this).parent().hasClass('has-error')){
					$(this).parent().removeClass('has-error');
				}
				$(this).parent().addClass('has-success');
			} else{
				if($(this).parent().hasClass('has-success')){
					$(this).parent().removeClass('has-success');
				}
				$(this).parent().addClass('has-error');
			}
		})
	})
	
	function isCity(city){
		if(city == ""){
			return false;
		} 
		else {
			return true;
		}		
	}
	
	function isZipcode(zipcode){
		if(zipcode == ""){
			return false;
		} 
		else return true;
		//if(zipcode.length > 5){
			//return false;
		//} else {
			//return true;
		//}
	}
	
	function isAddress(address){
		if(address == ""){
			return false;
		}else {
			return true;
		}
	}
	
	function isName(name){
		if(name == ""){
			return false;
		}
		else{
			return true;
		}
	}
	function validateShipping(){
		$('#email').trigger("change");
			$('#firstName').trigger("change");
			$('#lastName').trigger("change");
			$('#address1').trigger("change");
			$('#zipcode').trigger("change");
			$('#city').trigger("change");
			$('#error-message').empty();
			if($('#email').parent().hasClass("has-error") || $('#firstName').parent().hasClass("has-error") || $('#lastName').parent().hasClass("has-error") || $('#address1').parent().hasClass("has-error") || $('#zipcode').parent().hasClass("has-error") || $('#city').parent().hasClass("has-error")){
				$('#error-message').append("<b class='text-center'>There is a problem in your shipping information.</b>");
				return;
			} else{
				console.log("we are moving on");
				$('#checkoutShipping').submit();
			}
	}
	
	function isEmail(email){
 
	return /^([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22))*\x40([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d))*$/.test( email );
	} 
</script>
