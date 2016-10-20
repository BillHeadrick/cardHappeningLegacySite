<script type="text/javascript">
	var cart = [];
	var cart_id = '<?php echo $_SESSION['id']?>';
	var total_cards = 0; <?php //default price per card is 3 ?>
	/*
	 
	cart->id (correlates to database from ajax call) 
	cart->style
	cart->style_id
	cart->quantity
	cart->date
	cart->price
	cart->active
	
	*/
	<?php //restore a cart from a users session ?>
	function restoreCart(){

		$.post("ajax/restoreCartAJAX.php", {session_id:cart_id}, function(data){

			cart_item = data.split('123###456-987~!~!');
			var len = cart_item.length + cart.length;
			var i = cart.length;
			var w = 1; <?php //cart_item[0] is null ?>
			while(i+2<=len){
			var	current = cart_item[w];
			current = String(current);
			current = current.split(',');
//			console.log(current);
				cart[i] = {
					id:current[0],
					style:current[1],
					style_id:current[2],
					quantity:current[3],
					price:current[4],
					date:current[5],
					active:1
				}
				i++;
				w++;
			}
			updateCart();
		})
	}
	
	
	function removeFromCart(id){
		var len = cart.length;
//		console.log(len);
		var i = 0;
		while(i < len){
			if(cart[i].id === id){
//				console.log("we have a match");
				cart[i].active = 0;
			}
			i++;
		}

		updateCart();
	}
	
		
	function updateCart(){
		updateTotalCards();
		$("#cart").empty();
		var l = cart.length;
		var i = 0;
		var total = 0;
		while(i < l){
			if(cart[i].active === 1){
				var insert = '<tr><td><button class="btn btn-default cartRemove" id="cartRemove'+cart[i].id+'"><span class="fa fa-times"></span></button></td><td class="cartDate hidden-xs">'+cart[i].date+'</td><td class="cartStyle" id="cartStyle'+cart[i].id+'">'+cart[i].style+'</td><td class="cartQuantity" id="cartQuantity'+cart[i].id+'">'+cart[i].quantity+'</td><td class="cartPrice" id="cartPrice'+cart[i].id+'">'+cart[i].price+'</td></tr>';
				$("#cart").append(insert);
				total = parseFloat(total) + parseFloat(cart[i].price);
			}
			i++;
		}
		$('#shipping').empty();
		$('#total').empty();
		if(total == 0){
			return;
		}
		if(total < 50){
			total = total + 3.5;
			total = total.toFixed(2);
			$('#shipping').append("Shipping: $3.50");
			$('#total').append("Total: $"+total);
		}
		if(total >= 50){
			total = total.toFixed(2);
			$('#shipping').append("Shipping: complimentary");
			$('#total').append("Total: $"+total);
		}
	}
	
	function updateTotalCards(){ <?php //calculate the price per card ?>
//		console.log("updating total cards");
		var l = cart.length;
//		console.log(l);
		total_cards = 0;
		var i = 0;
		while(i < l){
			if(cart[i].active === 1){
				var y = Number(cart[i].quantity);
				if(y == NaN){
					cart[i].active = 0;
				} else{
					total_cards = total_cards+y; 
				}
				
			}
			i++;
		}
		i = 0;
		while(i<l){ //update the price of the cards
			if(total_cards > 75){ //$2.5 each
				cart[i].price = cart[i].quantity * 6;
			}
			else{
				cart[i].price = cart[i].quantity * 6;
			}
			i++;
		}
//		console.log(total_cards);
	}
	
	
	
	$(function(){
		
		restoreCart();
		
		$(document.body).on("click", ".cartRemove", function( event ){
			event.stopPropagation();
			var id = $(this).attr("id");
			id = id.split("cartRemove");
			id = id[1];
			removeFromCart(id);
			$.post('ajax/removeFromCartAJAX.php', {id:id});
			
		});
		
	})
	
	
</script>
