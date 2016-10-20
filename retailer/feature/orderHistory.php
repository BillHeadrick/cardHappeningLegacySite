<?php
//find all non-processed results
//find all processed results
//design decision: just going to load all of there previous orders and not worry about only loading 10 most recent, etc...
include('../function/nameMonth.php');

$q = "SELECT retailer_order.retailer_order_id, retailer_order.retailer_id, retailer_order.date, retailer_order.retailer_address_id, retailer_order.braintree_transaction_id, retailer_order.status, retailer_order.total, retailer_order.shipping_method, retailer_order.shipping_cost, retailer_order.order_cost, retailer_order.tracking_number, retailer_order.purchase_order, retailer_item.style_id, retailer_item.quantity, retailer_item.price, retailer_address.company, retailer_address.retailer_address_id, retailer_address.attention, retailer_address.address_1, retailer_address.address_2, retailer_address.city, retailer_address.state, retailer_address.postal_code, retailer_address.country, style.style, style.upc
FROM retailer_order, retailer_item, retailer_address, style
WHERE retailer_order.retailer_id = '".$_SESSION['retailer']->getRetailerID()."' AND retailer_order.retailer_order_id = retailer_item.retailer_order_id AND retailer_order.retailer_address_id = retailer_address.retailer_address_id AND style.style_id = retailer_item.style_id 
ORDER BY retailer_order.status ASC, retailer_order.date DESC;";
$r = mysqli_query($dbc, $q);
if($r)
{
	if(mysqli_num_rows($r) == 0)
	{
		echo "<p class='text-center statement'>No orders yet.</p>";
	}
	else
	{
	$current = "";	//current holds the most recent current id
	$q = "SELECT `style_id`, `src`,`alt` FROM `product_images` WHERE `status` = 1;";
	$images = mysqli_query($dbc, $q);
	while($result = mysqli_fetch_assoc($r))
	{
		//print_r($result);
		if($current == "")
		{	//handles the first time setting current
			$current = $result['retailer_order_id'];
			echo "
			<div class='panel panel-body'>
				<p class='statement text-center'>";
				if($result['purchase_order'] != "")
				{
					echo "Purchase Order #".$result['purchase_order'];
				}
				else
				{
					echo "Order #".$result['retailer_order_id'];
				}
				echo "
				</p>
				<form name='reorder' action='". htmlentities($_SERVER['PHP_SELF'])."' method='post' id='reorder$current'>
				<input type='hidden' name='reorder' value='$current'>
				<button type='submit' class='btn btn-default pull-right'><p class='statement text-center'>Reorder</p></button>
				</form>
				<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
				<p class='text-center statement'>Shipping Address:</p>";
				$address = "";
				if($result['company'] != "")
				{
					$address = $address . $result['company'] . "<br>";
				}
				if($result['attention'] != "")
				{
					$address = $address . "Attn: ". $result['attention'] . "<br>";
				}
				if($result['address_1'] != "")
				{
					$address = $address . $result['address_1'] . "<br>";
				}
				if($result['address_2'] != "")
				{
					$address = $address . $result['address_2'] . "<br>";
				}
				if($result['city'] != "")
				{
					$address = $address . $result['city'];
				}
				if($result['state'] != "")
				{
					$address = $address .", ". $result['state'];
				}
				if($result['postal_code'] != "")
				{
					$address = $address ." ". $result['postal_code'] . "<br>";
				}
				if($result['country'] != "")
				{
					$address = $address . $result['country'] . "<br>";
				}
				if($result['status'] == 0)
				{
					$order_status = "Your order is waiting to be shipped. <br> You will recieve an email once it does.";
				} else{
					if($result['status'] >= 1)
					{
						if($result['date'] != "")
						{
							$date = explode(" ",$result['date']);
							$date = explode("-", $date[0]);
							$day = $date[2];
							$month = nameMonth($date[1]);
							$year = $date[0];
							$date = $day . " ".$month." ".$year;
							$order_status = "Your order shipped on ".$date;
						}
						else
						{
							$order_status = "Shipped.";	
						}
					}
				}
				$method = $result['shipping_method'];
				if($result['shipping_cost'] == 0)
				{
					$shipping_cost = "Complimentary";
				}
				else
				{
					$shipping_cost = "$".$result['shipping_cost'];
				}
				echo "
				<p class='text-center'>$address</p>
				</div>
				<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
				<p class='text-center'>Order Status: $order_status</p>
				<p class='text-center'>Shipping Method: $method</p>
				<p class='text-center'> Shipping Cost: $shipping_cost</p>
				</div>
				<table class='table'>
					<tr>
						<th class='col-xs-3 col-sm-3 col-md-3 col-lg-3'></th>
						<th class='col-xs-3 col-sm-3 col-md-3 col-lg-3'><p class='statement text-center'>Style</p></th>
						<th class='col-xs-2 col-sm-2 col-md-2 col-lg-2'><p class='statement text-center'>UPC</p></th>
						<th class='col-xs-2 col-sm-2 col-md-2 col-lg-2'><p class='statement text-center'>Quantity</p></th>
						<th class='col-xs-2 col-sm-2 col-md-2 col-lg-2'><p class='statement text-center'>Price</p></th>
					</tr>
					<tr>
						<td>";
				mysqli_data_seek($images, 0);
				for($i = 0; $i< mysqli_num_rows($images); $i++)
				{
					$image_result = mysqli_fetch_assoc($images);
					if($image_result['style_id'] == $result['style_id'])
					{
						echo "<img src='".$image_result['src']."' alt='".$image_result['alt']."' class='product-order-image img-rounded'>";
						break;
					}
				}
			echo         
			"</td>
			<td><p class='statement text-center'>".$result['style']."</p></td>
			<td><p class='statement text-center'>".$result['upc']."</p></td>
			<td><p class='statement text-center'>".$result['quantity']."</p></td>
			<td><p class='statement text-center'>$".$result['price']."</p></td>
			</tr>";	
		}
		else
		{
			if($current == $result['retailer_order_id'])
			{	//we already have a table started so we just need to insert another row
				echo "<tr>
						<td>";
				mysqli_data_seek($images, 0);
				for($i = 0; $i< mysqli_num_rows($images); $i++)
				{
					$image_result = mysqli_fetch_assoc($images);
					if($image_result['style_id'] == $result['style_id'])
					{
						echo "<img src='".$image_result['src']."' alt='".$image_result['alt']."' class='product-order-image img-rounded'>";
						break;
					}
				}
			echo         
			"</td>
			<td><p class='statement text-center'>".$result['style']."</p></td>
			<td><p class='statement text-center'>".$result['upc']."</p></td>
			<td><p class='statement text-center'>".$result['quantity']."</p></td>
			<td><p class='statement text-center'>$".$result['price']."</p></td>
			</tr>";	
			}
			else
			{
				if($current != $result['retailer_order_id'])
				{
					$current = $result['retailer_order_id'];
					echo "</table></div>";//close off old table/panel
								echo "
			<div class='panel panel-body'>
				<p class='statement text-center'>";
				if($result['purchase_order'] != "")
				{
					echo "Purchase Order #".$result['purchase_order'];
				}
				else
				{
					echo "Order #".$result['retailer_order_id'];
				}
				echo "
				</p>
				<form name='reorder' action='". htmlentities($_SERVER['PHP_SELF'])."' method='post' id='reorder$current'>
				<input type='hidden' name='reorder' value='$current'>
				<button type='submit' class='btn btn-default pull-right'><p class='statement text-center'>Reorder</p></button>
				</form>
				<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
				<p class='text-center statement'>Shipping Address:</p>";
				$address = "";
				if($result['company'] != "")
				{
					$address = $address . $result['company'] . "<br>";
				}
				if($result['attention'] != "")
				{
					$address = $address . "Attn: ". $result['attention'] . "<br>";
				}
				if($result['address_1'] != "")
				{
					$address = $address . $result['address_1'] . "<br>";
				}
				if($result['address_2'] != "")
				{
					$address = $address . $result['address_2'] . "<br>";
				}
				if($result['city'] != "")
				{
					$address = $address . $result['city'];
				}
				if($result['state'] != "")
				{
					$address = $address .", ". $result['state'];
				}
				if($result['postal_code'] != "")
				{
					$address = $address ." ". $result['postal_code'] . "<br>";
				}
				if($result['country'] != "")
				{
					$address = $address . $result['country'] . "<br>";
				}
				if($result['status'] == 0)
				{
					$order_status = "Your order is waiting to be shipped. <br> You will recieve an email once it does.";
				} else{
					if($result['status'] >= 1)
					{
						if($result['date'] != "")
						{
							$date = explode(" ",$result['date']);
							$date = explode("-", $date[0]);
							$day = $date[2];
							$month = nameMonth($date[1]);
							$year = $date[0];
							$date = $day . " ".$month." ".$year;
							$order_status = "Your order shipped on ".$date;
						}
						else
						{
							$order_status = "Shipped.";	
						}
					}
				}
				$method = $result['shipping_method'];
				if($result['shipping_cost'] == 0)
				{
					$shipping_cost = "Complimentary";
				}
				else
				{
					$shipping_cost = "$".$result['shipping_cost'];
				}
				echo "
				<p class='text-center'>$address</p>
				</div>
				<div class='col-xs-12 col-sm-6 col-md-6 col-lg-6'>
				<p class='text-center'>Order Status: $order_status</p>
				<p class='text-center'>Shipping Method: $method</p>
				<p class='text-center'> Shipping Cost: $shipping_cost</p>
				</div>
				<table class='table'>
					<tr>
						<th class='col-xs-3 col-sm-3 col-md-3 col-lg-3'></th>
						<th class='col-xs-3 col-sm-3 col-md-3 col-lg-3'><p class='statement text-center'>Style</p></th>
						<th class='col-xs-2 col-sm-2 col-md-2 col-lg-2'><p class='statement text-center'>UPC</p></th>
						<th class='col-xs-2 col-sm-2 col-md-2 col-lg-2'><p class='statement text-center'>Quantity</p></th>
						<th class='col-xs-2 col-sm-2 col-md-2 col-lg-2'><p class='statement text-center'>Price</p></th>
					</tr>
					<tr>
						<td>";
				mysqli_data_seek($images, 0);
				for($i = 0; $i< mysqli_num_rows($images); $i++)
				{
					$image_result = mysqli_fetch_assoc($images);
					if($image_result['style_id'] == $result['style_id'])
					{
						echo "<img src='".$image_result['src']."' alt='".$image_result['alt']."' class='product-order-image img-rounded'>";
						break;
					}
				}
			echo         
			"</td>
			<td><p class='statement text-center'>".$result['style']."</p></td>
			<td><p class='statement text-center'>".$result['upc']."</p></td>
			<td><p class='statement text-center'>".$result['quantity']."</p></td>
			<td><p class='statement text-center'>$".$result['price']."</p></td>
			</tr>";	
				}
			}
		} 
	}
	}
}
?>