<!DOCTYPE html>
<html>
<head>
	<title>Admin User</title>
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
include 'utils.php';

class AdminFeatures extends Utils{

// variable for showcasing any error if produced during uploading the image.
	private $imageUploadError="";
	private $cakeName;
	private $cakeDetails;
	private $cakeIngredients;
	private $cakePrice;
	private $cakeImagePath;
	private $successMessage;
	private $uiRating;
	private $cakeAvailability;
	private $suggestions;
	private $worth;
	private $comments;
	private $feedbackCounter = 1;


	public function setUIRating($uiRating){
		$this->uiRating = $uiRating;
	}

	public function getUIRating(){
		return $this->uiRating;
	}
	public function setCakeAvailability($cakeAvailability){
		$this->cakeAvailability = $cakeAvailability;
	}
	public function getCakeAvailability(){
		return $this->cakeAvailability;
	}
	public function setCakeImagePath($cakeImagePath){
		$this->cakeImagePath = $cakeImagePath;
	}
	public function getCakeImagePath(){
		return $this->cakeImagePath;
	}
	public function setSuggestions($suggestions){
		$this->suggestions = $suggestions;
	}
	public function getSuggestions(){
		return $this->suggestions;
	}
	public function setWorth($worth){
		$this->worth = $worth;
	}
	public function getWorth(){
		return $this->worth;
	}
	public function setComments($comments){
		$this->comments = $comments;
	}
	public function getComments(){
		return $this->comments;
	}
	public function setSuccessMessage($successMessage){
		$this->successMessage = $successMessage;
	}

	public function getSuccessMessage(){
		return $this->successMessage;
	}
	public function setCakeName($cakeName){
		$this->cakeName=$cakeName;
	}
	public function getCakeName(){
		return $this->cakeName;
	}

	public function setCakeDetails($cakeDetails){
		$this->cakeDetails=$cakeDetails;
	}
	public function getCakeDetails(){
		return $this->cakeDetails;
	}
	public function setCakeIngredients($cakeIngredients){
		$this->cakeIngredients=$cakeIngredients;
	}
	public function getCakeIngredients(){
		return $this->cakeIngredients;
	}
	public function setCakePrice($cakePrice){
		$this->cakePrice=$cakePrice;
	}
	public function getcakePrice(){
		return $this->cakePrice;
	}

	public function setImageUploadError($imageUploadError){
		$this->imageUploadError=$imageUploadError;
	}
	public function getImageUploadError(){
		return $this->imageUploadError;
	}

	function uploadCake($adminCakeDetails){
	//check if cake name or cake price and the cake image is empty, proceed only if the fields are non-empty.
		if(!empty($adminCakeDetails["cakeName"] ) ||!empty($adminCakeDetails["cakePrice"]) ||!empty($_FILES["fileToUpload"])){
	//declaring the target_directory, initialized as 'img'; as img/ is the folder for all the images to be stored.
			$target_dir = "img/cakes/";
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
					$this->setImageUploadError("Sorry, file already exists.");
					$uploadOk = 0;
				} elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
					$this->setImageUploadError("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
					$uploadOk = 0;
				} else {
			//$imageUploadError = "File is an image - " . $check ["mime"] . ".";
					$uploadOk = 1;
				}
			} else {
				$this->setImageUploadError("File is not an image.");
				$uploadOk = 0;
			}
			$this->updateCakeFormDetails($adminCakeDetails);
			

			$conn = $this->connectToDatabase();

	// Execute sql query to insert image data into database
			$stmt = $conn->prepare ( "INSERT INTO `cake_details`(`cake_name`,
				`cake_details`, `cake_ingredients`, `cost_item`, `cake_image_path`)
				VALUES (?,?,?,?,?);");
	// Bind the appropriate values that have to be inserted into db
			$stmt->bind_param ( "sssds", $this->cakeName, $this->cakeDetails, $this->cakeIngredients, $this->cakePrice, $this->cakeImagePath );
	// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				$this->setImageUploadError("Sorry, your file was not uploaded.");
		// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file ( $_FILES ["fileToUpload"] ["tmp_name"], $target_file )) {
					$this->setCakeImagePath( basename ( $target_file ));
					if($stmt->execute()){
						$this->setSuccessMessage("Sucessfully uploaded the cake.");
					}
				} else {
					$this->setImageUploadError("Sorry, there was an error uploading your file.");
				}
			}
			$conn->close();
		}else{
			$this->setImageUploadError(" Image upload has error please check.");
			$conn->close();
		}
	}
	function updateCakeFormDetails($adminCakeDetails){
		$this->setCakeName($adminCakeDetails["cakeName"]);
		$this->setCakeDetails($adminCakeDetails["cakeDetails"]);
		$this->setCakeIngredients($adminCakeDetails["cakeIngredients"]);
		$this->setCakePrice($adminCakeDetails["cakePrice"]);
	}

	function getFeedback(){
		$con = $this->connectToDatabase();
		$sql = "SELECT `UI_rating`, `cake_available`, `suggest`, `worth`, `comment` FROM `feedback`";
		$result = $con->query( $sql);
		if($result->num_rows>0){
			while($row = $result->fetch_assoc())
			{
				$this -> setUIRating($row["UI_rating"]);
				$this -> setCakeAvailability($row["cake_available"]);
				$this -> setSuggestions($row["suggest"]);
				$this -> setWorth($row["worth"]);
				$this -> setComments($row["comment"]);

				$this->printResults();
			}
		}
	}

	function printResults(){
		
		echo "<table id=\"feedbackId\">
		<tbody>
			<th>";echo "Feedback ".$this->feedbackCounter++; echo "</th>
			<tr>
				<td><label>UI Rating</label></td>
				<td>"; if(!($this->getUIRating() =="" )) {
					echo (ucwords($this->getUIRating()));
				}else{
					echo "No review Available";
				}
				echo "
			</td>
		</tr>
		<tr>
			<td><label>Cake Available</label></td>
			<td>";
				if(!($this->getCakeAvailability() =="" )) {
					echo (ucwords($this->getCakeAvailability()));
				}else{
					echo "No review Available";
				} 
				echo "</td>
			</tr>
			<tr>
				<td><label>Suggestions</label></td>
				<td>";
					if(!($this->getSuggestions() =="" )) {
						echo (ucwords($this->getSuggestions()));
					}else{
						echo "No review Available";
					} echo "</td>
				</tr>
				<tr>
					<td><label>Site Worth</label></td>
					<td>";
						if(!($this->getWorth() =="" )) {
							echo (ucwords($this->getWorth()));
						}else{
							echo "No review Available";
						} echo "</td>
					</tr>
					<tr>
						<td><label>User Comments</label></td>
						<td>";  if(!($this->getComments() =="" )) {
							echo (ucwords($this->getComments()));
						}else{
							echo "No review Available";
						} echo "</td>
					</tr>
				</tbody>
			</table>";
		}
		public function getStatus(){
			if($this->getImageUploadError !=""){ 
				echo $this->getImageUploadError(); 
			}else{
				echo $this->getSuccessMessage();
			}
		}
	}

	?>
	<body>
		<?php

		$utilsObject=new Utils();
		$utilsObject->includeHeader(); 
		$adminFeaturesObject = new  AdminFeatures();
		if(isset($_POST["submit"])){
			$adminFeaturesObject->uploadCake($_POST);
		}
		?>
		<section id="content">
			<ul id="tabs">
				<a href ="#totab1" >
					<li id="litotab1">Upload Cake</li>
				</a>
				<a href ="#totab2">
					<li id="litotab2">Check Feedback</li>
				</a>
			</ul>

			<div id="totab1">

				<form method="post"
				action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
				enctype="multipart/form-data">
				<table>
					<tbody id="adminUpdate">
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
							<div class="errorMessage" max-width="360px" >*<?php
								if(isset($_POST["submit"]))
									$adminFeaturesObject->getStatus();
								
								?></div>
							</td>
						</tr>
						<tr>
							<td><input type="submit" value="Upload Image" name="submit" id="upload_button" />
							</td>
						</tr>
					</tbody>
				</table>
			</form>



		</div>

		<div id="totab2">
			<?php 
			$adminFeaturesObject->getFeedback();

			?>

		</div>

	</section>



	<?php $utilsObject->includeFooter(); ?>

</body>
</html>
