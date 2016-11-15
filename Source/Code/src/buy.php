<?php
function connectToDatabase(){
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "onlinecakedelivery";
 
// Create connection
$con = new mysqli ( $servername, $db_username, $db_password, $dbname );
// Check connection
if ($con->connect_error) {
           die ( "Connection failed: " . $con->connect_error );
}         
 
return $con;
}


// validation expected data exists
if(isset($_POST["submit"])){
	if(empty($_POST['Date_Of_Delivery']) ||
		empty($_POST['Time_Of_Delivery']) ||
		empty($_POST['Email_Address']) ||
		empty($_POST['Phone']) ||
		empty($_POST['Address'])||
		empty($_POST['country'])||
		empty($_POST['city'])||
		empty($_POST['zip'])){
		session_start();
		$_SESSION['Error'] = "You left one or more of the required fields.";
         header("location: checkout.php");		}
     }
		else
		{
	$date_Of_Delivery = $_POST['Date_Of_Delivery']; // required
	$time_Of_Delivery = $_POST['Time_Of_Delivery']; // required
	$email_Address = $_POST['Email_Address']; // required
	$phone = $_POST['Phone']; // not required
	$address = $_POST['Address']; 
	$country=$_POST['country'];
	$city=$_POST['city'];
	$zip=$_POST['zip'];
	$orderid=1; //should be retrived from session.
    $userid=1;
	//$cakeid=$_POST['cakeid'];
	$cakeid=1;
	//$deliverer_id=null;
	$order_status="pending";
	$payment_status="not_yet_paid";
	$error_message = "";
 
  $now =new DateTime();
  if($now>=$date_Of_Delivery){
     $error_message="Invalid date of delivery and time of delivery.<br/>";
  }

  $con= connectToDatabase();
 
  
  $stmt1 = $con->prepare("INSERT INTO customer_order(`userid`, `cakeid`, `deliverer_id`, `date_of_delivery`,
  `time_of_delivery`, `order_status`, `order_mailing_address`, `city`, `zip`, `phone_no`,
  `payment_status`) values (?,?,null,?,?,?,?,?,?,?,?)");
	$stmt1->bind_param("iissssssss",$userid,$cakeid,$date_Of_Delivery,$time_Of_Delivery,$order_status,$address,$city,$zip,$phone,$payment_status);
	$stmt1->execute();
		
		
	header("location: feedback.php");
/*$sql = "INSERT INTO customer_order (userid,
cakeid,deliverer_id,date_of_delivery,time_of_delivery,
order_status,order_mailing_address,city,zip,phone_no,
payment_status) VALUES ('$orderid','$userid','$cakeid',
'$deliverer_id','$Date_Of_Delivery','$Time_Osckf_Delivery',
'$order_status','$Address','$City','$Zip','$Phone',$payment_status)";
*/

	}
	
?>

	