<?php

if(isset($_POST['cakeID']) && isset($_POST['userId']) &&isset($_POST['cost_item'])){

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
	$uid=$_POST['userId'];
	$cId=$_POST['cakeID'];
	$cost_item=floatval($_POST['cost_item']);
	$sqlSt = "SELECT `cartid` FROM `cart` WHERE `cakeid`=? AND `userid`=?";
			//cursor variable for selecting the rows in the database.
	if($sql =$con->prepare($sqlSt)){
					// Bind the appropriate values that have to be inserted into db
		$sql->bind_param('ii', $cId,$uid);										//check if it executes
		$sql->execute();

		$sql->bind_result($cartid);
		if($sql->fetch()){
			echo "OK";
		}else{		
			$quan=1;
				$sqlst="INSERT INTO cart (userid, cakeid,quantity,totalprice) VALUES (?,?,?,?);";
				$sm=$con->prepare($sqlst);
				$sm->bind_param("iiid",$uid,$cId,$quan,$cost_item);
				$sm->execute();
				echo "IN";

			
		}
	}
}

?>