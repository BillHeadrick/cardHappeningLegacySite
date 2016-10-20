<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class='navbar-header'>
			<h1>Cardhappening Admin</h1>
		</div>
		<ul class='nav navbar-nav'>
			<?php
			if(isset($_SESSION['admin_level'])){
				switch ($_SESSION['admin_level']){
					case 1: //all access
						echo "<li><a href='https://www.cardhappening.com/admin/cms.php'>CMS</li>";//cms link
						echo "<li><a href='https://www.cardhappening.com/admin/index.php'>Order Fullfillment</a></li>";//order fullfillment aka the index
						echo "<li><a href='https://www.cardhappening.com/admin/ba.php'>BA</a></li>"; //business analysis
						echo "<li><a href='https://www.cardhappening.com/admin/accounting.php'>Accounting</a></li>"; //accounting
						echo "<li><a href='https://www.cardhappening.com/admin/inventory.php'>Inventory</a></li>"; //inventroy
						echo "<li><a href='https://www.cardhappening.com/admin/adminManagement.php'>Admin Management</a></li>"; //admin management
						echo "<li><a href='https://www.cardhappening.com/admin/logout.php'>Logout</a></li>"; //logout
						break;
					case 2:
						echo "<li><a href='https://www.cardhappening.com/admin/index.php'>Order Fullfillment</a></li>";//order fullfillment aka the index
						echo "<li><a href='https://www.cardhappening.com/admin/inventory.php'>Inventory</a></li>"; //inventory
						echo "<li><a href='https://www.cardhappening.com/admin/logout.php'>Logout</a></li>"; //logout
						break;
					}
			}
			?>
		</ul>
	</div>
</nav>