<?php
class RetailerCart
{
	public $cart = array(); //an array of items, there can only be one item with a same upc per cart
	private $length; //how many items are in the array
	private $total;
	private $paid;
	private $orderID;
	private $purchaseOrder; //optional given by the retailer to specify the purchase order
	public function __construct($order_id, $dbc)
	{
		if($order_id == "")
		{
		$this->cart = array();
		$this->length = 0;
		$this->total = 0;
		}
		else 
		{
			$this->cart = array();
			$this->length = 0;
			$this->total = 0;
			$q = "SELECT * FROM `retailer_item` WHERE `retailer_order_id` = '$order_id'";
			$r = mysqli_query($dbc, $q);
			if($r)
			{
				while($result = mysqli_fetch_assoc($r))
				{
					$this->add($result['style_id'], $result['quantity'], $dbc);
				}
			}
			
		}
	}
	
	//build an already existing cart
	public function build($order_id, $dbc)
	{
		if($order_id == "")
		{
		$this->cart = array();
		$this->length = 0;
		$this->total = 0;
		}
		else 
		{
			$this->cart = array();
			$this->length = 0;
			$this->total = 0;
			$q = "SELECT * FROM `retailer_item` WHERE `retailer_order_id` = '$order_id'";
			$r = mysqli_query($dbc, $q);
			if($r)
			{
				while($result = mysqli_fetch_assoc($r))
				{
					$this->add($result['style_id'], $result['quantity'], $dbc);
				}
			}
			
		}
	}

	//removes an item if that style is already a part of the cart and then adds another in the originals place or at the end
	//adds an item to the cart
	public function add($style_id, $qty, $dbc)
	{
		$index = $this->search($style_id);	
		$item = new RetailerItem($style_id, $qty, $dbc);
		$this->cart[$index] = &$item;
		if($index == $this->length)
		{
			$this->length++;
		}
		$this->calculateTotal();
	}
	
	//returns how many elements are in the cart
	public function getLength()
	{
		return $this->length;
	}
	
	//returns the total amount of the cart in U.S. dollars
	public function getTotal()
	{
		return $this->total;
	}
	
	//resets the cart
	public function clear()
	{
		unset($this->cart);
		$this->length = 0;
		$this->total = 0;
	}
	
	//calculates the total value of the card
	public function calculateTotal()
	{
		$total = 0;
		for($i = 0; $i < $this->length; $i++)
		{
			$total = $total + $this->cart[$i]->getQuantity() * $_SESSION['retailer']->paymentProfile->getCostPerCard();
		}
		$this->total = $total;
	}
	
	//sets the input parameter as the purchase order
	public function setPurchaseOrder($po)
	{
		$this->purchaseOrder = $po;
	}
	
	//returns the purchase order
	public function getPurchaseOrder()
	{
		return $this->purchaseOrder;
	}
	//searches the cart and if it finds the item it returns the index it was at, otherwise it returns length
	//search is designed to only deal with 6 or so styles, so it is not very complex
	//search is O(n)
	public function search($style_id)
	{
		for($i = 0; $i < $this->length; $i++)
		{
			if($this->cart[$i]->getStyleID() == $style_id)
			{//we have found the location of this style id
				return $i;
			}
		}	
		//we have not found the location of this style id
		return $this->length;
	}
	
	//return true if the user has paid and false otherwise
	public function getPaid()
	{
		if($this->paid)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//sets paid to true or to false, depending on what it is passed
	public function setPaid($value)
	{
		if($value == true || $value == false)
		{
			$this->paid = $value;
		}
	}
	
	//sets the order id
	public function setOrderID($orderID)
	{
		$this->orderID = $orderID;
	}
	
	//returns the order id
	public function getOrderID()
	{
		return $this->orderID;
	}
}
?>