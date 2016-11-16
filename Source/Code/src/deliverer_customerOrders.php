<!Doctype html>
<html>
<?php
include "header.php";
?>
<head>
	<title>Online </title>
	<h2>customer orders Available for pick up</h2>
</head>
<body>
	<?php

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

	$stmt1 = "SELECT o.orderid, o.date_of_delivery, o.time_of_delivery, o.order_mailing_address, o.city, o.zip, c.cake_name, c.cost_item FROM `cake_details` c JOIN `customer_order` o ON o.cakeid = c.cakeid WHERE o.order_status='pending' ";

	$result = $conn->query ( $stmt1 );

	if ($result->num_rows > 0) {
// output data of each row
		?>
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
				while ( $row = $result->fetch_assoc () ) {
					?>

					<tr> 
						<td><?php echo($row["date_of_delivery"]); ?></td>
						<td><?php echo($row["time_of_delivery"]); ?></td>
						<td><?php echo $row["order_mailing_address"]." ".$row["city"]." ".$row["zip"]; ?></td>
						<td><?php echo($row["cake_name"]); ?></td>
						<td><?php echo($row["cost_item"]); ?></td>
						<td><input type="submit" name="selectcustomer_order" value ="Pick Customer Order" /></td>
						<td><input type="hidden" name = "orderid" value="<?php echo($row["orderid"]); ?>" /></td>
					</tr>
					<?php } ?>
				</table>
			</form>

			<?php

		}else {
			echo "There are no orders to be displayed";
		}

		?>

		<?php
		include "footer.php";
		?>
	</body>

	</html>
