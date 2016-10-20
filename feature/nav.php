<?php

function displayNav($page)
{
	echo '
		<ul class="nav nav-tabs nav-justified">
			<li role="presentation"'; if($page == "home"){echo 'class="active"';}; echo'><a href="https://www.cardhappening.com">Home</a></li>
			<li role="presentation"'; if($page == "shop"){echo 'class="active"';}; echo'><a href="https://www.cardhappening.com/shop.php">Shop Cards</a></li>
			<li role="presentation"'; if($page == "about"){echo 'class="active"';}; echo'><a href="https://www.cardhappening.com/aboutUs.php">About Us</a></li>
			<li role="presentation"'; if($page == "process"){echo 'class="active"';}; echo'><a href="https://www.cardhappening.com/process.php">Artistic Process</a></li>
			<li role="presentation"'; if($page == "retailer"){echo 'class="active"';}; echo'><a href="https://www.cardhappening.com/retailer">Retailers</a></li>
		</ul>
';
}
?>