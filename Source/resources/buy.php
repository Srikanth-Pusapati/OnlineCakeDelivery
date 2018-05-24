<!DOCTYPE html>
<html>
<head>
	<title>Confirm Payment</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://www.paypalobjects.com/api/checkout.js"></script>
</head>
<body>

	<?php
// includes the header file
	include "utils.php";
//this class for storing the delivery details
	class customerDeliveryDetails extends Utils
	{	
		private $cakeId;
		private $quantity;
		private $totalCost;
		private $date_Of_Delivery;
		private $time_Of_Delivery;
		private $email_Address;
		private $phone;
		private $city;
		private $state;
		private $country;
		private $address;
		private $zip;

		private $cakeName;
		private $cakeCost;
		private $cakeImage;
		private $errorMessage="";

		function setCakeId($cakeId){
			$this->cakeId=$cakeId;
		}
		function getCakeId(){
			return $this->cakeId;
		}
		function setQuantity($quantity)
		{
			$this->quantity=$quantity;
		}
		function setTotalCost($totalCost){
			$this->totalCost=$totalCost;
		}
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
	 //this function is used to set order details
		function setDetails($OrderDetails){

	//declaring a variable date_Of_Delivery for retrieving the customer cake delivery date.
			$this->date_Of_Delivery = $OrderDetails['Date_Of_Delivery'];
	//declaring a variable time_Of_DeliveryDelivery for retrieving the customer cake delivery time.
			$this->time_Of_Delivery =  $this->test_input($OrderDetails['Time_Of_Delivery']);
	//declaring a variable email_Address for retrieving the customer email.
			$this->email_Address =  $this->test_input($OrderDetails['Email_Address']); 
	//declaring a variable phone for retrieving the customer phone.
			$this->phone =  $this->test_input($OrderDetails['Phone']);
    //declaring a variable address for retrieving the customer address.	
			$this->address =  $this->test_input($OrderDetails['Address']);
    //declaring a variable country for retrieving the customer country.	
			$this->country=  $this->test_input($OrderDetails['country']);
			$this->state=$this->test_input($OrderDetails['state']);
	//declaring a variable city for retrieving the customer city.
			$this->city= $this->test_input($OrderDetails['city']);
	//declaring a variable zip for retrieving the customer zip.
			$this->zip=  $this->test_input($OrderDetails['zip']);
		}
		public function getuid(){
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
		public function getCakeIDFromUserID($UserID){


			$con = $this->connectToDatabase();
			$sqlst="SELECT `cakeid`, `quantity`, `totalprice` FROM `cart` WHERE `userid`=?";
			if($sql =$con->prepare($sqlst)){
		// Bind the appropriate values that have to be inserted into db
				$sql->bind_param('i', $UserID);
				$sql->execute();
				$sql->bind_result( $cakeId, $quantity, $totalCost);
				// $this->totalQuantity=0;
				while ($sql->fetch()) {

					$this->setCakeId($cakeId);
					$this->setQuantity($quantity);
					$this->setTotalCost($totalCost);
					$this->getCakeDetails($this->getCakeId());
					$this->retriveAddressDetails($this->getCakeId());
					$details= $this->printOrder();
					echo "<div id=\"content\">".$details."</div>";

				}


			}

		}

		function getCakeDetails($cakeid){
			$uid=$this->getuid();
			$con = $this->connectToDatabase();
                    		 // declaring a variable for select query.
			$sqlSt = "SELECT `cake_name`, `cost_item`, `cake_image_path` FROM `cake_details` WHERE `cakeid`=?";
							//cursor variable for selecting the rows in the database.
			if($sql =$con->prepare($sqlSt)){
									// Bind the appropriate values that have to be inserted into db
				$sql->bind_param('i', $cakeid);
									//check if it executes
				$sql->execute();

				$sql->bind_result( $cakeName, $cakeCost, $cakeImage);	
				while ($sql->fetch()) {
					$this->cakeImage=$cakeImage;
					$this->cakeName=$cakeName;
					$this->cakeCost=$cakeCost;
				}

			}else{
				$this->errorInfo="Something went wrong working on it" ;
			}

		}

		function printOrder(){


			return "
			<table style=\"width:100%; text-align:center;\">
			<tbody><tr >
			<th>Cake Details</th>
			<th>Delivery Address</th> 
			<th>Order Details</th>
			</tr>
			<tr>
			<td><ul><li>
			<figure><img src =\"img/cakes/$this->cakeImage\" alt = \"$this->cakeName\" width= \"50px\" height= \"50px\" />
			</figure></li><li>$this->cakeName</li><li style=\"color:red;\">$$this->cakeCost</li></ul></td>
			<td><ul><li> $this->address</li></ul></td>
			<td><ul><li>Quantity: $this->quantity</li><li><h2>Cost:$ $this->totalCost</h2></li></ul></td>
			</tr>
			</tbody></table>

			";
		}
	//this function is used to insert newly created order into order table
		function retriveAddressDetails($cakeId)
		{
	//declaring a variable userid for retrieving the customer id.
			$userid=$this->getuid();
	//declaring a variable cakeId for retrieving the cakeId.

	//initializing a variable order_status for storing the status of order.
			$order_status="pending";
	//initializing a variable payment_status for storing the payment_status .
			$payment_status="NOT YET PAID";

			$con=$this->connectToDatabase();
    // declaring variable con to call function connectToDatabase and storing in it
	//Execute sql query to insert customer order details into database

			$stmt1 = $con->prepare("INSERT INTO `customer_order`(`userid`, `cakeid`, `deliverer_id`, `date_of_delivery`,
				`time_of_delivery`, `order_status`, `order_mailing_address`, `city`, `zip`, `phone_no`,
				`payment_status`) values (?,?,null,?,?,?,?,?,?,?,?)");

	//Bind the appropriate values that have to be inserted into db
			$stmt1->bind_param("iissssssss",$userid,$cakeId,$this->date_Of_Delivery,$this->time_Of_Delivery,$order_status,$this->address,
				$this->city,$this->zip,$this->phone,$payment_status);
	//execute sql statement
			if(!$stmt1->execute()){

				$this->setErrorMessage("Order not updated");
			}

		}

		function setErrorMessage($errorMessage){
			$this->errorMessage = $errorMessage;
		}

		function getErrorMessage(){
			return $this->errorMessage;
		}

		function getDateofDelievery(){
			return $this->date_Of_Delivery;
		}
		function getPhoneNumber(){
			return $this->phone;
		}
		public function getEmailAddress(){
			return $this->email_Address;
		}
		function validationOfEmail($email_Address)
		{
	 //validating the email
			if(!preg_match('/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/', $email_Address, $matcher))
			{
				return false;
			}
			return true;


		}
	// this function is used to validate phone number
		function validation_phonenumber($phone_number)
		{
	 //validating the phone number
			if(!preg_match('/^\d{10}/', $phone_number, $matcher))
			{
				return false;
			}
			return true;
		}
	// this function is used to redirect feedback page
		function redirect()
		{
		//redirect to feedback page when place order button is clicked
			// header("location: feedback.php");
		}

	  // this function is used to validate date of delivery
		function checkDateofDelievery($dateOfDelivery)
		{
		// validation for date and time
			$now =new DateTime();
			if(date_format($now,'Y-m-d') >= $dateOfDelivery){
				return false;
			}
			return true;
		}
		function emptyCart($userid){
			$con=$this->connectToDatabase();
			$sqlst="DELETE FROM `cart` WHERE `userid`=?";
			if($sql =$con->prepare($sqlst)){
			// Bind the appropriate values that have to be deleted from
				$sql->bind_param('i', $userid);
				$sql->execute();
			}
		}
	}
	$obj= new customerDeliveryDetails();
	$obj->includeHeader();

	$headerObj = new Header();

	if(!isset($_SESSION["userEmail"])){
		header("Location:logout.php");
	}
	if($_SESSION["userType"]!='customer'){ 
		header("Location:logout.php");
	}

	echo "<h2 style=\"text-align:center;\">Order Details</h2>";
	if(isset($_POST["submit"]))
	{	
		$obj->setDetails($_POST);
		$date_of_delivery=$obj->getDateofDelievery();
		$phone_number=$obj->getPhoneNumber();

		if($obj->checkDateofDelievery($date_of_delivery))
		{
			if($obj->validation_phonenumber($phone_number))
			{
				if($obj->validationOfEmail($obj->getEmailAddress())){
					$obj->getCakeIDFromUserID($obj->getuid());
					$obj->emptyCart($obj->getuid());
				}else{
					$obj->setErrorMessage("Invalid Email Address");
				}
				$obj->redirect();
			}else
			{
				$obj->setErrorMessage("Invalid Phone number");
			}
		}
		else
		{
			$obj->setErrorMessage("Invalid date of delivery and time of delivery.");
		}

		if($obj->getErrorMessage() !=""){

			echo "<p id=\"errorMessage\">".$obj->getErrorMessage()."</p>";
		}
	}
	?>
	<div id="paypal-button-container" style="float: right;"></div>

<?php $obj->includeFooter(); ?>
</body>
<script>
	paypal.Button.render({

            env: 'sandbox', // sandbox | production
            style:{
            	size:'large'
            },
            // PayPal Client IDs - replace with your own
            // Create a PayPal app: https://developer.paypal.com/developer/applications/create
            client: {
            	sandbox:'AVfY6EpfM5lKrCFU382FXF2g797-fFyyIYjkiB_25RjzTz6l9JK7K8uBKEgTRYSK93PSBWVrNiNDKgPb'
            	
            },

            // Show the buyer a 'Pay Now' button in the checkout flow
            commit: true,

            // payment() is called when the button is clicked
            payment: function(data, actions) {
                // Make a call to the REST api to create the payment
                return actions.payment.create({
                	
                	payment: {
                		transactions: [
                		{
                			amount: { total: 10, currency: 'USD' }
                		}
                		]
                	}
                });
            },

            // onAuthorize() is called when the buyer approves the payment
            onAuthorize: function(data, actions) {
                // Make a call to the REST api to execute the payment
                return actions.payment.execute().then(function() {
                	window.alert('Payment Complete! with PaymentID'+data.paymentID);
                	window.location.href="feedback.php";
                });
            }

        }, '#paypal-button-container');

    </script>
    </html>
