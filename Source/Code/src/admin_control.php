<!Doctype html>
<html>
	<head>
		<title>Online Cake Delivery</title>
		<link rel="stylesheet" type="text/css" href="css/admin_cake_update.css">
		</head>

		<body>
			<?php include"header.php"?>
			<div>
				<h2 style="text-align: center;">Welcome Admin!</h2> <!-- TODO: UPDATE ADMIN NAME FROM SESSION -->
			</div>
			
			<?php
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "onlinecakedelivery";

// Create connection
$conn = new mysqli ( $servername, $db_username, $db_password, $dbname );
// Check connection
if ($conn->connect_error) {
	die ( "Connection failed: " . $conn->connect_error );
}
?>
			<?php
$image_upload_error="";
if (isset ( $_POST ["submit"] )) {
	if(!empty($_POST["cakeName"] ) ||!empty($_POST["cakePrice"]) ||!empty($_FILES["fileToUpload"])){
	$target_dir = "img/";
	$target_file = $target_dir . basename ( $_FILES ["fileToUpload"] ["name"] );
	$uploadOk = 0;
	$imageFileType = pathinfo ( $target_file, PATHINFO_EXTENSION );
	// Check if image file is a actual image or fake image
	$check = getimagesize ( $_FILES ["fileToUpload"] ["tmp_name"] );
	if ($check !== false) {
		// Check if file already exists
		if (file_exists ( $target_file )) {
			$image_upload_error= "Sorry, file already exists.";
			$uploadOk = 0;
		} elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
			 $image_upload_error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		} else {
			//$image_upload_error = "File is an image - " . $check ["mime"] . ".";
			$uploadOk = 1;
		}
	} else {
		$image_upload_error = "File is not an image.";
		$uploadOk = 0;
	}
	$cakeName = $_POST["cakeName"];
	$cakeDetails =  $_POST["cakeDetails"];
	$cakeIngrediants= $_POST["cakeIngrediants"];
	$cakePrice = $_POST["cakePrice"];
	// Execute sql query to insert image data into database
	$stmt = $conn->prepare ( "INSERT INTO `cake_details`(`cake_name`,
				`cake_details`, `cake_ingrediants`, `cost_item`, `cake_image_path`)
		VALUES (?,?,?,?,?);");
	// Bind the appropriate values that have to be inserted into db
	$stmt->bind_param ( "sssds", $cakeName, $cakeDetails, $cakeIngrediants, $cakePrice, $cakeImagePath );
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		$image_upload_error = "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
	} else {
		
		if (move_uploaded_file ( $_FILES ["fileToUpload"] ["tmp_name"], $target_file )) {
			echo "The file " . basename ( $_FILES ["fileToUpload"] ["name"] ) . " has been uploaded.";
			$cakeImagePath = basename ( $target_file );
			$stmt->execute ();
			if(isset($_SESSION["userType"])){
			$redirectpage = redirectBrowser();
			header($redirectpage);
			exit();
			}
			$conn->close ();
		} else {
			$image_upload_error = "Sorry, there was an error uploading your file.";
		}
	}
}else{
	$image_upload_error ="has error please check.";
}
}

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
			<form method="post"
		action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
		enctype="multipart/form-data">
					<table>
						<tr>
							<td>Cake Name:</td><td>	<input type="text" name="cakeName" id="cakeName" required /></td>
						</tr>
						<tr>
							<td>Cake Details:</td><td><input type="text" name="cakeDetails" id="cakeDetails" /></td>
						</tr>
						<tr>
							<td>Cake Ingrediants:</td><td><input type="text" name="cakeIngrediants" id="cakeIngrediants" /></td>
						</tr>
						<tr>
							<td>Cake Price:</td><td><input type="text" name="cakePrice" id="cakePrice" required /></td>
						</tr>
						<tr>
							<td>Select image to upload:</td><td>	<input type="file" name="fileToUpload" id="fileToUpload"/>
								<span class="error">* <?php echo $image_upload_error;?></span>
							</td>
						</tr>
						<tr>
							<td><input type="submit" value="Upload Image" name="submit" id="upload_button" />
							</td>
						</tr>
					</table>
				</form>

				<?php include"footer.php"?>
			</body>
		</html>