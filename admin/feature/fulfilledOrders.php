<div class='hidden-xs col-sm-2 col-md-2 col-lg-2'></div>
<div class='col-xs-12 col-sm-8 col-md-8 col-lg-8'>
	<div class='panel panel-default panel-body'>
		<h2 class='text-center'>Fulfilled Orders</h2>
		<?php
		$q = "SELECT sale.session_id, sale.address_id, sale.date, sale.total, sale.shipping, cart.cart_id, cart.style, cart.style_id, cart.quantity, cart.status, address.first, address.last, address.address1, address.address2, address.zipcode, address.city, address.state, address.country, session.email 
FROM `sale`, `cart`, `address`, `session`
WHERE sale.status = 2 AND cart.session_id = sale.session_id AND address.address_id = sale.address_id AND sale.session_id = session.session_id
ORDER BY sale.date DESC
LIMIT 0,20;";
		$r = mysqli_query($dbc, $q);
		if($r){
			while($result = mysqli_fetch_assoc($r)){
				print_r($result);
				echo "<br>";
			}
		}
		?>
	</div>
</div>
<div class='hidden-xs col-sm-2 col-md-2 col-lg-2'></div>