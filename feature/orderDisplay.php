
<div class="row" ><div class='col-xs-12 col-sm-12 col-md-12 col-lg-12'><h3 class="labelMe">New Order:</h3></div></div>
			<div class="panel panel-default panel-body order">
				<div class='row'>
					<?php include('productImagesOrder.php'); ?>
				</div>
				
				<div class="row">
					<div class="hidden-xs hidden-sm col-sm-1 col-lg-1"></div><!--styling col-->
					<div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
						
						<h4 class="text-center labelMe">Design</h4>
						<select id="styleSelection" class="form-control">
						</select>
					</div>
					
					<div class="hidden-xs col-sm-1 col-md-1 col-lg-1"></div><!--styling col-->
					<div class="col-xs-4 col-sm-4 col-md-3 col-lg-3">
						
						<h4 class="text-center labelMe">Quantity</h4>
						<input type="number" class="form-control pull-right" placeholder="0" id="quantityInput"  min="0">
						
					</div><!--end of qty col-->
					<div class="hidden-xs col-sm-2 col-md-2 col-lg-2">
						<h4 class="text-center labelMe">Each</h4>
						<h4 class="text-center" id="priceEachHolder">$6.00</h4>
					</div>
					<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
						<h4 class="text-center labelMe">Total</h4>
						<h4 class="text-center" id="priceTotalHolder">$0</h4>
						
					</div><!--end of price col-->
				</div>
				
					<br>
				
				<div class="row">
					<?php//<div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>
						//<?php include('productImagesOrder.php'); //
					//</div><!--end of product images col-->?>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<h4 id="styleNameDescription" class="labelMe">Description:</h4>
						<?php
						$q = "SELECT * FROM `style` WHERE `status` = '1';";
						$r = mysqli_query($dbc, $q);
						while($result = mysqli_fetch_assoc($r)){
							$desc = '<p class="style'.$result[style_id].' product-order-description">';
							$desc = $desc.$result[description];
							$desc = $desc.'</p>';
							echo $desc;
							//echo "<p class='style$result[style_id] product-order-description'>".$result[description]."</p>";
						}
						?>
					</div><!--end of decription col-->
					<div class="hidden-xs col-sm-2 col-md-2 col-lg-2"></div>
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
						<h4 class="labelMe">Prices:</h4>
						<p>
							Cards = $6.00 each <br>
							Flat rate shipping = $3.50 <br>
							Free shipping on orders of $50 or more <br>
						</p>
					</div><!--end of prices column-->
				</div><!--end of prices/description/images row-->
			</div>
				<div class="row">
					<div class="col-xs-3 col-sm-3 col-md-4 col-lg-4"></div><!--styling col-->
					<div class="col-xs-3 col-sm-3 col-md-4 col-lg-4"></div><!--styling col-->
					<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
						<button class="btn btn-default btn-block btn-lg" id="addToCart"><i class="fa fa-shopping-cart"></i><b>  Add to Cart</b></button>		
					</div><!--end of add to cart button col-->
				</div>	
