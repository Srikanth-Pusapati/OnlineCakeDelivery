<?php 
if (session_status() == PHP_SESSION_NONE) {

	session_name("OnlineCakeDelivery");
	session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login User</title>
	<link rel="stylesheet" type="text/css" href="css/login_style.css"/>

</head>

<body>

	<?php include 'utils.php'; 
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
			$this->password = sha1($password);
		}
		public function getUserEmail(){
			return $this->userEmail;
		}
		public function getPassword(){
			return $this->password;
		}
					/**
					*Function called to verify the login credentials that are entered.
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
					function getSelectQuery($table){
						return "SELECT `userid`, `password`, `email` FROM `".$table."` WHERE email=?";
					}
					// function for checking the logng details
					function checkLoginDetails(){
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
								$emailVal=$this->getUserEmail();
								if (!filter_var($emailVal, FILTER_VALIDATE_EMAIL)) {
									$this->error = "Invalid User name"; 

								}elseif(!preg_match("/^[a-zA-Z|0-9|@|$|_|-|+|!|#]*$/",$this->getPassword())) {
									$this->error = "Only letters, digits and special charaters are alowed</br> Invalid password"; 
								} else {
									if($sql =$con->prepare($this->getSelectQuery($table))){
										// Bind the appropriate values that have to be inserted into db
										$sql->bind_param("s", $emailVal);
										//check if it executes
										$sql->execute();
										$sql->bind_result($userId,$dbPassword,$dbUserEmail);										
										while($row = $sql->fetch())
										{									
											if($this->getUserEmail() == $dbUserEmail && $this->getPassword()== $dbPassword)
											{
												if (session_status() == PHP_SESSION_NONE) {
													session_name("OnlineCakeDelivery");
													session_start();

												}
												$_SESSION['userEmail']=$this->getUserEmail();
												$_SESSION['userID'] = $userId;
												$_SESSION['userType'] = $userType;
												if(!isset($_SESSION['timestamp'])){
													$now_time=time();
													$_SESSION['timestamp']=$now_time;
												}
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
				}
				$loginObject =new Login();
				$loginObject->includeHeader();

				$loginObject->checkIfUserSessionExists();
				$loginObject->checkLoginDetails();	

				?>

				<h2>Login</h2>
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="loginForm" id="login_form">

					<table>

						<tr>
							<td>UserEmail:</td><td>
								<input type="text" name="userEmail" placeholder="xyz@abc.com" required/>
							</td>
						</tr> 
						<tr>
							<td>UserPassword:</td><td>
								<input type="password" name="userPassword" placeholder="*******" required/></td>
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
							<tr><td colspan="2" style="color: red; text-align: center;"><?php if($loginObject->error !==""){ echo "* ".$loginObject->error ;}  ?></td></tr>
							<tr><td>
								<input type="submit" value="login" name="submit" id="login_button"/>
							</td>
						</tr>
					</table>	
				</form>


				<?php $loginObject->includeFooter(); ?>
			</body>
			</html>
