<?php

echo "
<form name='changeState' action='". htmlentities($_SERVER['PHP_SELF'])."' method='post' id='changeState1'>
<input type='hidden' name='changeState' value='1'>
</form>
<form name='changeState' action='". htmlentities($_SERVER['PHP_SELF'])."' method='post' id='changeState2'>
<input type='hidden' name='changeState' value='2'>
</form>
<form name='changeState' action='". htmlentities($_SERVER['PHP_SELF'])."' method='post' id='changeState3'>
<input type='hidden' name='changeState' value='3'>
</form>
<div class='row'>
<div class='hidden-xs col-sm-2 col-md-2 col-lg-2'></div>
<div class='panel panel-body standard-color col-xs-12 col-sm-8 col-md-8 col-lg-8'>
	<ul class='nav nav-tabs nav-justified'>
		<li role='presentation'";
		if($_SESSION['retailerOrderState'] == 1)
		{
			echo "class='active'";
		}
echo "><a id='checkoutNav1'><span class='badge pull-left'>1</span>Order<span class='pull-right'><i class='fa fa-angle-double-right'></i></span></a></li>
		<li role='presentation'";
		if($_SESSION['retailerOrderState'] == 2)
		{
			echo "class='active'";
		}
echo "><a id='checkoutNav2'><span class='badge pull-left'>2</span>Shipping<span class='pull-right'><i class='fa fa-angle-double-right'></i></span></a></li>
		<li role='presentation'";
		if($_SESSION['retailerOrderState'] == 3)
		{
			echo "class='active'";
		}
echo "><a id='checkoutNav3'><span class='badge pull-left'>3</span>Payment<span class='pull-right'><i class='fa fa-angle-double-right'></i></span></a></li>
	</ul>
</div>
<div class='hidden-xs col-sm-2 col-md-2 col-lg-2'></div></div>";

?>