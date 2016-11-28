<?php
// includes the header file
include "utils.php";
class customerStatus extends Utils
{
	private  $error;
		
	 function retrieveStatus()
	 {
		 $con= $this->connectToDatabase();
		 $userid=$_SESSION['userID'];
		 $sql = ("SELECT order_status FROM customer_order where userid=userid ");

						$result = $con->query( $sql);
						if ($result->num_rows > 0) 
						{
							while($row = $result->fetch_assoc())
							{
							  echo row[order_status];
							}
						}
						else {
							$this->error= "You did not order any cake";
													echo "*".$this->error;
						}
						
	 }
	function redirect()
	  {
		//redirect to feedback page when place order button is clicked
	  header("location: feedback.php");
      }
	  
}
			$obj=new customerStatus();
			$obj->includeHeader();
			$obj->retrieveStatus();
			//$obj->redirect();
			$obj->includeFooter();
			
?>


