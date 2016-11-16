<!DOCTYPE html>
<html>
<body>
	<?php include 'header.php';?>
	
	<?php 
	if(isset($_POST["submit"])){
		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$uname = $_POST['uname'];
		$email=$_POST['email'];
		$address = $_POST['address'];
		$pwd = $_POST['pwd'];
		$mobile= $_POST['mobile'];
		$u_type=$_POST['type'];
		$conn = new mysqli($dbhost, $dbuser, $dbpass,'onlinecakedelivery');
		if ($conn->connect_error) {
			die ( "Connection failed: " . $con->connect_error );
		}	
		$sql =$conn->prepare ( "INSERT INTO `registration`( `user_name`, `password`, `email`, `address`, `mobile_number`, `user_type`) VALUES
			(?,?,?,?,?,?)");
		$sql->bind_param("ssssss",$uname,$pwd,$email,$address,$mobile,$u_type);
		if($sql->execute ()){
//mysql_select_db('onlinecakedelivery');
			echo "registered successfully";
			header("Location:index.php");

		}else{
			echo "Error occured, please retry.";
			
		}
		$conn ->close();
	}
	?>

	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>";>
		
		<table align=center>

			<tr>
				<td>Name:</td>
				<td> <input type="text" name="uname"></td>
			</tr>


			<tr><td>Email:</td>
				<td> <input type="text" name="email"><br/> </td></tr>
				<tr>
					<td>Address:</td>
					<td><textarea rows="4" maxlen="200" name="address" cols="20"></textarea></td></tr>
					<tr><td>Password:
					</td> 
					<td><input type="password" name="pwd"><br/></td></tr>  
					
					<tr><td>Cell Number:</td>
						<td> <input type="text" name="mobile"><span id="numloc"></span><br/></td></tr>  
						<tr><td>User Type:</td>
							<td><select name="type">
								<option value="customer">Customer</option>
								<option value="deliverer">Deliverer</option>
							</select></br><br/></td></tr>
							
							<tr>
								<td><br><input type="submit" name="submit" value="Submit"></td></tr></table>
							</form>
							<?php include 'footer.php';?>
						</body>
						</html>


						