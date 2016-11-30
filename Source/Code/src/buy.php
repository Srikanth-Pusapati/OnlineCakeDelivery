<?php
// includes the header file
include "utils.php";
//this class for storing the delivery details
class customerDeliveryDetails extends Utils
{	
        
	 private  $date_Of_Delivery;
	 private  $time_Of_Delivery;
	 private  $email_Address;
	 private  $phone;
	 private  $city;
	 private  $country;
	 private  $address;
	 private  $zip;
	 private $errorMessage="";
	 //this function is used to set order details
	 function setDetails($OrderDetails){
		 
	//declaring a variable date_Of_Delivery for retrieving the customer cake delivery date.
	$this->date_Of_Delivery = $OrderDetails['Date_Of_Delivery'];
	//declaring a variable time_Of_DeliveryDelivery for retrieving the customer cake delivery time.
	$this->time_Of_Delivery = $OrderDetails['Time_Of_Delivery'];
	//declaring a variable email_Address for retrieving the customer email.
	$this->email_Address = $OrderDetails['Email_Address']; 
	//declaring a variable phone for retrieving the customer phone.
	$this->phone = $OrderDetails['Phone'];
    //declaring a variable address for retrieving the customer address.	
	$this->address = $OrderDetails['Address'];
    //declaring a variable country for retrieving the customer country.	
	$this->country=$OrderDetails['country'];
	//declaring a variable city for retrieving the customer city.
	$this->city=$OrderDetails['city'];
	//declaring a variable zip for retrieving the customer zip.
	$this->zip=$OrderDetails['zip'];
	 }
	//this function is used to insert newly created order into order table
	function retriveAddressDetails($con)
	{
		
	//declaring a variable userid for retrieving the customer id.
	$userid=$_SESSION["userID"];
	//declaring a variable cakeId for retrieving the cakeId.
	$cakeId=$_POST['cakeId'];
	//initializing a variable order_status for storing the status of order.
	$order_status="pending";
	//initializing a variable payment_status for storing the payment_status .
	$payment_status="NOT YET PAID";
    // declaring variable con to call function connectToDatabase and storing in it
	//$con= connectToDatabase("localhost", "root", "","onlinecakedelivery");
	//Execute sql query to insert customer order details into database
	$stmt1 = $con->prepare("INSERT INTO customer_order(`userid`, `cakeid`, `deliverer_id`, `date_of_delivery`,
		`time_of_delivery`, `order_status`, `order_mailing_address`, `city`, `zip`, `phone_no`,
		`payment_status`) values (?,?,null,?,?,?,?,?,?,?,?)");
	//Bind the appropriate values that have to be inserted into db
	$stmt1->bind_param("iissssssss",$userid,$cakeId,$this->date_Of_Delivery,$this->time_Of_Delivery,$order_status,$this->address,
	$this->city,$this->zip,$this->phone,$payment_status);
	//execute sql statement
	if($stmt1->execute()){
		echo "order updated";
     }else{
     	echo "Order not updated";
     }
	
 }
     /*function checkDateofDelievery($DateOfDelivery){
		// validation for date and time
		$now =new DateTime();
		if($now>=$this->date_Of_Delivery){
			return true;
			//$this->setErrorMessage("Invalid date of delivery and time of delivery.");
		}
		else
		{
			return false;
		}
	 }*/
	 
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
      //$error = 'Invalid Number!';
	  return false;
     }
		 return true;
	}
	// this function is used to redirect feedback page
	 function redirect()
	  {
		//redirect to feedback page when place order button is clicked
	  header("location: feedback.php");
      }
	  
	  // this function is used to validate date of delivery
	  function checkDateofDelievery($dateOfDelivery)
	  {
		  echo "inside 1";
		// validation for date and time
		$now =new DateTime();
		//echo "value of now is ".$now;
		
		if($now >= strtotime( $dateOfDelivery)){
			echo "value of datedelivery is ".$dateOfDelivery;
		return false;
			//$this->setErrorMessage("Invalid date of delivery and time of delivery.");
		}
		echo "always true ";
			return true;
	 }
	
}
$obj= new customerDeliveryDetails();
$obj->includeHeader();
$con=$obj->connectToDatabase();
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
		$obj->retriveAddressDetails($con);
		}else{
			$obj->setErrorMessage("Invalid Email Address");
		}
		//$obj->redirect()
	}
	else
	{
		$obj->setErrorMessage("Invalid Phone number");
	}
}
else
{
	$obj->setErrorMessage("Invalid date of delivery and time of delivery.");
}
if($obj->getErrorMessage() ==""){
			$obj->redirect();

}else{
	echo "<p id=\"errorMessage\">".$obj->getErrorMessage()."</p>";
}
	}
$obj->includeFooter();
?>

