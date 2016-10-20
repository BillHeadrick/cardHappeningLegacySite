<?php

include('../../../../exterior/cardhappeningConnection.php');
include('../../function/nameMonth.php');
if(isset($_POST['employee']) && isset($_POST['id']))
{
	$tracking = strip_tags($_POST['tracking']);
	$id = strip_tags($_POST['id']);
	$employee = strip_tags($_POST['employee']);
	$q = "SELECT `retailer_item_status` FROM `retailer_item` WHERE `retailer_order_id` = '$id';";
	$r = mysqli_query($dbc, $q);
	if($r)
	{
		$done = true;
		while($result = mysqli_fetch_assoc($r))
		{	//check to make sure everything has been packed
			if($result['retailer_item_status'] == 0)
			{
				$done = false;
			}
		}
		if($done)
		{
			$q = "UPDATE `retailer_order` SET `status`='1', `tracking_number`='$tracking',`admin_id`='$employee' WHERE `retailer_order_id` = '$id';";
			echo $q;
			$r = mysqli_query($dbc, $q);
			if($r)
			{
				emailReceipt($id, $dbc);
			}
			if(!$r)
			{	//if for some reason the query did not complete successfully
				$done = false;
			}
		}
		if($done)
		{
			echo "trueasdasdasd".$id;	
		}
		else
		{
			echo "falseasdasdasd".$id;
		}
	}
}

function emailReceipt($id, $dbc)
{	//emails a retailer receipt confirming that the order has shipped
	echo"We are in the email receipt function";
	$q = "SELECT retailer_order.retailer_order_id, retailer_order.date, retailer_order.total, retailer_order.shipping_method, retailer_order.order_cost, retailer_order.shipping_cost, retailer_order.tracking_number, retailer_order.purchase_order, retailer_address.company, retailer_address.attention, retailer_address.address_1, retailer_address.address_2, retailer_address.city, retailer_address.state, retailer_address.postal_code, retailer_address.country, retailer_contact.email, retailer_item.retailer_item_id, retailer_item.quantity, retailer_item.price, style.style, style.upc 
FROM retailer_order, retailer_address, retailer_item, retailer_contact, style
WHERE retailer_order.retailer_address_id = retailer_address.retailer_address_id AND retailer_contact.retailer_id = retailer_order.retailer_id AND retailer_order.retailer_order_id = retailer_item.retailer_order_id AND retailer_item.style_id = style.style_id AND retailer_order.retailer_order_id = '".$id."';";
	//echo "the query is ".$q;
	//echo "the shipping cost is ".$result['shipping_cost'];
	$r = mysqli_query($dbc, $q);
	if($r)
	{

		$result = mysqli_fetch_assoc($r);
		print_r($result);
		//echo "The address is ".$result['address1'];
		//format the address
		$address = "";
		$address = $address."<p style='text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:1em;'>".$result['company']."<br>";
		if($result['attention'] != "")
		{
			$address = $address . "Attn: ".$result['attention']."<br>";
		}
		$address = $address . $result['address_1']."<br>";
		if($result['address_2'] != "")
		{
			$address = $address . $result['address_2']."<br>";
		}
		$address = $address . $result['city'].", ";
		if($result['country'] == "US")
		{
			$address = $address . $result['state'] . " ";
		}
		$address = $address.$result['postal_code']."<br>";
		$address = $address.$result['country']."</p>";
		
		$shipment = "                                            	<table border='0' width='100%' cellpadding='0' cellspacing='0'> 
                                  					<tr> 
                                                    	<td width='260' valign='top'>
                                                        	<table cellpadding='0' cellspacing='0' border='1' width='100%'>
                                                            	<tr>
                                                                	<td style='text-align:center; font-family: 'Times New Roman', Times, Serif; font-size:1.5em;' > 
                                                                		<p style='text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:1em;'>Shipping</p>  
                                                                	</td> 
                                                            	</tr>
                                                            <tr>
                                                                <td style='text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:1em; padding-top:10px;'>"; 
                                                               $shipping_method = $result['shipping_method'];
                                                               $shipping_cost = "$".$result['shipping_cost'];
                                                              	//not sure why this part is not working
                                                              	if($shipping_method == "standard"){
	                                                               $shipping_method = "Standard";
	                                                               if($shipping_cost == 0){
	                                                               		$shipping_cost = "Complimentary";
	                                                               }	
																	else {
																		$shipping_cost = "$".$shipping_cost;
																	}
                                                               }
															   else
															   {
																   if($shipping_method == "expediated"){
																   		$shipping_method = "Expediated";
																		$shipping_cost = "$".$shipping_cost;
																   }	
															   }
                                                               $shipment = $shipment . $address . "<br><br>Shipping Method: $shipping_method <br> Shipping Cost: ".$shipping_cost;
															   if($result['tracking_number'] != "")
															   {
															   		$shipment = $shipment . "<br>Shipment USPS tracking number is ".$result['tracking_number'].".";
															   }
                                  $shipment = $shipment .   "</td> 
                                                            </tr>
                                                        </table>";
			$title = "";
			if($result['purchase_order'] != "")
			{
				$title = $title . "Purchase Order: ".$result['purchase_order']." has shipped";
			}
			else
			{
				$title = $title . "Card Happening Retailer Order #".$id." has shipped";
			}
		
			$dateplaced = "";
			$timestamp = $result['date'];
			$timestamp = explode(" ", $timestamp);
			$timestamp = explode("-", $timestamp[0]);
			$dateplaced = $timestamp[2]." ".nameMonth($timestamp['1'])." ".$timestamp[0];
			
			$order = "";
			$order = $order . "                      
				                                    <tr> 
                                                        <td style='text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:1em; padding-top:10px;'>";
                $order = $order . $result['style'];
                $order = $order . "                                         
                                                        </td>
                                                        <td style='text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:1em; padding-top:10px;'>";
                $order = $order . $result['upc'];                              
                $order = $order . "                     </td>
                                                        <td style='text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:1em; padding-top:10px;'>";
				$order = $order . $result['quantity'];
				$order = $order . "                                         
                                                        </td>
                                                        <td style='text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:1em; padding-top:10px;'>";
                                                            
                $order = $order ."$". $result['price'];                                          
                $order = $order . "                    </td>
													</tr>";
				$to = $result['email'];
				$total = "$".$result['total'];
			if($result['purchase_order'] != "")
			{
				$subject = $result['purchase_order']." Card Happening Retailer Order Shipment";
			}
			else 
			{
				$subject = "Card Happening Retailer Order #".$result['retailer_order_id']." Shipment";
			}
			while($result = mysqli_fetch_assoc($r))
			{
			$order = $order . "                      
				                                    <tr> 
                                                        <td style='text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:1em; padding-top:10px;'>";
                $order = $order . $result['style'];
                $order = $order . "                                         
                                                        </td>
                                                        <td style='text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:1em; padding-top:10px;'>";
                $order = $order . $result['upc'];                              
                $order = $order . "                     </td>
                                                        <td style='text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:1em; padding-top:10px;'>";
				$order = $order . $result['quantity'];
				$order = $order . "                                         
                                                        </td>
                                                        <td style='text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:1em; padding-top:10px;'>";
                                                            
                $order = $order ."$". $result['price'];                                          
                $order = $order . "                    </td>
													</tr>";
			}
	$message = "
	<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
		<html xmlns='http://www.w3.org/1999/xhtml'>
			<head>
    	 		<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
        		<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
    			<title>";
	$message = $message . $title;			
	$message =	 $message."</title>
			</head>
			<body style='margin: 0; padding: 0;'>
  			<table border='0' cellpadding='0' cellspacing='0' width='100%'>
            	<tr>
                	<td bgcolor='#E6EAFA'>
           				<table align='center' border='0' cellpadding='0' cellspacing='0' width='600' style='border-collapse: collapse;' bgcolor='#E6EAFA'>
                        	<tr>
                            	<td>
                                 	<img style='max-height:120px; display:block; margin-left:auto; margin-right:auto;' class='logo' src='https://www.cardhappening.com/images/logo.jpg' alt='Card Happening'></img>
                             	</td>
                         	</tr>
                         	<tr>
                             	<td bgcolor='#E6EAFA'>
                                	<table border='0' cellpadding='0' cellspacing='0' width='100%'>
                                    	<tr>
                                        	<td style='text-align: center; font-family: 'Times New Roman', Times, Serif; font-size:2em; padding-top:20px; padding-bottom:10px;'>
                                            <p style='text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:2em;'><b>Your order has shipped!</b></p>
                               				</td>
          								</tr>
                                    	<tr>
                                        	<td style='text-align: center; font-family: Arial, Helvetica, sans-serif; font-size:1em; padding-top:10px;'>
                                            	Shipment Date: ";
                                            	$today = getdate();
                                            	$date = $today['mday']." ".$today['month']." ".$today['year'];
                                            	$message = $message . $date;
          $message = $message . "
                                     		</td>
                                  		</tr>
                                   		<tr>
                                        	<td>
                                      			<img src='https://www.cardhappening.com/images/pedicab-blue.jpg' alt='Your order has shipped!' style='display:block; margin-left:auto; margin-right:auto;'></img> 
                                        	</td>
                                    	</tr>
                                    	<tr>
                                        	<td>
											";//here we add the shipment/address info
											$message = $message . $shipment;
											$message = $message ."
													</td>
                                                    <td width='20' style='font-size: 0; line-height:0;'>d
                                                        &nbsp;
                                                    </td>
                                                    <td width='260' valign='top'>
                                                        <table cellpadding='0' cellspacing='0' border='1' width='100%'>
                                                            <tr>
                                                                <td style='text-align:center; font-family: 'Times New Roman', Times, Serif; font-size:1.5em;' > 
                                                                <p style='text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:1em;'>Order Summary </p>
                                                                </td> 
                                                            </tr>
                                                            <tr>
                                                                <td style='padding-top:10px;'> 
                                                                    <table border='1' width='100%' cellpadding='0' cellspacing='0'>
                                                                        <tr>
                                                                            <th style='text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:1em; padding-top:10px;'>
                                                                                Style
                                                                            </th>
                                                                            <th style='text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:1em; padding-top:10px;'>
                                                                                UPC
                                                                            </th>
                                                                            <th style='text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:1em; padding-top:10px;'>
                                                                                Quantity
                                                                            </th>
                                                                            <th style='text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:1em; padding-top:10px;'>
                                                                                Price
                                                                            </th>
																		</tr>";

 							  $message = $message . $order;
                              $message = $message ."                    <!--order information goes here-->
          															</table>
                                                                </td> 
                                                            </tr>
                                                        </table>
                                                        
                                                    </td>
          										</tr>
											</table>
          								</td>
                                  	</tr>
                                    <tr>
                                        <td style='text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:1em; padding-top:10px;'>
											Order Total: ";
											$message = $message .$total;
							//currently taking all payments upfront
							//$message = $message . $paid;
							$message = $message . "<br>
          								</td>
          							</tr>
          						</table>
                             </td>
                         </tr>
                         <tr>
                             <td style='padding-top:20px; text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:1em; padding-top:10px'>
                                 Please email all concerns to william@cardhappening.com <br></br>
                                 Card Happening LLC <br>
                                 P.O. Box 300326<br>
         						 Austin, TX 78703<br>
                                 <br><b> Find more fine hand-painted cards at www.cardhappening.com </b><br> 
                                
                             </td>
                         </tr>
                	</table>
          		</td>
            </tr>    
  		</table>
	</body>
</html>";
			echo $message;
			$message = wordwrap($message, 70, "\r\n");			
			$header = "From:cardhappening@cardhappening.com \r\n";
			$header = $header . "Bcc: receipts@cardhappening.com \r\n";
			$header = $header . "Reply-To: william@cardhappening.com \r\n";
			$header = $header . "MIME-Version: 1.0 \r\n";
			$header = $header . "Content-type:text/html; charset=UTF-8 \r\n";
			$i = mail($to, $subject, $message, $header);
			if($i)
			{
				echo "It worked";
			}
			else{
				echo "it failed";
			}
	}		
}

?>