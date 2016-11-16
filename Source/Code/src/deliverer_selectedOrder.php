<!Doctype html>
<html>
<?php
include "header.php";
?>
<head>
	<!-- This page is used to display all orders that current logined deliverer should deliver -->
	<title>customer_orders</title>
	<h2>customer orders to Deliver</h2>
</head>
<body>

	<?php
// getting deliverid from sesssion
$deliverer_id=$_SESSION["userID"];  
// These are database credentials 
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "onlinecakedelivery";

// Create connection
$conn = new mysqli ( $servername, $db_username, $db_password, $dbname );
// Check connection
if ($conn->connect_error) {
	die ( "Connection failed: " . $conn->connect_error );
}
// This condition is used to check whether it is redirected from "deliverer_customerOrders.php"
if(isset($_POST["orderid"]))
{
	//getting orderid from "deliverer_customerOrders.php" page
	$selected_orderid= (int)$_POST["orderid"];
	// This query is used to update deliver_id of specific selected order
	$stmt2 = $conn->prepare("UPDATE `customer_order` SET order_status='confirmed',deliverer_id=? WHERE orderid = ?");
	// Taking values from local declared variables
	$stmt2->bind_param("ii", $deliverer_id,$selected_orderid);
	$stmt2->execute();
}
// This query is used to display all orders that logined deliverer has to deliver
$stmt1 = $conn->prepare(" SELECT u.user_name, o.date_of_delivery, 
	o.time_of_delivery, o.order_mailing_address, o.city, o.zip, o.phone_no,
	c.cake_name, c.cost_item FROM `customer_order` o JOIN `cake_details` c ON o.cakeid = c.cakeid 
	JOIN `registration` u ON o.userid=u.userid WHERE o.order_status = 'confirmed' and o.deliverer_id=?");
$stmt1->bind_param("i", $deliverer_id);
$stmt1->execute();
$result = $stmt1->get_result();
// this condition is used to check whether there are any orders that logined deliverer has to deliver
if ($result->num_rows > 0) {
	?>
	<!-- This form is used to display all orders that logined deliverer has to deliver in table format-->
	<form>	
		<table>
			<tr>
				<th>Customer Name</th>
				<th>Date of Delivery</th>
				<th>Date of Delivery</th>
				<th>Time of Delivery </th>
				<th>Mailling Address </th>
				<th>Phone number</th>
				<th>Cake Type</th>
				<th>Cost</th>
			</tr>
			<?php
			// This is used to fetch each row retreived by query to get all orders that logined deliverer has to deliver
			while ( $row = $result->fetch_assoc () ) {
				?>

				<tr> 
					<td><?php echo($row["user_name"]); ?></td>
					<td><?php echo($row["date_of_delivery"]); ?></td>
					<td><?php echo($row["time_of_delivery"]); ?></td>
					<td><?php echo $row["order_mailing_address"]." ".$row["city"]." ".$row["zip"]; ?></td>
					<td><?php echo($row["phone_no"]); ?></td>
					<td><?php echo($row["cake_name"]); ?></td>
					<td><?php echo($row["cost_item"]); ?></td>
				</tr>
				<?php } ?>
			</table>
		</form>

		<?php
		
	}else {
		// this is displayed if there are no orders that logined deliverer has to deliver
		echo "0 results";
	}

	?>

</body>
<?php
include "footer.php";
?>
</html>
