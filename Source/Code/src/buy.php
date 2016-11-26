<?php
// includes the header file
include "utils.php";
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
	 
	
	function retriveAddressDetails($con)
	{
// // check if the submit button of the form for the deliverer details is clicked or not.
	if(isset($_POST["submit"]))
	{	
	//declaring a variable date_Of_Delivery for retrieving the customer cake delivery date.
	$this->date_Of_Delivery = $_POST['Date_Of_Delivery'];
	//declaring a variable time_Of_DeliveryDelivery for retrieving the customer cake delivery time.
	$this->$time_Of_Delivery = $_POST['Time_Of_Delivery'];
	//declaring a variable email_Address for retrieving the customer email.
	$this->$email_Address = $_POST['Email_Address']; 
	//declaring a variable phone for retrieving the customer phone.
	$this->$phone = $_POST['Phone'];
    //declaring a variable address for retrieving the customer address.	
	$this->$address = $_POST['Address'];
    //declaring a variable country for retrieving the customer country.	
	$this->$country=$_POST['country'];
	//declaring a variable city for retrieving the customer city.
	$this->$city=$_POST['city'];
	//declaring a variable zip for retrieving the customer zip.
	$this->$zip=$_POST['zip'];
	//declaring a variable userid for retrieving the customer id.
	$userid=$_SESSION["userID"];
	//declaring a variable cakeId for retrieving the cakeId.
	$cakeId=$_POST['cakeId'];
	//initializing a variable order_status for storing the status of order.
	$order_status="pending";
	//initializing a variable payment_status for storing the payment_status .
	$payment_status="not_yet_paid";
	//declaring a variable error_message for storing error message.
	$error_message = "";
	echo "Cake id ".$cakeId." userID ".$userid ." is printed";
    // declaring variable con to call function connectToDatabase and storing in it
	//$con= connectToDatabase("localhost", "root", "","onlinecakedelivery");
	//Execute sql query to insert customer order details into database
	$stmt1 = $con->prepare("INSERT INTO customer_order(`userid`, `cakeid`, `deliverer_id`, `date_of_delivery`,
		`time_of_delivery`, `order_status`, `order_mailing_address`, `city`, `zip`, `phone_no`,
		`payment_status`) values (?,?,null,?,?,?,?,?,?,?,?)");
	//Bind the appropriate values that have to be inserted into db
	$stmt1->bind_param("iissssssss",$userid,$cakeId,$date_Of_Delivery,$time_Of_Delivery,$order_status,$address,$city,$zip,$phone,$payment_status);
	//execute sql statement
	if($stmt1->execute()){
		echo "order updated";
     }else{
     	echo "Order not updated";
     }
	}
 }
     
	 function validationOfData()
	{
	// validation for date and time
	$now =new DateTime();
	if($now>=$this->date_Of_Delivery){
		$error_message="Invalid date of delivery and time of delivery.<br/>";
	}
	 //validating the email
	 $email_Address = filter_var($email_Address, FILTER_SANITIZE_EMAIL);

	 if (!filter_var($email_Address, FILTER_VALIDATE_EMAIL) === false) {
	echo("$email is a valid email address");
	}
	else {
	echo("$email is not a valid email address");
	}
	 //validating the phone number
	 if(!preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $_POST['phone']))
    {
      $error = 'Invalid Number!';
    }
	}
	 function redirect()
	  {
		//redirect to feedback page when place order button is clicked
	  header("location: feedback.php");
      }
	
}
$Obj= new customerDeliveryDetails();
$Obj->includeHeader();
$con=$Obj->connectToDatabase();
$Obj->retriveAddressDetails($con);
$Obj->validationOfData();
$Obj->redirect();
$Obj->includeFooter();
?>

