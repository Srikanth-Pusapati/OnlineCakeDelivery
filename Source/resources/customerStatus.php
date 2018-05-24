
<!DOCTYPE html>
<html>
<head>
	<title>Customer Status</title>
	<link href="css/customerStatusCSS.css" rel="stylesheet">
</head>
<body>

</body>
</html>

<?php
// includes the header file
include "utils.php";
// class for retriving the customer status
class customerStatus extends Utils
{
	private $error;
	private $order_status;
	private $date_of_delivery;
	private $time_of_delivery;
	private $deliverer_id;
	private $paymentid;
	private $order_mailing_address;
	private $city;
	private $phone_no;
	private $payment_status;

	public function setDelivererID($deliverer_id){
		$this->deliverer_id=$deliverer_id;
	}
	public function setPaymentId($paymentid){
		$this->paymentid=$paymentid;
	}
	
	public function setOrderMailingAddress($order_mailing_address){
		$this->order_mailing_address=$order_mailing_address;
	}
	
	public function setCity($city){
		$this->city=$city;
	}
	
	public function setPhoeNo($phone_no){
		$this->phone_no=$phone_no;
	}
	public function setPaymentStatus($payment_status){
		$this->payment_status=$payment_status;
	}
	

	public function setOrderStatus($order_status){
		$this->order_status=$order_status;
	}
	public function getOrderStatus(){
		return $this->order_status;
	}
	public function setDateOfDelivery($date_of_delivery){
		$this->date_of_delivery=$date_of_delivery;
	}
	public function getDateOfDelivery(){
		return $this->date_of_delivery;
	}public function setTimeOfDelivery($time_of_delivery){
		$this->time_of_delivery=$time_of_delivery;
	}
	public function getTimeOfDelivery(){
		return $this->time_of_delivery;
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
	// retriving the status of the customer
	function retrieveStatus()
	{

		$con= $this->connectToDatabase();
		$userid=$this->getuid();
		
		$sqlst = "SELECT `date_of_delivery`, `time_of_delivery`, `order_status`, `order_mailing_address`,`city`,`phone_no`, `payment_status` FROM `customer_order` WHERE `userid`=?";

		if($sql =$con->prepare($sqlst)){
										// Bind the appropriate values that have to be inserted into db
			$sql->bind_param('i', $userid);
										//check if it executes
			if($sql->execute()){
			// $res=$sql->fetchall();
			// if($sql->num_rows!==0){
				$sql->bind_result($date_of_delivery, $time_of_delivery,$order_status,$order_mailing_address,$city,$phone_no,$payment_status);
				echo "<table id=\"customerStatus\"> <tbody> 
				<tr>
				<th>Order Status</th>
				<th>Date Of Delivery</th>
				<th>Time </th>
				<th>Mailing Address</th>
				<th>Phone Number</th>
				<th>Payment Status</th>				
				</tr>";

				while ($sql->fetch()) {

					$this->setOrderStatus($order_status);
					$this->setDateOfDelivery($date_of_delivery);
					$this->setTimeOfDelivery($time_of_delivery);
					$this->setOrderMailingAddress($order_mailing_address);
					$this->setCity($city);
					$this->setPhoeNo($phone_no);
					$this->setPaymentStatus($payment_status);
					$this->printResults(); 
				}

				echo "</tbody></table>";
			}
			else {
				$this->error= "You did not order any cake";
				echo "<h2 style=\"text-align:center;\">".$this->error."</h2>";
			}
		}else {
			$this->error= "You are not a valid user";
			echo "* ".$this->error;
		}
	}

	
	// function for printing the details of the customer
	function printResults(){
		echo "<tr><td>".$this->getOrderStatus()."</td><td>".$this->getDateOfDelivery()."</td><td>".$this->getTimeOfDelivery()."</td><td>".$this->order_mailing_address.$this->city."</td><td>".$this->phone_no."</td><td>".$this->payment_status."</td></tr>";							 
	}	  
}
$obj=new customerStatus();
$obj->includeHeader();
if (session_status() == PHP_SESSION_NONE) {

	session_name("OnlineCakeDelivery");
	session_start();
}
if(!isset($_SESSION["userEmail"])){
	header("Location:logout.php");
}elseif(!isset($_SESSION["userType"])){
	header("Location:logout.php");
}elseif($_SESSION["userType"]!='customer'){ 
	header("Location:logout.php");
}
$obj->retrieveStatus();
$obj->includeFooter();

?>
