<?php
	class RetailerShippingProfile{
		private $carriagePaidLevel;			//orders over this ammount recieve free shipping
		private $standardShippingCost;		//for non express mail
		private $expediatedShippingCost;	//for express mail
		private $retailer_id;				
	
		//grab information from the database
		public function __construct($rid , $dbc){
			$q = "SELECT * FROM `retailer_shipping_profile` WHERE `retailer_id` = '$rid';";
			$r = mysqli_query($dbc, $q);
			if($r)
			{
				if(mysqli_num_rows($r) == 0){//there is currently no shipping profile
					$this->carriagePaidLevel = "";
					$this->standardShippingCost = "";
					$this->expediatedShippingCost = "";
					$this->retailer_id = $rid;
				}
				else{
					$r = mysqli_fetch_assoc($r);
					$this->carriagePaidLevel = $r['carriage_paid_level'];
					$this->standardShippingCost = $r['standard_shipping_cost'];
					$this->expediatedShippingCost = $r['expediated_cost'];
					$this->retailer_id = $rid;
				}
			}	
		}
		
		//returns the amount to be spent to earn free standard shipping
		public function getCarriagePaid(){
			return $this->carriagePaidLevel;
		}
		
		//returns the price of standard shipping
		public function getStandardShipping(){
			return $this->standardShippingCost;
		}
		
		//returns the price of expediated shipping
		public function getExpediatedShipping(){
			return $this->expediatedShippingCost;
		}
		
		//check if the user is active or not
		public function isActive(){
			if($this->carriagePaidLevel == "" && $this->expediatedShippingCost == "" && $this->standardShippingCost == ""){
				return false;
			} else {
				return true;
			}
		}
		
		//add a shipping profile based off of a template
		public function addShippingProfile($carriage_paid, $standard_ship, $expediated_ship, $dbc){
			$q = "INSERT INTO `retailer_shipping_profile`(`retailer_id`, `carriage_paid_level`, `standard_shipping_cost`, `expediated_cost`) VALUES ('$this->retailer_id', '$carriage_paid', '$standard_ship', '$expediated_ship')";
			$r = mysqli_query($dbc, $q);
			if($r)
			{
				$this->carriagePaidLevel = $carriage_paid;
				$this->expediatedShippingCost = $expediated_ship;
				$this->standardShippingCost = $standard_ship;
			}
		}
	}
?>