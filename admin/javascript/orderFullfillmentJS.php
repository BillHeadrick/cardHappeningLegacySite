<script type='text/javascript'>
	$(function(){
		$(document.body).on('click', '.pack', function(){
			$(this).attr('disabled', 'disabled');
			id = $(this).attr('id');
			id = id.split('pack');
			id=id[1];
			
		if($('#pack'+id).hasClass('btn-default')){
				$('#pack'+id).removeClass('btn-default');
				$('#pack'+id).addClass('btn-primary');
				$('#pack'+id).empty();
				$('#pack'+id).append("Packed<i class='fa fa-check'></i>");
				$.post('ajax/packOrderFullfillmentAJAX.php', {id:id, value:'2'}, function(data){
					data = data.split('SDFSFDFSWER');
					$('#pack'+data[0]).removeAttr('disabled');
				})
			} else{
				$('#pack'+id).removeClass('btn-primary');
				$('#pack'+id).addClass('btn-default');
				$('#pack'+id).empty();
				$('#pack'+id).append("Pack");
				$.post('ajax/packOrderFullfillmentAJAX.php', {id:id, value:'1'}, function(data){
					data = data.split('SDFSFDFSWER');
					$('#pack'+data[0]).removeAttr('disabled');
				})
			}
		})
		
		$(document.body).on('click', '.orderShipped', function(){
			console.log("order shipped");
			$(this).attr('disabled', 'disabled');
			var id = $(this).attr('id');
			id = id.split('orderShipped');
			id = id[1];
			$.post('ajax/markAsShippedAJAX.php', {id:id, employee:'<?php echo $_SESSION['admin_id']; ?>'}, function(data){
				$('#orderFullfillment').submit();
			})
		})
		
		$(document.body).on('click', '.retailerPackButton', function(){
			$(this).attr('disabled', 'disabled');
			id = $(this).attr('id');
			id = id.split('retailerPack');
			id=id[1];
			$.post('ajax/retailerPackOrderFullfillment.php', {id:id}, function(data){
				data = data.split("asdasgdfg");
				status = data[0];
				id = data[1];
				if(status == "0")
				{	<?php //not packed ?>
					$('#retailerPack'+id).removeClass("btn-primary");
					$('#retailerPack'+id).addClass("btn-default");
					$('#retailerPack'+id).empty();
					$('#retailerPack'+id).append("Pack");
				}
				else if(status == "1")
				{	<?php //is packed ?>
					$('#retailerPack'+id).removeClass("btn-default");
					$('#retailerPack'+id).addClass("btn-primary");
					$('#retailerPack'+id).empty();
					$('#retailerPack'+id).append("Packed");
				}
				$('#retailerPack'+id).removeAttr("disabled");
			})
		})
		
		$(document.body).on("click", ".retailerShip", function(){
			$(this).attr('disabled', 'disabled');
			id = $(this).attr('id');
			id = id.split('retailerShip');
			id=id[1];
			tracking = $('#trackingNumber'+id).val();
			console.log("The tracking number is "+tracking);
			$.post('ajax/retailerShipAJAX.php', {id:id, employee:'<?php echo $_SESSION['admin_id']; ?>', tracking:tracking}, function(data){
				/*data = data.split("asdasdasd");
				id = data[1];
				status = data[0];
				if(status == "true")
				{
					$("#form"+id).submit();
				}
				else
				{
					$("#retailerShip"+id).removeAttr("disabled");
				}*/
				console.log(data);
				//$("#form"+id).submit();
			})	
		})
	})
</script>
