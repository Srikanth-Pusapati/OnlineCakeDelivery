<?php
include "utils.php";
// feedback class for storing the feedback
class feedback extends Utils{

	private $uiRating;
	private $cakeAvailable;
	private $suggestMessage;
	private $worthRating;
	private $comment;
      // function to load 
	function __construct($content){
		$this->loadContent($content);
	}
	 
	function loadContent($content){
		//variable UI_rating is initialized to data given from the form feild 
		$this->uiRating = $content['UI_rating'];
		//variable cake_available is initialized to data given from the form feild 
		$this->cakeAvailable = $content['cake_available'];
		//variable suggest is initialized to data given from the form feild 
		$this->suggestMessage = $content['suggest'];
		//variable worth is initialized to data given from the form feild 
		$this->worthRating = $content['worth'];
		//variable comment is initialized to data given from the form feild 
		$this->comment = $content['comment'];
	}
		//saving the feedback in the database
	function uploadFeedback(){
		$conn = $this->connectToDatabase();

		//Execute sql query to insert feedback data into database
		$sql = $conn->prepare("INSERT INTO feedback (UI_rating,cake_available,suggest,worth,comment) VALUES
			(?,?,?,?,?)");
		$sql->bind_param("sssss",$this->uiRating, $this->cakeAvailable, $this->suggestMessage, $this->worthRating, $this->comment);
		if($sql->execute()){
		//results are stored 
			echo " feedback inserted";
			$this->loadPage("success.php");
		}else {
			echo "feedback not inserted";
		}
	}
}

// connection object is obtained.
$feedbackObject=new feedback($_POST);
$feedbackObject->uploadFeedback();




?>