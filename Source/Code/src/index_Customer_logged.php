<!DOCTYPE html>
<html>
<head>
	<title>Customer Site</title>
</head>
<?php 
include 'utils.php';
//this class contains all functions for a logged in customer like viewing cakes to purchase
class Customer extends Utils{

	private $cakeId;
	private $cakeName;
	private $cakeDetails;
	private $cakeIngredients;
	private $cakeCost;
	private $cakeImage;


	public function setCakeId($cakeId){
		$this->cakeId = $cakeId;
	}
	public function setCakeName($cakeName){
		$this->cakeName = $cakeName;
	}
	public function setCakeDetails($cakeDetails){
		$this->cakeDetails = $cakeDetails;
	}
	public function setCakeIngredients($cakeIngredients){
		$this->cakeIngredients = $cakeIngredients;
	}
	public function setCakeCost($cakeCost){
		$this->cakeCost = $cakeCost;
	}
	public function setCakeImage($cakeImage){
		$this->cakeImage = $cakeImage;
	}


	public function getCakeId(){
		return $this->cakeId;
	}
	public function getCakeName(){
		return $this->cakeName;
	}
	public function getCakeDetails(){
		return $this->cakeDetails;
	}
	public function getCakeIngredients(){
		return $this->cakeIngredients ;
	}
	public function getCakeCost(){
		return $this->cakeCost;
	}
	public function getCakeImage(){
		return $this->cakeImage;
	}
	// this function is used to rretreive all cakes from database
	function loadCakes(){

		$con = $this->connectToDatabase();
                        		 // declaring a variable for select query.
		$sql = " SELECT `cakeid`, `cake_name`, `cake_details`, `cake_ingredients`,
		`cost_item`, `cake_image_path` FROM `cake_details`";
								//cursor variable for selecting the rows in the database.
		$result = $con->query( $sql);
								// condition for checking whether the cursor variable have more than one row.
		if ($result->num_rows > 0) 
		{
									//retriving rows form the database.
			while($row = $result->fetch_assoc())
			{ 
						   				  //retriving the values for each variable according to the database.
				$this->setCakeId($row["cakeid"]);
				$this->setCakeName($row["cake_name"]);
				$this->setCakeDetails($row["cake_details"]);
				$this->setCakeIngredients($row["cake_ingredients"]);
				$this->setCakeCost($row["cost_item"]);
				$this->setCakeImage($row["cake_image_path"]);

				$contentToPrint=$this->loadContentToPrint();
				echo $contentToPrint;
			} 
		} else{
			echo " <li> No Cakes available. </li>" ;
		}

	}
	//this function is used to display details of each cake like cakedetails, order now button details
	function loadContentToPrint(){
		return "<li id=\"content\">
		<figure>
			<a class=\"aa-product-img\" name=\"cakeSelected\" href=\"checkout.php?cakeId=$this->cakeId\">
				<img src =\"img/cakes/$this->cakeImage\" alt = \"$this->cakeName\" width= \"230px\" height= \"300px\" />

			</a>
			<a class=\"aa-add-card-btn\" name=\"cakeSelected\" href=\"checkout.php?cakeId=$this->cakeId\"><span
				class=\"fa fa-shopping-cart\">
			</span>Order</a>
			<figcaption>
				<h4 class=\"aa-product-title\">
					<p>$this->cakeName</p>
				</h4>
				<span class=\"aa-product-price\">$ $this->cakeCost</span>
			</figcaption>
		</figure> 
	</li>";
}
}

?>
<body>
	<?php 

	$customerObject=new Customer();
	$customerObject->includeHeader();
	?>
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

						$customerObject->loadCakes();

						?>
					</ul>
				</div>
			</div>
			<!-- footer -->
			<?php $customerObject->includeFooter(); ?>
		</div>
	</div>	
</body>
</html>