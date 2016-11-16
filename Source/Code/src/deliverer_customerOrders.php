<!Doctype html>
<html>
<?php
include "header.php";
?>
<head>
<!-- This page is to display all available orders of all customers -->
	<title>Online </title>
	<h2>customer orders Available for pick up</h2>
</head>
<body>
	<?php
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
// Retreiving all orders having order_staus as "pending"
	$stmt1 = "SELECT o.orderid, o.date_of_delivery, o.time_of_delivery, o.order_mailing_address, o.city, o.zip, c.cake_name, c.cost_item FROM `cake_details` c JOIN `customer_order` o ON o.cakeid = c.cakeid WHERE o.order_status='pending' ";

	$result = $conn->query ( $stmt1 );

	if ($result->num_rows > 0) {
// output data of each row
		?>
		<!-- This form is used to display all orders having status as "pending" in a table format, After clicking "Pick Customer order button" it was redirected to "deliverer_selectedOrder.php" page -->
		<form method ="post" action ="deliverer_selectedOrder.php">	
			<table>
				<tr>
					<th>Date of Delivery</th>
					<th>Time of Delivery </th>
					<th>Mailling Address </th>
					<th>Cake Type</th>
					<th>Cost</th>
					<th>Select Order</th>
				</tr>
				<?php
				// Fetching all the rows in orders table having order_status as "pending" and here we are displaying in table
				while ( $row = $result->fetch_assoc () ) {
					?>

					<tr> 
						<td><?php echo($row["date_of_delivery"]); ?></td>
						<td><?php echo($row["time_of_delivery"]); ?></td>
						<td><?php echo $row["order_mailing_address"]." ".$row["city"]." ".$row["zip"]; ?></td>
						<td><?php echo($row["cake_name"]); ?></td>
						<td><?php echo($row["cost_item"]); ?></td>
						<!-- This "Pick customer order" button is used to confirm that current logined deliverer is gooing to deliver that order -->
						<td><input type="submit" name="selectcustomer_order" value ="Pick Customer Order" /></td>
						<!-- Here orderid is hidden item the main purpose is to send orderid value to "deliverer_selectedOrder.php" file   -->
						<td><input type="hidden" name = "orderid" value="<?php echo($row["orderid"]); ?>" /></td>
					</tr>
					<?php } ?>
				</table>
			</form>

			<?php

		}else {
			// If there are no current orders this message would be dispplayed
			echo "There are no orders to be displayed";
		}

		?>

		<?php
		include "footer.php";
		?>
	</body>

	</html>
