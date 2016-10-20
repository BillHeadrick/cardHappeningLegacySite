<script type="text/javascript">
	
	$(function(){
		var l = style.length;
		var i = 0;
		while(i < l){
			var insert = '<option value="'+style[i].name+'" id="style'+style[i].id+'">'+style[i].name+'</option>';
			i++;
			$('#styleSelection').append(insert);
		};
		
		$(document.body).on("change", "#quantityInput", function(){
			calculatePrice();
		});
		
		$(document.body).on("keyup", "#quantityInput", function(){
			calculatePrice();
		});
		
		$(document.body).on("keydown", "#quantityInput", function(){
			calculatePrice();
		});
		
		$(document.body).on("click", "#addToCart", function(){
			$("#addToCart").attr("disabled", "disabled");
			calculatePrice();
			var quantity = $("#quantityInput").val();
			if(quantity == ""){
//				console.log("returning");
				$("#addToCart").removeAttr("disabled");
				return;
			}
			var len = cart.length;
			var style_id = $('#styleSelection').children(":selected").attr("id");
			style_id = style_id.split("style");
			style_id = style_id[1];
			var price = $('#priceTotalHolder').text();
			price = price.split("$");
			price = price[1];
			var style = $("#styleSelection").val();
			$.post("ajax/addToCartAJAX.php", {style_id:style_id, style:style, quantity:quantity, price:price, session_id:cart_id}, function(data){
	//			console.log(data);
				if(data === "false"){
					return;
				}
				var len = cart.length;
				data = data.split(",");
				cart[len] = {
					style:data[0],
					style_id:data[1],
					quantity:data[2],
					price:data[3],
					date:data[4],
					id:data[5],
					active:1
				};
				updateCart();
				$("#quantityInput").val("");
				calculatePrice();
				$("#addToCart").removeAttr("disabled");
			});	
			
		});
		
	})
	
	
			function calculatePrice(){
			
			var val = $('#quantityInput').val();
			if(val === ""){
				$('#quantityInput').val("");
			}
			$('#priceEachHolder').empty();
			$('#priceTotalHolder').empty();
			if(Number(val) + total_cards < 76){
				$('#priceEachHolder').append("$6.00");
				var total = 6*val;
				$('#priceTotalHolder').append("$"+total);
			} else {
				$('#priceEachHolder').append("$6.00");
				var total = 6*val;
				$('#priceTotalHolder').append("$"+total);
			}
			return;
		}
		
	$(function(){ //handles the product images transitions
		var current = $("#styleSelection :selected").attr("id");
		$('.product-order-image').hide();
		$('.product-order-description').hide();
		$('.'+current).show();
		
		$(document.body).on("change", "#styleSelection", function(){
			var current = $("#styleSelection :selected").attr("id");
			$('.product-order-image').hide();
			$('.product-order-description').hide();
			$('.'+current).fadeIn(600);
		})
	})
	
	$(function(){ <?php //handling the image on click ?>
		$('.overlay').hide();
		$(document.body).on('click', '.product-order-image', function(){
			var source = $(this).attr('src');
			$('.overlay').fadeIn(550);
			$('.overlay').html("<div class='col-xs-2 col-sm-2 col-md-3 col-lg-3'></div><div class='col-xs-8 col-sm-8 col-md-6 col-lg-6'><div class='panel panel-default panel-body click-image-display'><button class='btn btn-default pull-right' id='close-overlay'><span class='fa fa-times'></span></button><img src='"+source+"' class='center-block click-image'></div></div><div class='col-xs-2 col-sm-2 col-md-3 col-lg-3'>");
		})
		$(document.body).on('click', '#close-overlay', function(){
			$('.overlay').empty();
			$('.overlay').fadeOut(550);
		})
	})

	
	//<li role="presentation"><a role="menuitem" tabindex="-1">Action</a></li>
</script>
