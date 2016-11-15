<!DOCTYPE html>
<html>
	<head>
		<title>Login User</title>
		<link rel="stylesheet" type="text/css" href="css/login_style.css"/>

	</head>

	<body>
	
	<?php include 'header.php'?>
		
		<?php
			// Starting Session
			if((isset($_SESSION["userEmail"]) && (isset($_SESSION["userID"])) && (isset($_SESSION["userType"])))){
				echo"User session already exists";
				$redirectpage = redirectBrowser($_SESSION["userType"]);	
				header($redirectedpage);
				exit();
			}
			else{
				
			$error=''; // Variable To Store Error Message
			//Check if submit is clicked.
			if (isset($_POST['submit'])) {
				//checking if data entered is empty or not.
				if (empty($_POST['userEmail']) || empty($_POST['userPassword'])) {
					$error = "user Email or Password are empty.";
				}
				else
				{
					$con = connectToDatabase();

					$userType = $_POST['userType'];
					if($userType == 'admin'){
						$table="login_admin";
					}else if($userType =='customer'){
						$table = "login_customer";
					}else if($userType == 'deliverer'){
						$table = "login_deliverer";
					}

					$userEmail=$_POST['userEmail'];
				    $password=$_POST['userPassword'];

// SQL query to fetch information of registerd users and finds user match.
$sql = ("SELECT email,password, userid FROM ".$table." WHERE email ='".$userEmail."'");

$result = $con->query( $sql);
	if ($result->num_rows > 0) 
	{
	while($row = $result->fetch_assoc())
	{
	$dbUserEmail=$row['email'];
	$dbPassword=$row['password'];
	$userId=$row['userid'];
	
	if($userEmail == $dbUserEmail && $password == $dbPassword)
	{
	$_SESSION['userEmail']=$userEmail;
	$_SESSION['userID'] = $userId;
	$_SESSION['userType'] = $userType;
	/* Redirect browser */
	$redirectedpage = redirectBrowser($userType);
	header($redirectedpage);
	exit();
	} else {
	echo "Invalid username or password!";
	}
	}
	}else {
	 $error= "NOT a valid userEmail or password given, please check.";
	}
	
	
}
}
}
?>

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
?>

<?php 
function redirectBrowser($userType){
	if($userType == 'admin'){
		$redirectpage= "Location: admin_control.php";
	}else if($userType =='customer'){
		$redirectpage="Location: index_Customer_logged.php";
	}else if($userType == 'deliverer'){
		$redirectpage = "Location: customerOrders.php";
	}
	return $redirectpage;
}
?>

<h2>Login</h2>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="loginForm" id="login_form">

				<table>

					<tr>
						<td>UserEmail:</td><td>
							<input type="text" name="userEmail" placeholder="xyz@gmail.com" required/>
						</td>
					</tr> 
					<tr>
						<td>UserPassword:</td><td>
							<input type="password" name="userPassword" placeholder="****" required/></td>
					</tr>
					<tr>
						<td>UserType: </td><td>
							<select name="userType">
								<option value="customer">Customer</option>
								<option value="deliverer">Deliverer</option>
								<option value="admin">Admin</option>
							</select>
						</td>
					</tr>
					<tr><td>
							<input type="submit" value="login" name="submit" id="login_button"/>
						</td>
					</tr>
				</table>	
			</form>


			<?php include 'footer.php'?>
		</body>
	</html>
	