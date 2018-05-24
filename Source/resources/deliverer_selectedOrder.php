<!Doctype html>
<html>
<?php
include "utils.php";
$utils =new Utils();
$utils->includeHeader();
?>
<?php 
$headerObj = new Header();
if(!isset($_SESSION["userEmail"])){
	header("Location:logout.php");
}elseif(!isset($_SESSION["userType"])){
	header("Location:logout.php");
}elseif($_SESSION["userType"]!='deliverer'){ 
	header("Location:logout.php");
}
?>
<head>
	<!-- This page is used to display all orders that current logined deliverer should deliverer -->
	<title>Deliverer Selected orders</title>
	<link href="css/deliverer_selectedOrderCSS.css" rel="stylesheet">
</head>
<body>

<?php
	// this class contains all functions to display all orders that specific deliverer should deliver
class SelectedOrder extends Utils{
// getting deliverid from sesssion
// this function is used to update order status
function updateSelectedOrder($deliverer_id, $conn){
	//getting orderid from "deliverer_customerOrders.php" page
	$selected_orderid= (int)$_POST["orderid"];
	// This query is used to update deliverer_id of specific selected order
	$stmt2 = $conn->prepare("UPDATE `customer_order` SET order_status='confirmed',deliverer_id=? WHERE orderid = ?");
	// Taking values from local declared variables
	$stmt2->bind_param("ii", $deliverer_id,$selected_orderid);
	$stmt2->execute();
}
//this function is used to retreive all orders that specific deliverer should deliver
function confirmedOrderResults($deliverer_id, $conn){

// This query is used to display all orders that logged deliverer has to deliverer
$stmt1 = $conn->prepare(" SELECT u.user_name, o.date_of_delivery, 
	o.time_of_delivery, o.order_mailing_address, o.city, o.zip, o.phone_no,
	c.cake_name, c.cost_item FROM `customer_order` o JOIN `cake_details` c ON o.cakeid = c.cakeid 
	JOIN `registration` u ON o.userid=u.userid WHERE o.order_status = 'confirmed' and o.deliverer_id=?");
$stmt1->bind_param("i", $deliverer_id);
$stmt1->execute();
$result = $stmt1->get_result();
return $result;
}
//this function is used to display all orders that specific deliverer should deliver
public function printResults($result){
// this condition is used to check whether there are any orders that logined deliverer has to deliverer
if ($result->num_rows > 0) {
	
	/* This form is used to display all orders that logined deliverer has to deliverer in table format*/
	echo "
	<form>	
		<table id=\"selectedOrderId\">
			<tr>
				<th>Customer Name</th>
				<th>Date of Delivery</th>
				<th>Time of Delivery </th>
				<th>Mailling Address </th>
				<th>Phone number</th>
				<th>Cake Type</th>
				<th>Cost</th>
			</tr>";
			/* This is used to fetch each row retreived by query to get all orders that logined deliverer has to deliverer*/
			while ( $row = $result->fetch_assoc () ) {
				echo "

				<tr> 
					<td>".$row["user_name"]."</td>
					<td>".$row["date_of_delivery"]."</td>
					<td>".$row["time_of_delivery"]."</td>
					<td>".$row["order_mailing_address"]." ".$row["city"]." ".$row["zip"]."</td>
					<td>".$row["phone_no"]."</td>
					<td>".$row["cake_name"]."</td>
					<td>".$row["cost_item"]."</td>
				</tr>";
			} 
			echo "
			</table>
		</form>";

	}else {
		// this is displayed if there are no orders that logined deliverer has to deliverer
		echo "0 results";
	}
}
}
	$selectedOrderObject = new SelectedOrder();
	$selectedOrderObject->includeHeader();
	$conn = $selectedOrderObject->connectToDatabase();
// This condition is used to check whether it is redirected from "deliverer_customerOrders.php"
if(isset($_POST["orderid"]))
{
	$selectedOrderObject ->updateSelectedOrder($_SESSION["userID"], $conn);
	
}
$result = $selectedOrderObject->confirmedOrderResults($_SESSION["userID"], $conn);
$selectedOrderObject->printResults($result);
$selectedOrderObject -> includeFooter();
?>
</body>

</html>
