<?php
// includes the header file
include "header.php";
/**
* function for "connect to database".
*
* @param servername - name of the server which is default localhost.
* @param db_username - database username, which is default root.
* @param db_password - database password, default is empty.
* @param db_name - database name, in this project it is 'onlinecakedelivery'.
* @return conn - database connection object.
* This method tries to connect to database with the provided details and if there is a connection error,
*  it prints out the error 
**/			
function connectToDatabase($servername,$db_username, $db_password, $dbname ){	
// Create connection
	$con = new mysqli ( $servername, $db_username, $db_password, $dbname );
// Check connection
	if ($con->connect_error) {
		die ( "Connection failed: " . $con->connect_error );
	}         
	
	return $con;
}
// // check if the submit button of the form for the deliverer details is clicked or not.
if(isset($_POST["submit"])){
	//declaring a variable date_Of_Delivery for retrieving the customer cake delivery date.
	$date_Of_Delivery = $_POST['Date_Of_Delivery'];
	//declaring a variable time_Of_DeliveryDelivery for retrieving the customer cake delivery time.
	$time_Of_Delivery = $_POST['Time_Of_Delivery'];
	//declaring a variable email_Address for retrieving the customer email.
	$email_Address = $_POST['Email_Address']; 
	//declaring a variable phone for retrieving the customer phone.
	$phone = $_POST['Phone'];
    //declaring a variable address for retrieving the customer address.	
	$address = $_POST['Address'];
    //declaring a variable country for retrieving the customer country.	
	$country=$_POST['country'];
	//declaring a variable city for retrieving the customer city.
	$city=$_POST['city'];
	//declaring a variable zip for retrieving the customer zip.
	$zip=$_POST['zip'];
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
	// validation for date and time
	$now =new DateTime();
	if($now>=$date_Of_Delivery){
		$error_message="Invalid date of delivery and time of delivery.<br/>";
	}
    // declaring variable con to call function connectToDatabase and storing in it
	$con= connectToDatabase("localhost", "root", "","onlinecakedelivery");
	
	//Execute sql query to insert customer order details into database
	$stmt1 = $con->prepare("INSERT INTO customer_order(`userid`, `cakeid`, `deliverer_id`, `date_of_delivery`,
		`time_of_delivery`, `order_status`, `order_mailing_address`, `city`, `zip`, `phone_no`,
		`payment_status`) values (?,?,null,?,?,?,?,?,?,?,?)");
	//Bind the appropriate values that have to be inserted into db
	$stmt1->bind_param("iissssssss",$userid,$cakeId,$date_Of_Delivery,$time_Of_Delivery,$order_status,$address,$city,$zip,$phone,$payment_status);
	//execute sql statement
	$stmt1->execute();
	//redirect to feedback page when place order button is clicked
	header("location: feedback.php");

}
 //includes footer file
include 'footer.php';
?>

