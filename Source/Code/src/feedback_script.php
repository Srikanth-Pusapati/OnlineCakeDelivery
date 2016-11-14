<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$UI_rating = $_POST['UI_rating'];
$cake_available=$_POST['cake_available'];
$suggest= $_POST['suggest'];
$worth = $_POST['worth'];
$comment= $_POST['comment'];
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
$sql = "INSERT INTO feedback (UI_rating,cake_available,suggest,worth,comment) VALUES ('$UI_rating', '$cake_available','$suggest','$worth','$comment')";
mysql_select_db('onlinecakedelivery');
$retval = mysql_query($sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
else
header("location: success.php");
mysql_close($conn);
?>