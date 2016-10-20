<?php //outputs the pagination for the chekout process
function checkoutPagination(){
	if(!isset($_SESSION['checkout']) || $_SESSION['checkout'] > 3 || $_SESSION['checkout'] < 0){
		return;
	} 
	else{
		echo "<ul class='nav nav-tabs nav-justified'>
				<li ";
				if($_SESSION['checkout'] == 0){
					echo "class='active'";
				}
		echo	"><a><span class='badge'>1</span> Confirm <span class='pull-right'><i class='fa fa-angle-double-right'></i></span></a></li>
				<li ";
				if($_SESSION['checkout'] == 1){
					echo "class='active'";
				}
		echo	"	><a><span class='badge'>2</span> Shipping <span class='pull-right'><i class='fa fa-angle-double-right'></i></span></a></li>
				<li ";
				if($_SESSION['checkout'] == 2){
					echo "class='active'";
				}
		echo 	"><a><span class='badge'>3</span> Payment <span class='pull-right'><i class='fa fa-angle-double-right'></i></span></a></li>
				<li ";
				if($_SESSION['checkout'] == 3){
					echo "class='active'";
				}
		echo 	"><a><span class='badge'>4</span> Complete!</a></li>
				</ul>";
	}
	
}
?>

