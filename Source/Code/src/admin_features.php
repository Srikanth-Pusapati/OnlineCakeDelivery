<!DOCTYPE html>
<html>
<head>
	<title>Login User</title>
	<link rel="stylesheet" type="text/css" href="css/admin_cake_update.css">
	
	<style>
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" ></script>


	<script>
		$(document).ready(function(){

			$("#litotab1").addClass('selected');
			$("#litotab1").click(function(){
				$("#totab1").show();
				$("#totab2").hide();
				$("#litotab1").addClass('selected');
				$("#litotab2").removeClass('selected');
			});

			$("#litotab2").click(function(){

				$("#totab1").hide();
				$("#totab2").show();
				
				
				$("#litotab1").removeClass('selected');
				$("#litotab2").addClass('selected');
			});
			

		});
	</script>
</head>
<?php
/**
* function for "connect to database".
*
* @param servername string - name of the server which is default localhost.
* @param db_username string - database username, which is default root.
* @param db_password - database password, default is empty.
* @param db_name - database name, in this project it is 'onlinecakedelivery'.
* @returns conn - database connection object.
* This method tries to connect to database with the provided details and if there is a connection error,
*  it prints out the error 
**/			
function connectToDatabase($servername, $db_username, $db_password, $db_name){
	
// Create connection to the database.
	$conn = new mysqli ( $servername, $db_username, $db_password, $db_name );
// Check connection
	if ($conn->connect_error) {
		die ( "Connection failed: " . $conn->connect_error );
	}
//return the connection object.
	return $conn;
}
?>
<?php
// variable for showcasing any error if produced during uploading the image.
$imageUploadError="";
// check if the submit button of the form for uploading the cake details is clicked or not.
if (isset ( $_POST ["submit"] )) {
	//check if cake name or cake price and the cake image is empty, proceed only if the fields are non-empty.
	if(!empty($_POST["cakeName"] ) ||!empty($_POST["cakePrice"]) ||!empty($_FILES["fileToUpload"])){
	//declaring the target_directory, initialized as 'img'; as img/ is the folder for all the images to be stored.
		$target_dir = "img/";
	//declaring target_file and then initlizing it with the path of the image that is to be uploaded.
		$target_file = $target_dir . basename ( $_FILES ["fileToUpload"] ["name"] );
	//declaring a checking variable and initialized it to 0;
		$uploadOk = 0;
		$imageFileType = pathinfo ( $target_file, PATHINFO_EXTENSION );
		error_reporting(E_ERROR | E_PARSE);
	// Check if image file is a actual image or fake image
		if (getimagesize ( $_FILES ["fileToUpload"] ["tmp_name"] ) !== false) {
		// Check if file already exists
			if (file_exists ( $target_file )) {
			//if file exists updating imageUploadError with the respective error.
				$imageUploadError= "Sorry, file already exists.";
				$uploadOk = 0;
			} elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
				$imageUploadError = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			} else {
			//$imageUploadError = "File is an image - " . $check ["mime"] . ".";
				$uploadOk = 1;
			}
		} else {
			$imageUploadError = "File is not an image.";
			$uploadOk = 0;
		}
		$cakeName = $_POST["cakeName"];
		$cakeDetails =  $_POST["cakeDetails"];
		$cakeIngredients= $_POST["cakeIngredients"];
		$cakePrice = $_POST["cakePrice"];
		
		$conn = connectToDatabase("localhost", "root", "","onlinecakedelivery");
		
	// Execute sql query to insert image data into database
		$stmt = $conn->prepare ( "INSERT INTO `cake_details`(`cake_name`,
			`cake_details`, `cake_ingredients`, `cost_item`, `cake_image_path`)
			VALUES (?,?,?,?,?);");
	// Bind the appropriate values that have to be inserted into db
		$stmt->bind_param ( "sssds", $cakeName, $cakeDetails, $cakeIngredients, $cakePrice, $cakeImagePath );
	// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			$imageUploadError = "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			
			if (move_uploaded_file ( $_FILES ["fileToUpload"] ["tmp_name"], $target_file )) {
				echo "The file " . basename ( $_FILES ["fileToUpload"] ["name"] ) . " has been uploaded.";
				$cakeImagePath = basename ( $target_file );
				$stmt->execute ();
				if(isset($_SESSION["userType"])){
					echo "Sucessfully updated the cake.";
				}
			} else {
				$imageUploadError = "Sorry, there was an error uploading your file.";
			}
		}
		$conn->close();
	}else{
		$imageUploadError ="has error please check.";
		$conn->close();
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
<body>
	<?php include 'header.php' ?>
	<section id="content">
		<ul id="tabs">
			<a href ="#totab1" >
				<li id="litotab1">Upload Cake</li>
			</a>
			<a href ="#totab2">
				<li id="litotab2">Check Feedback</li>
			</a>
		</ul>

		<div id="totab1" >
			
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
					<td>Cake Ingredients:</td><td><input type="text" name="cakeIngredients" id="cakeIngredients" /></td>
				</tr>
				<tr>
					<td>Cake Price:</td><td><input type="text" name="cakePrice" id="cakePrice" required /></td>
				</tr>
				<tr>
					<td>Select image to upload:</td><td>	<input type="file" name="fileToUpload" id="fileToUpload"/>
					<span class="error" max-width="360px" >* <?php echo $imageUploadError;?></span>
				</td>
			</tr>
			<tr>
				<td><input type="submit" value="Upload Image" name="submit" id="upload_button" />
				</td>
			</tr>
		</table>
	</form>

	
	
</div>

<div id="totab2">
<?php 
	$conn = connectToDatabase("localhost", "root", "","onlinecakedelivery");
	
	?>
		
	</div>

</section>



<?php include'footer.php' ?>

</body>
</html>
