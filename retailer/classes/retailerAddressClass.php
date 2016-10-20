<?php
class RetailerAddress
{
	private $retailer_id;
	private $address_id;
	private $addressLine1;
	private $addressLine2;
	private $postalCode;
	private $city;
	private $state;
	private $country;
	private $company;
	private $attention;
	private $shippingService; //this is the shipping service of the order ie. standard or expediated
	
	//$new is a boolean, true means we need to update the database
	//$rid is the retailers id
	//$rid will be the prototype code if we have a new retailer
	public function __construct($raid, $dbc)
	{
		$raid = strip_tags($raid);
		$q = "SELECT * FROM `retailer_address` WHERE `retailer_address_id` = '$raid';";
		$r = mysqli_query($dbc, $q);
		if($r && mysqli_num_rows($r) > 0)
		{
			$r = mysqli_fetch_assoc($r);
			$this->retailer_id = $r['retailer_id'];
			$this->address_id = $raid;
			$this->addressLine1 = $r['address_1'];
			$this->addressLine2 = $r['address_2'];
			$this->postalCode = $r['postal_code'];
			$this->city = $r['city'];
			$this->state = $r['state'];
			$this->country = $r['country'];
			$this->company = $r['company'];
			$this->attention = $r['attention'];
		}
	}
	
	public function clear()
	{
		$this->addressLine1 = "";
		$this->addressLine2 = "";
		$this->address_id = "";
		$this->attention = "";
		$this->city = "";
		$this->company = "";
		$this->country = "";
		$this->postalCode = "";
		$this->retailer_id = "";
		$this->shippingService = "";
		$this->state = "";
	}
	
	//returns the retailers ID
	public function getRetailerID()
	{
		return $this->retailer_id;
	}
	
	//returns the address id
	public function getAddressID()
	{
		return $this->address_id;
	}
	
	//returns address line 1
	public function getAddressLine1()
	{
		return $this->addressLine1;
	}
	
	//returns address line 2
	public function getAddressLine2()
	{
		return $this->addressLine2;
	}
	
	//returns postal code
	public function getPostalCode()
	{
		return $this->postalCode;
	}
	
	//returns city
	public function getCity()
	{
		return $this->city;
	}
	
	//returns state
	public function getState()
	{
		return $this->state;
	}
	
	//returns country
	public function getCountry()
	{
		return $this->country;
	}
	
	//returns company
	public function getCompany()
	{
		return $this->company;
	}
	
	//returns attention'
	public function getAttention()
	{
		return $this->attention;
	}
	
	//returns the address in html format
	public function getAddress()
	{
		$address = "<p class='text-center'>".$this->company."<br>";
		if($this->attention != "")
		{
			$address = $address . "Attn: ".$this->attention."<br>";
		}
		$address = $address . $this->addressLine1."<br>";
		if($this->addressLine2 != "")
		{
			$address = $address . $this->addressLine2."<br>";
		}
		$address = $address.$this->city.", ";
		if($this->country == "US")
		{
			$address = $address . $this->state . " ";
		}
		$address = $address.$this->postalCode."<br>";
		$address = $address.$this->country."</p>";
		return $address;
		 
	}
	
	public function addService($service)
	{
		$this->shippingService = $service;
	}
	
	//returns true if the address is complete, does not consider service
	public function isComplete()
	{
		if($this->addressLine1 != "" AND $this->city != "" AND $this->country != "" AND $this->postalCode != "")
		{
			return true;
		}
		else
		{
			return false;	
		}
	}
	
	//returns the service
	public function getService()
	{
		return $this->shippingService;
	}
}
?>