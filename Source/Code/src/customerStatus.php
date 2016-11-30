
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
class customerStatus extends Utils
{
	private  $error;
	// retriving the status of the customer
	function retrieveStatus()
	{
		$con= $this->connectToDatabase();
		$userid=$_SESSION['userID'];
		$sql = ("SELECT order_status,date_of_delivery,time_of_delivery FROM customer_order where userid=userid  ");

		$result = $con->query( $sql);
		if ($result->num_rows > 0) 
		{
				echo "<table id=\"customerStatus\"> <tbody> 
					<tr>
					<th>Order Status</th>
					<th>Date Of Delivery</th>
					<th>Time Of Delivery</th>
					</tr>";
			while($row = $result->fetch_assoc())
			{

				$this->printResults($row); 
			}
			echo "</tbody></table>";
		}
		else {
			$this->error= "You did not order any cake";
			echo "* ".$this->error;
		}

	}
	// function for printing the details of the customer
	function printResults($row){
		echo "<tr><td>".$row["order_status"]."</td><td>".$row["date_of_delivery"]."</td><td>".$row["time_of_delivery"]."</td></tr>";							 
	}	  
}
$obj=new customerStatus();
$obj->includeHeader();
$obj->retrieveStatus();
$obj->includeFooter();

?>


