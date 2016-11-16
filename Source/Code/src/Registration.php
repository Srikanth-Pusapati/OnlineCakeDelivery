<!DOCTYPE html>
<html>
<body>
	<?php include 'header.php';?>
	<?php 
	//check if the submit button of the form for uploading the customer details is clicked or not
	if(isset($_POST["submit"])){
    //dbhost - name of the server which is default localhost.
    // db_user - database username, which is default root.
    //db_pass - database password, default is empty. 
		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		//variable uname is initialized to data given from the form feild .
		$uname = $_POST['uname'];
		//variable email is initialized to data given from the form feild .
		$email=$_POST['email'];
		//variable address is initialized to data given from the form feild .
		$address = $_POST['address'];
		//variable pwd is initialized to data given from the form feild .
		$pwd = $_POST['pwd'];
		//variable mobile is initialized to data given from the form feild .
		$mobile= $_POST['mobile'];
		//variable u_type is initialized to data given from the form feild .
		$u_type=$_POST['type'];
		// Create connection to the database.
		$conn = new mysqli($dbhost, $dbuser, $dbpass,'onlinecakedelivery');
		// Check connection
		if ($conn->connect_error) {
			die ( "Connection failed: " . $con->connect_error );
		}
         // Execute sql query to insert registartion data into database		
		$sql =$conn->prepare ( "INSERT INTO `registration`( `user_name`, `password`, `email`, `address`, `mobile_number`, `user_type`) VALUES
			(?,?,?,?,?,?)");
	    // Bind the appropriate values that have to be inserted into db
		$sql->bind_param("ssssss",$uname,$pwd,$email,$address,$mobile,$u_type);
		//check if it executes
		if($sql->execute ()){
        //mysql_select_db('onlinecakedelivery');
			echo "registered successfully";
			header("Location:index.php");

		}else{
			echo "Error occured, please retry.";
			
		}
		// close connection
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


						