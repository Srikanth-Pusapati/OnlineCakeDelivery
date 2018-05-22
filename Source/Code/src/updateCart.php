<?php

if(isset($_POST['cakeID']) && isset($_POST['userId']) && isset($_POST['quantity']) && isset($_POST['totalCost']) ){

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
	echo "Connected to db";
	$uid=$_POST['userId'];
	$cId=$_POST['cakeID'];
	$quantity=$_POST['quantity'];
	$totalCost=$_POST['totalCost'];

	$sqlst="UPDATE `cart` SET `quantity`=?,`totalprice`=? WHERE `userid`=? AND `cakeid`=?";
	$sql=$con->prepare($sqlst);

	if($sql->bind_param("idii",$quantity,$totalCost,$uid,$cId)){
		$status=$sql->execute();
		echo "Success";
		if($status===false){
			echo "<p>Execution error</p>";

		}

	}

// }elseif(isset($_POST['userI'])){
// 	$serverName = "localhost";
// 	$dbUserName = "UntShoppers";
// 	$dbUserPassword = "Untklu2018$";
// 	$dataBaseName = "onlinecakedelivery";
// 	$cId;
// 	$costItm;
// 	$quantity=1;
// 		//echo $cake;
// 	$con = new mysqli ( $serverName ,$dbUserName , $dbUserPassword , $dataBaseName );
// 	// Check connection
// 	if ($con->connect_error) {
// 		die ( "Connection failed: " . $con->connect_error );
// 	}         
// 	echo "Connected to db";
// 	$uid=$_POST['userId'];


// 	$sqls="SELECT `cakeid` FROM `cart` WHERE `userid`=?";
// 	$sqlstm="SELECT `cost_item` FROM `cake_details` WHERE `cakeid`=?";
// 	$sqlst="UPDATE `cart` SET `quantity`=?,`totalprice`=? WHERE `userid`=? AND `cakeid`=?";

// 	if($sqlm =$con->prepare($sqls)){
// 		// Bind the appropriate values that have to be inserted into db
// 		$sqlm->bind_param('i', $uid);
// 		$sqlm->execute();
// 		$sqlm->bind_result( $cakeId);
// 		while ($sqlm->fetch()) {
// 			$cId=$cakeId;
// echo "Got cake ID";
// 			if($sqla=$con->prepare($sqlstm)){
// 				$sqla->bind_param('i',$cId);
// 				$sqla->execute();
// 				$sqla->bind_result($costItem);
// 				while($sqla->fetch()){
// 					echo "Got default Cake price";
// 					$costItm=$costItem;

// 					$sql=$con->prepare($sqlst);

// 					if($sql->bind_param("idii",$quantity,$costItm,$uid,$cId)){
// 						echo "Updated cart";
// 						$status=$sql->execute();
// 						echo "Success";
// 						if($status===false){
// 							echo "<p>Execution error</p>";

// 						}

// 					}

// 				}
// 			}
// 		}

// 	}
}
	?>

