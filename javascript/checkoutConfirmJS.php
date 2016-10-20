<script type='text/javascript'>
	$(function(){
		$(document.body).on("click", ".confirmRemove", function(){
			var id = $(this).attr('id');
			id = id.split('confirmRemove');
			console.log(id[1]);
			$.post('ajax/removeFromCartAJAX.php', {id:id[1]}, function(data){
				$('#checkoutConfirmForm').submit();
			})
		})
	})
</script>
