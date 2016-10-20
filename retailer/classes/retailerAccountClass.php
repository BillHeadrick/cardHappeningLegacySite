<?php

class RetailerAccount
{
	private $retailer_id;
	public $shippingProfile;
	public $paymentProfile;
	public $contact;
	public $cart;
	public $address;
	private $established;
	private $terms;
	
	
	
	//$new is a boolean, true means we need to update the database
	//$rid is the retailers id
	//$rid will be the prototype code if we have a new retailer
	public function __construct($new, $rid, $dbc)
	{
		if($new)	//we are creating a retailer account for the first time based off a template
		{
			$this->established = false;
			$rid = strtolower($rid);
			$q = "SELECT `carriage_paid_level`, `standard_shipping_cost`, `expediated_cost`, `payment_due`, `cost_per_card`, `minimum_order` FROM `retailer_template` WHERE `template_name` = '$rid';";
			$r = mysqli_query($dbc, $q);
			if($r)	//query was successful
			{
				$template = mysqli_fetch_assoc($r);
				$q = "INSERT INTO `retailer`(`established`, `template`) VALUES ('0', '$rid');";
				$r = mysqli_query($dbc, $q);		//generate a new retailer account
				$this->retailer_id = mysqli_insert_id($dbc);	//update the objects retailer id
				
				/*Create a new shipping profile*/
				$this->shippingProfile = new RetailerShippingProfile($this->retailer_id, $dbc);
				if(!($this->shippingProfile->isActive()))		//this retailer id does not have an active shipping profile linked to id, as expected because we are signing them up
				{
					$this->shippingProfile->addShippingProfile($template['carriage_paid_level'], $template['standard_shipping_cost'], $template['expediated_cost'], $dbc);
				}
				
				/*Create a new payment profile*/
				$this->paymentProfile = new RetailerPaymentProfile($this->retailer_id, $dbc);
				if(!($this->paymentProfile->isActive()))	//this retailer id does not have an active payment profile linked to their rid yet, as expected becasue we are signing them up
				{
					$this->paymentProfile->addPaymentProfile($template['payment_due'], $template['cost_per_card'], $template['minimum_order'], $dbc);
				}
				
				/*Create a Contact, should be null right now*/
				$this->contact = new RetailerContact($this->retailer_id, $dbc);
				
				/*Creates an empty cart*/
				$this->cart = new RetailerCart("","");
			}
		}
		else	//we have an already existing retailer account and are fetching their information
		{
			$this->retailer_id = $rid;
			$this->shippingProfile = new RetailerShippingProfile($rid, $dbc);
			$this->paymentProfile = new RetailerPaymentProfile($rid, $dbc);
			$this->contact = new RetailerContact($rid, $dbc);
			$this->cart = new RetailerCart("",""); //creates an empty cart
			$terms = "";	//currently do not have terms set up
			if($this->shippingProfile->isActive() AND $this->paymentProfile->isActive() AND $this->contact->contactExists())
			{
				$this->established = true;
			}
			else {
				$this->established = false;
			}
		}	
	}

	/*Checks whether or not the retailer account has been created from a template and we need more info*/
	public function accountApproved()
	{
		if($this->paymentProfile->isActive() && $this->shippingProfile->isActive() && !$this->established)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//returns the retailer id
	public function getRetailerId()
	{
		return $this->retailer_id;
	}
	
	//returns whether or not the retailer account is established
	//an established retailer has a complete contact, shipping profile, and payment profile
	public function getEstablished()
	{
		return $this->established;
	}
	
	//clears the cart, and the address
	//use this when an order has been completed and stored in the database
	public function clearOrder()
	{
		$this->cart->clear();
		$this->address->clear();
	}
	
	//creates the message of an html confirmation email
	public function createConfirmationEmail()
	{
	$message = "
	<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
		<html xmlns='http://www.w3.org/1999/xhtml'>
			<head>
    	 		<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
        		<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
    			<title>Card Happening Retailer Order #";
	$message = $message . $this->cart->getOrderID();			
	$message =	 $message."Confirmation</title>
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
                                            <p style='text-align:center;'>Thank you for carrying hand-painted greeting cards!</p>
                               				</td>
          								</tr>
                                    	<tr>
                                        	<td style='text-align: center; font-family: Arial, Helvetica, sans-serif; font-size:1em; padding-top:10px;'>
                                            	Order Date: ";
                                            	$today = getdate();
                                            	$date = $today['mday']." ".$today['month']." ".$today['year'];
                                            	$message = $message . $date;
          $message = $message . "
                                     		</td>
                                  		</tr>
                                   		<tr>
                                        	<td>
                                      			<img src='https://www.cardhappening.com/images/pedicab-blue.jpg' alt='Processing your order!' style='display:block; margin-left:auto; margin-right:auto;'></img> 
                                        	</td>
                                    	</tr>
                                    	<tr>
                                        	<td>
                                            	<table border='0' width='100%' cellpadding='0' cellspacing='0'> 
                                  					<tr> 
                                                    	<td width='260' valign='top'>
                                                        	<table cellpadding='0' cellspacing='0' border='1' width='100%'>
                                                            	<tr>
                                                                	<td style='text-align:center; font-family: 'Times New Roman', Times, Serif; font-size:1.5em;' > 
                                                                		<p style='text-align:center;'>Retailer</p>  
                                                                	</td> 
                                                            	</tr>
                                                            <tr>
                                                                <td style='text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:1em; padding-top:10px;'>"; 
                                                               $address = $this->address->getAddress();
                                                               $shipping_method = $this->address->getService();
                                                               if($shipping_method == "standard"){
	                                                               $shipping_method = "Standard";
	                                                               if($this->cart->getTotal() >= $this->shippingProfile->getCarriagePaid())
	                                                               {
	                                                               		$shipping_cost = "Complimentary";
	                                                               }	
																	else
																	{
																		$shipping_cost = $this->shippingProfile->getStandardShipping();
																	}
                                                               }
															   else
															   {
																   if($shipping_method == "expediated")
																   {
																   		$shipping_method = "Expediated";
																		$shipping_cost = $this->shippingProfile->getExpediatedShipping();
																   }	
															   }
                                                               $address = $address . "<br><br>Shipping Method: $shipping_method <br> Shipping Cost: $shipping_cost";
                                      $message = $message . $address;
                                      $message = $message .    "</td> 
                                                            </tr>
                                                        </table>
													</td>
                                                    <td width='20' style='font-size: 0; line-height:0;'>d
                                                        &nbsp;
                                                    </td>
                                                    <td width='260' valign='top'>
                                                        <table cellpadding='0' cellspacing='0' border='1' width='100%'>
                                                            <tr>
                                                                <td style='text-align:center; font-family: 'Times New Roman', Times, Serif; font-size:1.5em;' > 
                                                                <p style='text-align:center;'>Order Summary </p>
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
 								$order = "";
 								for($i = 0; $i < $this->cart->getLength(); $i++)
 								{
 									$order = $order . "                      
 									                                    <tr> 
                                                                            <td style='text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:1em; padding-top:10px;'>";
                                    $order = $order . $this->cart->cart[$i]->getStyle();
                                    $order = $order . "                                         
                                                                            </td>
                                                                            <td style='text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:1em; padding-top:10px;'>";
                                    $order = $order . $this->cart->cart[$i]->getUPC();                              
                                    $order = $order . "                     </td>
                                                                            <td style='text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:1em; padding-top:10px;'>";
									$order = $order . $this->cart->cart[$i]->getQuantity();
									$order = $order . "                                         
                                                                            </td>
                                                                            <td style='text-align:center; font-family: Arial, Helvetica, sans-serif; font-size:1em; padding-top:10px;'>";
                                                                                
                                    $order = $order ."$". $this->cart->cart[$i]->getQuantity() * $this->paymentProfile->getCostPerCard();                                          
                                    $order = $order . "                    </td>
																		</tr>";
 								}
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
											$total = $this->cart->getTotal();
											$paid = "";
											if($shipping_cost != "Complimentary")
											{
												$total = $total + $shipping_cost;
											}
											$message = $message."$$total";
											if($this->cart->getPaid())
											{
												$paid = "<br>Paid in full.";
											}
											else
											{
												$paid = "<br>Payment due $this->paymentProfile->getPaymentDue() days after products arrive.";
											}
							$message = $message . $paid;
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
return $message;
	}
	

}

?>