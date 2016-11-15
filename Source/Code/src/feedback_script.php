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


$UI_rating = $_POST['UI_rating'];
$cake_available=$_POST['cake_available'];
$suggest= $_POST['suggest'];
$worth = $_POST['worth'];
$comment= $_POST['comment'];
$conn = connectToDatabase();
$sql = "INSERT INTO feedback (UI_rating,cake_available,suggest,worth,comment) VALUES
 ('".$UI_rating."', '".$cake_available."','".$suggest."','".$worth."','".$comment."')";

 $result = $conn->query($sql);
	
header("location: success.php");
mysql_close($conn);
?>