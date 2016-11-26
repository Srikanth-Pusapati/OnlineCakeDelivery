<!DOCTYPE html>
<html>
<body>
<title>Registration</title>
	<link href="css/registration.css" rel="stylesheet" />
	<?php
	include 'utils.php';
	/*$utilsObj = new Utils();

	$utilsObj -> includeHeader();*/
	//check if the submit button of the form for uploading the customer details is clicked or not
	class Registration extends Utils {
		private $uname;
		private $email;
		private $address;
		private $pwd;
		private $mobile;
		private $u_type;

		function setFormDetails($formDetails){
			//variable uname is initialized to data given from the form feild .
			$this->uname = $formDetails['uname'];
		//variable email is initialized to data given from the form feild .
			$this->email=$formDetails['email'];
		//variable address is initialized to data given from the form feild .
			$this->address = $formDetails['address'];
		//variable pwd is initialized to data given from the form feild .
			$this->pwd = $formDetails['pwd'];
		//variable mobile is initialized to data given from the form feild .
			$this->mobile= $formDetails['mobile'];
		//variable u_type is initialized to data given from the form feild .
			$this->u_type=$formDetails['type'];
		}
		function obtainInsertQuery(){
			return ("INSERT INTO `registration`( `user_name`, `password`, `email`, `address`, `mobile_number`, `user_type`) VALUES
				(?,?,?,?,?,?)");
		}
		function getUserId(){
			
			/*Connect to database*/
			$con = $this->connectToDatabase();
			
			/* create a prepared statement.*/
			$stmt = $con->prepare("select userid from registration where user_name=?");

			/* bind parameters for markers */
			$stmt->bind_param("s", $this->uname);

			/* execute query */
			$stmt->execute();

			/* bind result variables */
			$stmt->bind_result($userId);

			/* fetch value */
			$stmt->fetch();

			return $userId;
		}
		function getUname(){
			return $this->uname;
		}
		function getEmail(){
			return $this->email;
		}
		function getAddress(){
			return $this->address;
		}
		function getPassword(){
			return $this->pwd;
		}
		function getMobileNumber(){
			return $this->mobile;
		}
		function getUserType(){
			return $this->u_type;
		}
		function redirectBrowser($userType){
			if($userType == 'admin'){
				$redirectpage= "admin_features.php";
			}else if($userType =='customer'){
				$redirectpage="index_Customer_logged.php";
			}else if($userType == 'deliverer'){
				$redirectpage = "deliverer_customerOrders.php";
			}
			return $redirectpage;
		}

		function updateSession(){

			$_SESSION['userEmail']=$this->getEmail();
			$_SESSION['userID'] = $this->getUserId();
			$_SESSION['userType'] = $this->getUserType();
		}

		function executeInsertQuery(){
			 // Execute sql query to insert registartion data into database	
			 $conn = $this->connectToDatabase();	
		$sql =$conn->prepare ($this->obtainInsertQuery());
	    // Bind the appropriate values that have to be inserted into db
		$sql->bind_param("ssssss",$this->uname, $this->pwd, $this->email, $this->address, $this->mobile, $this->u_type);
		//check if it executes
		$result = $sql->execute();
		if($result>0){
        //mysql_select_db('onlinecakedelivery');
			echo "registered successfully";
			//Reset the session if already exists
			if(!isset($_SESSION)){
				session_start();
			}
			$this->updateSession();
			$redirectpage=$this->redirectBrowser($this->getUserType());
			$this->loadPage($redirectpage);
			
		}else{
			echo "Error occured, please retry.";
			
		}
		}
	}
	$registrationObject = new Registration();
	$registrationObject->includeHeader();

	if(isset($_POST["submit"])){
		

		$registrationObject->setFormDetails($_POST);
		
		$registrationObject->executeInsertQuery();
        
	}
	?>

	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>";>
		
		<table id="registration">

			<tr>
				<td>Name:</td>
				<td> <input type="text" name="uname" required="required" maxlength="12" placeholder="Name (Max 12chars)" title="name cannot be more than 12 characters"></td>
			</tr>


			<tr><td>Email:</td>
				<td> <input type="email" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}" placeholder="Ex:jhon@gmail.com" name="email"></td></tr>
				<tr>
					<td>Address:</td>
					<td><textarea rows="4" maxlen="200" name="address" placeholder="Apt, StreetName, State, Zip" cols="20"></textarea></td>
				</tr>
				<tr><td>Password:</td> 
					<td><input type="password" name="pwd" pattern="(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-_]).{6,12}" required="required" min="6" max="12" placeholder="Password(min 6 max 12)" title="Password should be min 6 max 12 characters, with a capital, a small, a special character" ></td>
				</tr>  

				<tr><td>Cell Number:</td>
					<td> <input type="text" name="mobile" pattern="\d{10}" placeholder="Ex:9407459409" min="10" required="required" title="should be 10 digits" ></td>
				</tr>  
				<tr><td>User Type:</td>
					<td><select name="type">
						<option value="customer">Customer</option>
						<option value="deliverer">Deliverer</option>
					</select></td>
				</tr>

				<tr>
					<td><input type="submit" id="submit" name="submit" value="Submit"></td>
					<td><input type="reset" id="reset" name="reset" value="Reset">
					</tr>
				</table>
			</form>
			<?php $registrationObject->includeFooter(); ?>
		</body>
		</html>