<?php

class removeItem{
	
	
	function removecake($cake,$user){
		$serverName = "localhost";
		$dbUserName = "UntShoppers";
		$dbUserPassword = "Untklu2018$";
		$dataBaseName = "onlinecakedelivery";
		//echo $cake;
		$con = new mysqli ( $serverName ,$dbUserName , $dbUserPassword , $dataBaseName );
	// Check connection
		if ($con->connect_error) {
			die ( "Connection failed: " . $con->connect_error );
		}         
		$sqlSt = "DELETE FROM `cart` WHERE `cakeid`=? AND `userid`=?";
		if($sql =$con->prepare($sqlSt)){
										// Bind the appropriate values that have to be removed into db
			$sql->bind_param('ii', $cake,$user);
										//check if it executes
			$sql->execute();
			$con->close();
			return "Success";
		}
		
	}

}

if(isset($_POST['cakeID']) && isset($_POST['userId']) ){
	$removeItemObj =new removeItem();
	$result =$removeItemObj->removecake($_POST['cakeID'],$_POST['userId']);
	echo $result;
}
?>