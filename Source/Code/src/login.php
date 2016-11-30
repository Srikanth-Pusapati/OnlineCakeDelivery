<!DOCTYPE html>
<html>
<head>
	<title>Login User</title>
	<link rel="stylesheet" type="text/css" href="css/login_style.css"/>

</head>

<body>

	<?php include 'utils.php'; ?>

	<?php
		/**
		* 
		*/
		class Login extends Utils
		{

			private $userEmail;
			private $password;
			public $error=''; 
            // redirects according to the user
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
			public function setUserEmail($userEmail){
				$this->userEmail = $userEmail;
			}
			public function setPassword($password){
				$this->password = $password;
			}
			public function getUserEmail(){
				return $this->userEmail;
			}
			public function getPassword(){
				return $this->password;
			}
			/**
			*Function called to verify the login credentials that are entered.
			*
			*
			*
			*
			**/
			function checkIfUserSessionExists(){
				if((isset($_SESSION["userEmail"]) && (isset($_SESSION["userID"])) && (isset($_SESSION["userType"])))){
					echo"User session already exists";
					$redirectpage = $this->redirectBrowser($_SESSION["userType"]);	
					$this->loadPage($redirectpage);

				}
			}
            // retrieve the table details of respective users
			function getTableName($userType){

				if($userType == 'admin'){
					$table="login_admin";
				}else if($userType =='customer'){
					$table = "login_customer";
				}else if($userType == 'deliverer'){
					$table = "login_deliverer";
				}
				return $table;
			}
            // retrieving the login details 
			function setUserLoginDetails($userEmail,$userPassword){
						$this->setUserEmail($userEmail);
						$this->setPassword($userPassword);
						}
			// function for checking the logng details
			function checkLoginDetails(){

				// Variable To Store Error Message	
				
			//Check if submit is clicked.
				if (isset($_POST['submit'])) {
				//checking if data entered is empty or not.
					if (empty($_POST['userEmail']) || empty($_POST['userPassword'])) {
						$this->error = "user Email or Password are empty.";
					
					}
					else
					{
						//
						$con= $this->connectToDatabase();

						$userType=$_POST['userType'];
						$table=$this->getTableName($userType);
						$this-> setUserLoginDetails($_POST['userEmail'],$_POST['userPassword']);
						
// SQL query to fetch information of registerd users and finds user match.
						$sql = ("SELECT email,password, userid FROM ".$table." WHERE email ='".$this->getUserEmail()."'");

						$result = $con->query( $sql);
						if ($result->num_rows > 0) 
						{
							while($row = $result->fetch_assoc())
							{
								$dbUserEmail=$row['email'];
								$dbPassword=$row['password'];
								$userId=$row['userid'];

								if($this->getUserEmail() == $dbUserEmail && $this->getPassword()== $dbPassword)
								{
									$_SESSION['userEmail']=$this->getUserEmail();
									$_SESSION['userID'] = $userId;
									$_SESSION['userType'] = $userType;
									/* Redirect browser */
									$redirectedpage = $this->redirectBrowser($userType);
									$this->loadPage($redirectedpage);
									
								} else {
									$this->error= "Invalid username or password!";

								}
							}
						}else {
							$this->error= "User Email or Password NOT valid, please Re-check.";
													

						}


					}
				}
			}
		}


		$loginObject =new Login();
		$loginObject->includeHeader();

		//if(isset($_SESSION))
			$loginObject->checkIfUserSessionExists();
		//else{
			$loginObject->checkLoginDetails();	
		//}

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
		<tr><td colspan="2" style="color: red;"><?php if($loginObject->error !==""){ echo "* ".$loginObject->error ;}  ?></td></tr>
		<tr><td>
			<input type="submit" value="login" name="submit" id="login_button"/>
		</td>
	</tr>
</table>	
</form>


<?php $loginObject->includeFooter(); ?>
</body>
</html>
