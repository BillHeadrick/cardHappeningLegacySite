<script type='text/javascript'>
	$(function(){
		<?php
		/*Retailer Object
		 * Used for rough calculations. 
		 * Will be recalculated next time.
		 */
		?>
		var Retailer = function(ppc, minOrder) {
    		this.PPC = ppc;
    		this.MinOrder = minOrder;
    		
    		this.getPPC = function() {
        	return this.PPC;
   			};
   			
   			this.getMinOrder = function() {
        	return this.MinOrder;
   			};
   			
		}
		
		var retailer = new Retailer(<? echo $_SESSION['retailer']->paymentProfile->getCostPerCard() .",". $_SESSION['retailer']->paymentProfile->getMinimumOrder(); ?>);
		
		updateTotal();
		$(document.body).on("keyup", ".quantity", function()
		{
			var id = $(this).attr("id");
			var qty = $(this).val();
			var total = qty * retailer.getPPC();
			id = id+"Cost";
			$("#"+id).empty();
			$("#"+id).append("$"+total);
			updateTotal();
		})
		
		$(document.body).on("change", ".quantity", function()
		{
			var id = $(this).attr("id");
			var qty = $(this).val();
			var total = qty * retailer.getPPC();
			id = id+"Cost";
			$("#"+id).empty();
			$("#"+id).append("$"+total);
			updateTotal();
		})
		
		function updateTotal(){
			var total = 0;
			$('.quantity').each(function(){
				total = total + $(this).val()*retailer.getPPC();
			})
			//update total
			$('#orderTotal').empty();
			$('#orderTotal').append("$"+total);
			if(total >= retailer.getMinOrder())
			{	//we have more than the min order
				$('#orderButton').prop('disabled', false);
				$('#totalHolder').removeClass("error");
			}
			else
			{	//we have less than the min order
				$('#orderButton').prop('disabled', true);
				$('#totalHolder').addClass("error");
			}
		}
		
		<?php 
		 /*Handles submitting the button
		 * first calculates to make sure they are above the min order
		 * then submits form
		 */
		?>
		$(document.body).on("click", "#orderButton", function(){
			var total = 0;
			$('.quantity').each(function(){
				total = total + $(this).val()*retailer.getPPC();
			})
			if(total >= retailer.getMinOrder())
			{	//we have more than the min order
				$("#newOrder").submit();
			}
			else
			{
				updateTotal();
			}
			
		})
	})
	
	$(function(){
		$('.quantity').trigger("change");
	})
	
	$(function(){ <?php //handling the image on click ?>
		$('.overlay').hide();
		$(document.body).on('click', '.product-order-image', function(){
			console.log("we have been clicked");
			var source = $(this).attr('src');
			$('.overlay').fadeIn(550);
			$('.overlay').html("<div class='col-xs-2 col-sm-2 col-md-3 col-lg-3'></div><div class='col-xs-8 col-sm-8 col-md-6 col-lg-6'><div class='panel panel-default panel-body click-image-display'><button class='btn btn-default pull-right' id='close-overlay'><span class='fa fa-times'></span></button><img src='"+source+"' class='center-block click-image img-rounded'></div></div><div class='col-xs-2 col-sm-2 col-md-3 col-lg-3'>");
		})
		$(document.body).on('click', '#close-overlay', function(){
			$('.overlay').empty();
			$('.overlay').fadeOut(550);
		})
	})
	
	$(function(){
		var state = <?php echo $_SESSION['retailerOrderState']; ?>;
		$(document.body).on("click", "#checkoutNav1", function(){
			$("#changeState1").submit();
		})
		$(document.body).on("click", "#checkoutNav2", function(){
			console.log("you clicked the second!");
			if(state >= 3)
			{
			$("#changeState2").submit();
			}
		})
	})
</script>