<?php
$ppc = 6;

$q = "SELECT sale.address_id, sale.total, sale.shipping, address.first, address.last, address.address1, address.address2, address.zipcode, address.city, address.state, address.country, cart.style, cart.quantity, session.email
FROM sale, address, cart, session
WHERE sale.session_id = '$order_id' AND sale.address_id = address.address_id AND cart.session_id = sale.session_id AND session.session_id = sale.session_id;";
$r = mysqli_query($dbc, $q);
$address = "";
$order = "";
if($r){
	$i = 0;
	while($result = mysqli_fetch_assoc($r)){
		if($i == 0){ //get the address once
			$address = "<b>$result[first] $result[last]</b><br></br>$result[address1] $result[address2] <br></br> $result[city] $result[state] $result[zipcode] <br></br> $result[country]";
			$i++;
			$email_total = $result['total'];
			$email_shipping = $result['shipping'];
			$email_email = $result['email'];
			//echo $address;
		} //get the orders in table form
		//print_r($result);
		$price = "$".$result['quantity']*$ppc;
		$order = $order . "<tr><td style='text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:1.25em; padding-top:10px;'>$result[style]</td><td style='text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:1.25em; padding-top:10px;'>$result[quantity]</td><td style='text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:1.25em; padding-top:10px;'>$price</td></tr>";
	}
	//create message
	$message = createConfirmationMessage($order, $address, $email_total, $email_shipping, $order_id, $email_email);
	$message = wordwrap($message, 70, "\r\n");
	$to = $email_email;
	$subject = "Cardhappening order #$order_id confirmation";
	$header = "From:cardhappening@cardhappening.com \r\n";
	$header = $header . "Reply-To: william@cardhappening.com \r\n";
	$header = $header . "MIME-Version: 1.0 \r\n";
	$header = $header . "Content-type:text/html; charset=UTF-8 \r\n";
	$i = mail($to, $subject, $message, $header);
	//echo "<xmp>$message</xmp>";
} else {
}

function createConfirmationMessage($order, $address, $total, $shipping, $order_id, $email){
	//creates the confirmation message for the confirmation email
	$message = "";
/*	echo "<br>the order is $order <br>";
	echo "the address is $address <br>";
	echo "the total is $total <br>";
	echo "the shipping total is $shipping <br>";
	echo "the order id is $order_id <br>";
	echo "the email is $email";*/
	
	if($shipping == 0.00){
		$shipping = "complementary";
	} else {
		$shipping = "$".$shipping;
	}
	
	$message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
	<head>
    	 <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
        <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
    	<title>Cardhappening Order &#35; $order_id</title>
    		</head>
	<body style='margin: 0; padding: 0;'>
  		<table cellpadding='0' cellspacing='0' width='100%'>
            <tr>
                <td>
           			<table align='center' cellpadding='0' cellspacing='0' width='600' style='border-collapse: collapse;'>
                        <tr>
                            <td bgcolor='#E6EAFA'>
                                 <img style='max-height:120px; display:block; margin-left:auto; margin-right:auto;' class='logo' src='https://www.cardhappening.com/images/logoEmail.jpg' alt='Card Happening'></img>
                             </td>
                         </tr>
                         <tr>
                             <td bgcolor='#E6EAFA'>
                                <table cellpadding='0' cellspacing='0' width='100%'>
                                    <tr>
                                        <td style='text-align: center; font-family: ";
   $message = $message . '"Times New Roman"';
   $message = $message . ", Times, Serif; font-size:2em; padding-top:20px; padding-bottom:10px;'>
                                            Thank you for ordering from Cardhappening!
                               			</td>
          							</tr>
                                    <tr>
                                        <td style='text-align: center; font-family: Arial, Helvetica, sans-serif; font-size:1.5em; padding-top:10px;'>
                                            An email will be sent to $email when your order ships.
                                            </td>
                                  	</tr>
                                    <tr>
                                        <td>
                                      	<img src='https://www.cardhappening.com/images/pedicab-blue.jpg' alt='Processing your order!' style='display:block; margin-left:auto; margin-right:auto;'></img> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width='100%' cellpadding='0' cellspacing='0'> 
                                  				<tr> 
                                                    <td width='260' valign='top'>
                                                        <table cellpadding='0' cellspacing='0' width='100%'>
                                                            <tr>
                                                                <td style='text-align:center; font-family: ";
    $message = $message . '"Times New Roman"';
	$message = $message . ", Times, Serif; font-size:1.75em;' > 
                                                                	Shipping    
                                                                </td> 
                                                            </tr>
                                                            <tr>
                                                                <td style='text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:1.25em; padding-top:10px;'>
                                                                $address <br></br> Shipping total: $shipping
                                                                </td> 
                                                            </tr>
                                                        </table>
													</td>
                                                    <td width='20' style='font-size: 0; line-height:0;'>
                                                        &nbsp;
                                                    </td>
                                                    <td width='260' valign='top'>
                                                        <table cellpadding='0' cellspacing='0' width='100%'>
                                                            <tr>
                                                                <td style='text-align:center; font-family: ";
   $message = $message . '"Times New Roman"';
   $message = $message . ", Times, Serif; font-size:1.75em;' > 
                                                                Order Summary    
                                                                </td> 
                                                            </tr>
                                                            <tr>
                                                                <td style='padding-top:10px;'> 
                                                                    <table width='100%' cellpadding='0' cellspacing='0'>
                                                                        <tr>
                                                                            <th style='text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:1.5em; padding-top:10px;'>
                                                                                Style
                                                                            </th>
                                                                            <th style='text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:1.5em; padding-top:10px;'>
                                                                                Quantity
                                                                            </th>
                                                                            <th style='text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:1.5em; padding-top:10px;'>
                                                                                Price
                                                                            </th>
																		</tr>
																		$order
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
                                        <td style='text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:1.75em; padding-top:10px;'>
											<br></br>Order Total: $$total
											</td>
          							</tr>
          						</table>
                             </td>
                         </tr>
                         <tr>
                             <td bgcolor='#E6EAFA' style='padding-top:20px; text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:1em; padding-top:30px'>
                                 Please email all concerns to william@cardhappening.com <br></br> Find more fine hand-painted cards at www.cardhappening.com <br></br> 
                                
                             </td>
                         </tr>
                	</table>
          		</td>
            </tr>    
  		</table>
	</body>
</html>";
return $message;
}

?>