<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$uname = $_POST['uname'];
$email=$_POST['email'];
$address = $_POST['address'];
$pwd = $_POST['pwd'];
$mobile= $_POST['mobile'];
$u_type=$_POST['type'];
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
$sql = "INSERT INTO registration (uname,address,email,pwd,mobile,u_type) VALUES ('$uname', '$email','$address','$pwd','$mobile','$u_type')";
mysql_select_db('onlinecakedelivery');
$retval = mysql_query($sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
echo "registered successfully";
mysql_close($conn);
?>