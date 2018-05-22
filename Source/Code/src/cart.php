<!DOCTYPE html>
<html>
<head>
	<title>Cart</title>

</head>

<?php 
include 'utils.php';
if (session_status() == PHP_SESSION_NONE) {

	session_name("OnlineCakeDelivery");
	session_start();
}

class buyCake extends utils{
	private $cId;
	private $uId;
	private $cakeName;
	private $cakeCost;
	private $cakeImage;
	private $quantity;
	private $totalcost;
	public $errorInfo;
// Private $cakeID;
// private $CakeArray[$CakeID]=$quantity;


	public function setQuantity($quantity){
		$this->quantity=$quantity;
	}
	public function getQuantity(){
		return $this->quantity;
	}
	public function setTotalCost($totalcost){
		$this->totalcost=$totalcost;
	}
	public function getTotalCost(){
		return $this->totalcost;
	}
	public function setCId($cId){
		$this->cId = $cId;
	}
	public function getCId(){
		return $this->cId;
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
	function displayCakeDetails(){
	//Check if cakeId is set or not
		if(empty($cakeId)){
			$this->getCakeIDFromUserID($this->getuid(),true);
		}else{
			$this->getCakeDetails($this->getCId());

		}
	}
// 	public function addtocart($cId){
// 		$uid=(int)$this->getuid();
// 		$con = $this->connectToDatabase();
// 		$sqlSt = "SELECT `cartid`, `userid`, `cakeid`, `quantity`,`totalprice` FROM `cart` WHERE `cakeid`=?";
// 							//cursor variable for selecting the rows in the database.
// 		if($sql =$con->prepare($sqlSt)){
// 									// Bind the appropriate values that have to be inserted into db
// 		$sql->bind_param('i', $cId);										//check if it executes
// 		$sql->execute();

// 		$sql->bind_result($cartid, $userid, $cakeid, $quantity, $totalprice);
// 		if($sql->fetch()){
// 			echo "<h2 style=\"text-align:center;\">Cake is alredy present </h2>";
// 		}else{				
// 			$sqlst="INSERT INTO `cart`(`userid`,`cakeid`) VALUES (?,?)";
// 			$sql=$con->prepare($sqlst);
// 			$sql->bind_param('ii',$uid,$cId);
// 			$sql->execute();
// 		}
// 	}
// }

	public function getCakeIDFromUserID($UserID){

		$con = $this->connectToDatabase();
		$sqlst="SELECT `cakeid`, `quantity`, `totalprice` FROM `cart` WHERE `userid`=?";
		if($sql =$con->prepare($sqlst)){
		// Bind the appropriate values that have to be inserted into db
			$sql->bind_param('i', $UserID);
			$sql->execute();
			$sql->bind_result( $cakeId, $quantity, $totalcost);
			while ($sql->fetch()) {
				
				$this->setCId($cakeId);
				$this->setQuantity($quantity);
				$this->setTotalCost($totalcost);
				
				$this->getCakeDetails($this->getCId());
				
			}
			if($this->getCId()==NULL){
				$this->errorInfo="No Cakes added to cart";
			}
		}else{
			$this->errorInfo="No Cakes added to Cart";
		}
	}

	public function getCakeDetails($cakeId){
		$uid=$this->getuid();
		$con = $this->connectToDatabase();
                    		 // declaring a variable for select query.
		$sqlSt = "SELECT `cake_name`, `cost_item`, `cake_image_path` FROM `cake_details` WHERE `cakeid`=?";
							//cursor variable for selecting the rows in the database.
		if($sql =$con->prepare($sqlSt)){
									// Bind the appropriate values that have to be inserted into db
			$sql->bind_param('i', $cakeId);
									//check if it executes
			$sql->execute();

			$sql->bind_result( $cakeName, $cakeCost, $cakeImage);	
			while ($sql->fetch()) {
				$this->cakeImage=$cakeImage;
				$this->cakeName=$cakeName;
				$this->cakeCost=$cakeCost;
				$printdetails=$this->getechodata();
				echo $printdetails;
			}

		}else{
			$this->errorInfo="Something went wrong working on it" ;
		}
	}

// function removeItem($cake){
// 	echo "<h2> Cake removed from cart </h2>";
// 	//echo $cake;
// 	$con = $this->connectToDatabase();

// 	$sqlSt = "DELETE FROM `cart` WHERE `cakeid`=?";
// 	if($sql =$con->prepare($sqlSt)){
// 									// Bind the appropriate values that have to be inserted into db
// 		$sql->bind_param('i', $cake);
// 									//check if it executes
// 		$sql->execute();
// 	}
// }

	function getechodata(){
		$userid=$this->getuid();
		return "
		<div class=\"tab-content\">
		<div class=\"tab-pane fade in active\">
		<ul class=\"aa-product-catg\">
		<li id=\"content\" >
		<figure>
		<img src =\"img/cakes/$this->cakeImage\" alt = \"$this->cakeName\" width= \"230px\" height= \"300px\" />
		</figure>
		</li>
		<ul><li style=\" margin-bottom:50px\">
		<figcaption>
		<h4 class=\"aa-product-title\">
		<p>Name: $this->cakeName</p>
		</h4>
		<h4>Quantity:  
		<select id =\"quantity\" onChange=\"onQuantityChange($this->cakeCost,this, $this->cId,$userid)\">
		<option value=\"1\">1</option>
		<option value=\"2\">2</option>
		<option value=\"3\">3</option>
		<option value=\"4\">4</option>
		<option value=\"5\">5</option>
		<option value=\"6\">6</option>
		</select></h4>
		<h4> Cake's Price:
		<span id=\"cakePrice\" style=\"color:#ff6666\">$ $this->cakeCost</span>
		</h4>
		</figcaption>
		<input type=\"button\" onClick=\"rmve($this->cId,$userid)\" class=\"aa-shop-now-btn aa-secondary-btn\" value=\"Remove Item\"/>
		</li>	
		</ul> 
		</ul>
		</div>		
		</div>	
		";
	}

// function getCakeIDFromUser($userid){
// 	$con = $this->connectToDatabase();
// 	$sqlst="SELECT `cakeid` FROM `cart` WHERE `userid`=?";
// 	if($sql =$con->prepare($sqlst)){
// 		// Bind the appropriate values that have to be inserted into db
// 		$sql->bind_param('i', $userid);
// 		$sql->execute();
// 		$sql->bind_result($cakeId);
// 		while ($sql->fetch()) {
// 			$this->setCId($cakeId);
// 			$this->updatecart($_POST[strval($cakeId)],$this->getCId());
// 		}
	
// 	}
// }
// function getCakeCost($cakeid){
// 	$con = $this->connectToDatabase();
//                     		 // declaring a variable for select query.
// 	$sqlSt = "SELECT `cost_item` FROM `cake_details` WHERE `cakeid`=?";
// 							//cursor variable for selecting the rows in the database.
// 	if($sql =$con->prepare($sqlSt)){
// 									// Bind the appropriate values that have to be inserted into db
// 		$sql->bind_param('i', $cakeid);
// 									//check if it executes
// 		$sql->execute();

// 		$sql->bind_result( $cakeCost);	
// 		if($sql->fetch()) {
// 			return $cakeCost;
// 		}else{
// 			echo "<p> Error occured, Admin Looking into this.</br>Please Re-submit the order after sometime </p>";
// 		}
// 	}
// }

}

$cakeobj=new utils();
$cakeobj->includeHeader();
$buyCakeobj=new buyCake();

if(!isset($_SESSION["userEmail"])){
	header("Location:logout.php");
}elseif(!isset($_SESSION["userType"])){
	header("Location:logout.php");
}elseif($_SESSION["userType"]!='customer'){ 
	header("Location:logout.php");
}
?>
<script type="text/javascript">
	function checkout(){
		window.location.href="checkout.php";

	}
	function onQuantityChange(selectedvalue,ev,cakeID,userId){
        //Selected value
        var selval=$(ev).val();
        var totalcost =selectedvalue*selval;
        $(ev).parent().next().children('span').text("$"+totalcost);
        $.ajax({
        	url: './updatecart.php',
        	type: 'post',
        	data: {'quantity':selval, 'totalCost':totalcost, 'cakeID': cakeID, 'userId': userId},
        	success: function(data, status) {
        		   	},
        	error: function(){
        	}
        });
        
    }
    function rmve(cakeID,userId){
    	$.ajax({
    		url: './removeItem.php',
    		type: 'post',
    		data: {'cakeID': cakeID, 'userId': userId},
    		success: function(data, status) {
    			if(data=="Success"){
    				alert("Succesfully Item Removed");
    				document.location.reload();
    			}
    		},
    		error: function(){
    			alert("Error in Removing item");
    		}
    	});
    }
</script>
<!-- SCROLL TOP BUTTON -->
<a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
<div class="cart" style="text-align: center; "><h2>Cart</h2></div>
<!-- start single product item -->
<div style="height:500px">
	<?php $buyCakeobj->displayCakeDetails();
	if($buyCakeobj->errorInfo !==""){

		echo "<h2 style=\"text-align:center;\">".$buyCakeobj->errorInfo."</h2>";

	}
	if($buyCakeobj->errorInfo !=="No Cakes added to cart"){
		echo "<input type=\"submit\" onClick=\"checkout();\" style=\"position:absolute; right:0; bottom:0;\" id=\"checkout_button\" class=\"aa-shop-now-btn aa-secondary-btn\" value=\"Proceed To Checkout\"/>";
	}
	?>
	

</div>
<!-- 
</form>
</ul> 
</ul>
</div>		
</div> -->
<!-- footer -->
<!-- echo "<input type="button" onClick="checkout($uid)" style="position:absolute; right:0; bottom:0;" class="aa-shop-now-btn aa-secondary-btn" value="Proceed To Checkout"/>" -->

<?php $cakeobj->includeFooter(); ?>


</html>