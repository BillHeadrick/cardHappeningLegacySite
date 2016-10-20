			<div class='row'>
				<div class="panel panel-default panel-body" id='style_banner_panel'>
					<?php
					
					$q = "SELECT * FROM `style_banner` WHERE `status` = 1;";
					$r = mysqli_query($dbc, $q);
					if($r){
						while($result = mysqli_fetch_assoc($r)){
							echo "<div class='row'><img class='displayImage style_banner' src='$result[link]' attr='$result[style] style'></div>";
						}
					}
					
					?>
				</div>
			</div>
			
<?php
//removed class='center-block' from image
?>