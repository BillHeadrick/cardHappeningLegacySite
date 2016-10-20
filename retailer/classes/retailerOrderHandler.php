<?php
//will handle the states through retailer order
//state 1 is display the form too

if($_SESSION['retailerOrderState'] == null){
	$_SESSION['retailerOrderState'] = 1;	
} 
else if($_SESSION['retailerOrderState'] == 1 && isset($_POST['newOrder']))
{
	//we have an order to process
	$q = "SELECT * FROM `style` WHERE `status` = '1';"; //select all valid styles
	$r = mysqli_query($dbc, $q);
	if($r)
	{	//$r holds multiple rows of valid styles 
		while($result = mysqli_fetch_assoc($r))
		{	//need to check if there was a quantity on all of the columns
			$name = "style".$result['style_id'];
			if(isset($_POST[$name]) && $_POST[$name] > 0)
			{	//the quantity for that style is set
				$current = new RetailerItem($result['style_id'], $_POST[$name], $dbc);
				echo $current.getStyle();
			}
		}
	}
}


?>