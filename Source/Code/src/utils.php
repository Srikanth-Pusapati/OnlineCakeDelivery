
<?php

/**
* Utils class which contains functions like include header, footer and connect to database. 
*/
class Utils
{
	private $serverName = "localhost";
	private $dbUserName = "UntShoppers";
	private $dbUserPassword = "Untklu2018$";
	private $dataBaseName = "onlinecakedelivery";
	private $con;

	function loadPage($page){
		header("location:".$page);
		exit();
	}
	function includeHeader(){
		include "header.php";
	}

	function includeFooter(){
		include "footer.php";
	}

	/**
	* 
	* @return con- connection object.
	*/
	function connectToDatabase(){	
	// Create connection
		$this->con = new mysqli ( $this->serverName ,$this->dbUserName , $this->dbUserPassword , $this->dataBaseName );
	// Check connection
		if ($this->con->connect_error) {
			die ( "Connection failed: " . $this->con->connect_error );
		}         

		return $this->con;
	}
	// 	function getCartCount(){
	// 	$con=$this->connectToDatabase();
	// 	$sql="SELECT COUNT(*) FROM `cart`";
		
	// }

	function closeConnection(){
		$this->con->close();
	}
	
}

?>


