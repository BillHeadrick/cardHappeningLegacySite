<?php

class RetailerItem
{
	private $upc;
	private $style;
	private $style_id;
	private $quantity;
	
	public function __construct($styleID, $qty, $dbc)
	{
		$styleID = strip_tags($styleID);		//remove tags
		$q = "SELECT * FROM `style` WHERE `style_id` = '$styleID'"; //pull all the information regarding style from query
		$r = mysqli_query($dbc, $q);
		if($r)
		{
			$r = mysqli_fetch_assoc($r);
			$this->style_id = $styleID;
			$this->quantity = $qty;
			$this->upc = $r['upc'];
			$this->style = $r['style'];
		}
	}
	
	//returns the items quantity
	public function getQuantity(){
		return $this->quantity;
	}
	
	//returns the items style
	public function getStyle(){
		return $this->style;
	}
	
	//returns the items style id
	public function getStyleID(){
		return $this->style_id;
	}
	
	//returns the items unique product code
	public function getUPC(){
		return $this->upc;
	}
	
}

?>