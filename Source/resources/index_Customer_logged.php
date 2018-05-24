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
	

		// setting the cakeid
	public function setCakeId($cakeId){
		$this->cakeId = $cakeId;
	}
		// setting the cake name
	public function setCakeName($cakeName){
		$this->cakeName = $cakeName;
	}
	 // settig the cake details
	public function setCakeDetails($cakeDetails){
		$this->cakeDetails = $cakeDetails;
	}
		// setting the cake ingredients
	public function setCakeIngredients($cakeIngredients){
		$this->cakeIngredients = $cakeIngredients;
	}
		// setting the cake cost
	public function setCakeCost($cakeCost){
		$this->cakeCost = $cakeCost;
	}
		// setting the cake image
	public function setCakeImage($cakeImage){
		$this->cakeImage = $cakeImage;
	}

	// retriving the getting cake id
	public function getCakeId(){
		return $this->cakeId;
	}
	// retriving the cake name
	public function getCakeName(){
		return $this->cakeName;
	}
	 // retriving the cake deatils
	public function getCakeDetails(){
		return $this->cakeDetails;
	}
	 // retriving the cake  inngredients
	public function getCakeIngredients(){
		return $this->cakeIngredients ;
	}
		// retriving the cake cost
	public function getCakeCost(){
		return $this->cakeCost;
	}
	 // retriving the  cake image 
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
	function getuid(){
		$headerObj = new Header();
		if (session_status() == PHP_SESSION_NONE) {
			session_name("OnlineCakeDelivery");
			session_start();
		}
		if(!isset($_SESSION["userEmail"])){
			header("Location:logout.php");
		}
		return $_SESSION["userID"];

	}
	//this function is used to display details of each cake like cakedetails, order now button details
	function loadContentToPrint(){
		// $cakeValue=sha1($this->cakeId);
		$userId=$this->getuid();
		$quantity=1;
		return "<li id=\"content\">
		<div onClick=\"addToCart($this->cakeId,$userId,$this->cakeCost)\" >
		<figure>
		<img src =\"img/cakes/$this->cakeImage\" alt = \"$this->cakeName\" width= \"230px\" height= \"300px\" />
		<a class=\"aa-add-card-btn\"  name=\"cakeSelected\" ><span
		class=\"fa fa-shopping-cart\">
		</span>Add to cart</a>
		<figcaption>
		<h4 class=\"aa-product-title\">
		<p>$this->cakeName</p>
		</h4>
		<span class=\"aa-product-price\">$ $this->cakeCost</span>
		</figcaption>
		</div>
		</figure> 
		</li>";
	}
}

?>

<?php 

$customerObject=new Customer();
$customerObject->includeHeader();
?>

<?php 
$headerObj = new Header();
if(!isset($_SESSION["userEmail"])){
	header("Location:logout.php");
}elseif(!isset($_SESSION["userType"])){
	header("Location:logout.php");
}elseif($_SESSION["userType"]!='customer'){ 
	header("Location:logout.php");
}

?>
<script type="text/javascript">
	
	function addToCart(cakeId,userId,cost_item){
		console.log("Onclick called");
		$.ajax({
        		url: './addItemtoCart.php',
        		type: 'post',
        		data: {'cakeID': cakeId, 'userId': userId,'cost_item':cost_item},
        		success: function(data, status) {
        			console.log(data);
        			if(data=="OK"){
        				alert("Cake already Present In Cart");
        				
        			}else if(data=="IN"){
        				alert("Cake Inserted");
        			}
        		},
        		error: function(){
        			alert("Error in Adding Cake");
        		}
        	});
	}
</script>
<a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>


<section id="aa-slider" style="padding: 20px; margin-bottom:30px;" >
	<div class="aa-slider-area">
		<div id="sequence" class="seq" >
			<ul class="seq-canvas">
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

</html>