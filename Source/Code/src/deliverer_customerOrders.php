<!Doctype html>
<html>
<?php
include "utils.php";
$utils =new Utils();
$utils->includeHeader();
?>
<head>
	<!-- This page is to display all available orders of all customers -->
	
	<title>Deliverer Orders</title>
	<h2>customer orders Available for pick up</h2>
	<link href="css/deliverer_customerOrders.css" rel="stylesheet">
</head>
<body>
	<?php
	class Customer_Orders extends Utils
	{
		
		function pending_Orders($con)
		{
			// Retreiving all orders having order_staus as "pending"
			$stmt1 = "SELECT o.orderid, o.date_of_delivery, o.time_of_delivery, o.order_mailing_address, o.city, o.zip, c.cake_name, c.cost_item FROM `cake_details` c JOIN `customer_order` o ON o.cakeid = c.cakeid WHERE o.order_status='pending' ";

			$result = $con->query ( $stmt1 );
			return $result;
		}
		function printContent($result){

			if ($result->num_rows > 0) {
	// output data of each row

				/* This form is used to display all orders having status as "pending" in a table format, After clicking "Pick Customer order button" it was redirected to "deliverer_selectedOrder.php" page -->*/
				echo "
				<form method =\"post\" id=\"customerOders\" action =\"deliverer_selectedOrder.php\">	
					<table>
						<tr>
							<th>Date of Delivery</th>
							<th>Time of Delivery </th>
							<th>Mailling Address </th>
							<th>Cake Type</th>
							<th>Cost</th>
							<th>Select Order</th>
						</tr>";
						/* Fetching all the rows in orders table having order_status as "pending" and here we are displaying in table*/
						while ( $row = $result->fetch_assoc () ) {

							echo "
							<tr> 
								<td> ".$row["date_of_delivery"]." </td>
								<td>". $row["time_of_delivery"] ."</td>
								<td>". $row["order_mailing_address"]." ". $row["city"] ." ". $row["zip"] ." ". "</td>
								<td>". $row["cake_name"]." </td>
								<td>". $row["cost_item"] ."</td>";
								/* This "Pick customer order" button is used to confirm that current logined deliverer is gooing to deliver that order */
								echo "
								<td><input type=\"submit\" name=\"selectcustomer_order\" value =\"Pick Customer Order\" /></td>";
								/* Here orderid is hidden item the main purpose is to send orderid value to "deliverer_selectedOrder.php" file   */
								echo "
								<td><input type=\"hidden\" name = \"orderid\" value=".$row["orderid"]." /></td>
							</tr>";
						}
						echo "
					</table>
				</form>";

			}else {
			// If there are no current orders this message would be dispplayed
				echo "There are no orders to be displayed";
			}

		}
	}
	$orders_object = new Customer_Orders;
	$connection_object= $orders_object -> connectToDatabase();
	$result=$orders_object -> pending_Orders($connection_object);
	$orders_object->printContent($result);

	$utils->includeFooter();
	?>
</body>

</html>
