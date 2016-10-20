<?php

class RetailerPaymentProfile
{
	private $costPerCard;		//in dollars
	private $minimumOrder;		//in dollars
	private $paymentDue;		//in days from items recieved
	private $retailerId;
	
	public function __construct($rid, $dbc)
	{
		$q = "SELECT * FROM `retailer_payment_profile` WHERE `retailer_id` = '$rid'";
		$r = mysqli_query($dbc, $q);
		if($r)
		{
			if(mysqli_num_rows($r) == 0) //there is currently no current payment profile
			{
				$this->costPerCard = "";
				$this->minimumOrder = "";
				$this->paymentDue = "";
				$this->retailerId = "$rid";
			}
			else //there is currently a paymeny profile on record
			{
				$r = mysqli_fetch_assoc($r);
				$this->costPerCard = $r['cost_per_card'];
				$this->minimumOrder = $r['minimum_order'];
				$this->paymentDue = $r['payment_due'];
				$this->retailerId = "$rid";
			}
		}
	}
	
	//returns the cost of a single card in U.S. dollars
	public function getCostPerCard()
	{
		return $this->costPerCard;
	}
	
	//returns the minimum order ammount in U.S. dollars
	public function getMinimumOrder()
	{
		return $this->minimumOrder;
	}
	
	//returns the amount of days after and order is recieved that payment is due
	public function getPaymentDue()
	{
		return $this->paymentDue;
	}
	
	//returns whether or not we have any payment information stored on the customer
	public function isActive()
	{
		if($this->costPerCard == "" && $this->paymentDue == "" && $this->minimumOrder == "")
		{
			return false;
		}
		else 
		{
			return true;
		}
	}
	
	//create a new payment profile from a template
	public function addPaymentProfile($due, $cpc, $min, $dbc)
	{
		$q = "INSERT INTO `retailer_payment_profile`(`retailer_id`, `payment_due`, `cost_per_card`, `minimum_order`) VALUES ('$this->retailerId', '$due', '$cpc', '$min')";
		$r = mysqli_query($dbc, $q);
		if($r)
		{
			$this->costPerCard = $cpc;
			$this->minimumOrder = $min;
			$this->paymentDue = $due;
		}
	}
	
}

?>