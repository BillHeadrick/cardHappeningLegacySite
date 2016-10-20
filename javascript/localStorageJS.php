<script type="text/javascript">
	var local_storage_support = false; 
	var cart_id = null;
	<?php 
	//local_storage_support set to false by defualt, if it is there we will check and update 
	//cart_id = value to be stored in local storage
	?>
	
	function supports_html5_storage() {
		try {
		  	return 'localStorage' in window && window['localStorage'] !== null;
		} 
		catch (e) {
			return false;
		}
	}
	
	var local_storage_support = false;
	var cart_id = null;
	if (supports_html5_storage()){
		local_storage_support = true;
		if (localStorage.getItem("cart_id") != null){
			cart_id = localStorage.getItem("cart_id");
			restoreCart(cart_id);
		} else {
			$.post('ajax/newCartAJAX.php', function(data){
			cart_id = data;
			localStorage.setItem("cart_id", cart_id);
		});
		}
	}
	
	if(!supports_html5_storage()){
		if(cart_id === null){
			$.post('ajax/newCartAJAX.php', function(data){
				cart_id = data;
			});
		}
	}
	
	
	
	
</script>
