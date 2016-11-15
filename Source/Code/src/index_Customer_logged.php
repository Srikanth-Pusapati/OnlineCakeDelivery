<!DOCTYPE html>
<html>
	<head>
	</head>
	<body>
		<!-- wpf loader Two -->
		<div id="wpf-loader-two">
			<div class="wpf-loader-two-inner">
				<span>Loading</span>
			</div>
		</div>
		<!-- / wpf loader Two -->
		<!-- SCROLL TOP BUTTON -->
		<a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
		<!-- END SCROLL TOP BUTTON -->


		<!-- Include Header-->
		<?php include'header.php' ?>
		<?php 
function connectToDatabase(){
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "onlinecakedelivery";

// Create connection
$con = mysqli_connect( $servername, $db_username, $db_password, $dbname );
// Check connection
if ($con->connect_error) {
	die ( "Connection failed: " . $con->connect_error );
}	

return $con;
}
?>
		<!-- / menu -->
		<!-- Start slider -->
		<section id="aa-slider" style="padding: 20px; margin-bottom:30px;" >
			<div class="aa-slider-area">
				<div id="sequence" class="seq" >
					<ul class="seq-canvas">
						<!-- single slide item -->
						<li>
							<div class="seq-model" >

								<img data-seq src="img/slider1/2.png" alt="slide1 img" />
							</div>
							<div class="seq-title">
								<span data-seq>Save Up to 25% Off</span>
								<h2 data-seq>Birth Day Cakes</h2>

								<a data-seq href="#" class="aa-shop-now-btn aa-secondary-btn">SHOP
									NOW</a>
							</div>
						</li>
						<!-- single slide item -->
						<li>
							<div class="seq-model">
								<img data-seq src="img/slider1/1.png" alt=" slide2 img" />
							</div>
							<div class="seq-title">
								<span data-seq>Save Up to 40% Off</span>
								<h2 data-seq>Wedding Cakes</h2>

								<a data-seq href="#" class="aa-shop-now-btn aa-secondary-btn">SHOP
									NOW</a>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</section>                
		<!-- Tab panes -->
		<div class="tab-content">
			<div class="tab-pane fade in active">
				<ul class="aa-product-catg">
					<!-- start single product item -->

					<?php 
						$con = connectToDatabase();
						$sql = " SELECT `cakeid`, `cake_name`, `cake_details`, `cake_ingredients`,
						`cost_item`, `cake_image_path` FROM `cake_details`";	
						$result = $con->query( $sql);
						if ($result->num_rows > 0) 
						{
							while($row = $result->fetch_assoc())
							{
								$cakeId = $row["cakeid"];
								$cakeName = $row["cake_name"];
								$cakeDetails = $row["cake_details"];
								$cakeIngredients = $row["cake_ingrediants"];
								$cakeCost = $row["cost_item"];
								$cakeImage = $row["cake_image_path"];
						?>
					<li>
						<figure>
							<a class="aa-product-img" name="cakeSelected" href="checkout.php">
								<input type="hidden" name="cakeId" value="<?php echo $cakeId; ?>" />
										<img src ="img/cakes/<?php echo $cakeImage; ?>" alt = "<?php echo $cakeName; ?>" width= "230px" height= "300px" />
												<!-- TODO Retrive image from database <img src="img/cakes/2.jpg" alt="cartoon cake img">-->

											</a>
											<a class="aa-add-card-btn" name="cakeSelected" href="checkout.php"><span
														class="fa fa-shopping-cart">
													<input type="hidden" name="cakeId" value="<?php echo $cakeId; ?>" />
														</span>Order</a>
													<figcaption>
														<h4 class="aa-product-title">
															<p><?php echo $cakeName ?></p>
														</h4>
														<span class="aa-product-price"> $ <?php echo $cakeCost; ?></span>
													</figcaption>
												</figure> <!-- product badge  <span class="aa-badge aa-sale"><a
						href="#">SALE!</a></span>-->
											</li>
											<?php } 
						}
						?>
										</ul>
									</div>
								</div>
								<!-- footer -->
								<?php include'footer.php'?>
							</div>
						</div>	
					</body>
				</html>