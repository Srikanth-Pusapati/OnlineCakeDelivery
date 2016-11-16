<?php
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
function connectToDatabase($servername, $db_username, $db_password, $db_name){
	
// Create connection to the database.
	$conn = new mysqli ( $servername, $db_username, $db_password, $db_name );
// Check connection
	if ($conn->connect_error) {
		die ( "Connection failed: " . $conn->connect_error );
	}
//return the connection object.
	return $conn;
}
//variable UI_rating is initialized to data given from the form feild 
$UI_rating = $_POST['UI_rating'];
//variable cake_available is initialized to data given from the form feild 
$cake_available=$_POST['cake_available'];
//variable suggest is initialized to data given from the form feild 
$suggest= $_POST['suggest'];
//variable worth is initialized to data given from the form feild 
$worth = $_POST['worth'];
//variable comment is initialized to data given from the form feild 
$comment= $_POST['comment'];
// connection object is obtained.
$conn =connectToDatabase("localhost", "root", "","onlinecakedelivery");
//Execute sql query to insert feedback data into database
$sql = "INSERT INTO feedback (UI_rating,cake_available,suggest,worth,comment) VALUES
('".$UI_rating."', '".$cake_available."','".$suggest."','".$worth."','".$comment."')";
//results are stored 
$result = $conn->query($sql);

header("location: success.php");
mysql_close($conn);
?>