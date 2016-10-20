<?php

function retailerNav($page){
		echo '
			<ul class="nav nav-tabs nav-justified">
			<li role="presentation"'; if($page == "newOrder"){echo 'class="active"';}; echo'><a href="https://www.cardhappening.com/retailer">New Order</a></li>
			<li role="presentation"'; if($page == "orderHistory"){echo 'class="active"';}; echo'><a href="https://www.cardhappening.com/retailer/orderHistory.php">Order History</a></li>
			<li role="presentation"'; if($page == "accountManagement"){echo 'class="active"';}; echo'><a href="https://www.cardhappening.com/retailer/accountManagement.php">Account Management</a></li>
			<li role="presentation"'; if($page == "support"){echo 'class="active"';}; echo'><a href="https://www.cardhappening.com/retailer/support.php">Support</a></li>
			<li role="presentation"'; if($page == "signOut"){echo 'class="active"';}; echo'><a href="https://www.cardhappening.com/retailer/signOut.php">Sign Out</a></li>
		</ul>';
}

?>