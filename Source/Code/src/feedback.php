<!DOCTYPE html>
<html>
<head>
  <title>feedback</title>
  <link href="css/feedback_styles.css" rel="stylesheet">
</head>
<body>
   
  <?php include 'utils.php';
  $utilsObject = new Utils();
  $utilsObject->includeHeader();
  ?>


  <script>
    //validating the form for required fields
    function validform() {
      var rating = document.querySelector('input[id = "UI_rating"]:checked');
      var  cake_availability= document.querySelector('input[id = "cake_available"]:checked');
      var  suggest= document.querySelector('input[id = "suggest"]:checked');
      var   worth= document.querySelector('input[id = "worth"]:checked');
      var comment = document.getElementById("comment").value;
      //checking if the fields are null
      if (rating==null || cake_availability==null || suggest==null || worth==null)
      {
         alert("Please complete the feedback");  
         event.preventDefault();      
      }else {

        document.getElementById("feedbackForm").action = "feedback_script.php";   
      }
    }</script>
    <div id="feedback_id">
    <form method="post" id="feedbackForm" name="feedbackForm"  onsubmit="validform()" >

       <div>
         <label> 1) <strong>Is the UI comfortable?</strong></label><br>
         <input type="radio" name="UI_rating" id="UI_rating" value="excellent" > excellent<br>
         <input type="radio" name="UI_rating" id="UI_rating" value="good" > good<br>
         <input type="radio" name="UI_rating" id="UI_rating" value="average"> average<br>
       </div>
       <div>
        <label> 2) Did you find the cake of your wish? </label> <br>
        <input type="radio" name="cake_available" id="cake_available" value="yes" > yes<br>
        <input type="radio" name="cake_available" id="cake_available" value="no"> no<br>
      </div>
      <div>
        <label>  3)would you like to suggest Online cake delivery to your friends? </label> <br>
        <input type="radio" name="suggest" id="suggest" value="yes" > yes<br>
        <input type="radio" name="suggest" id="suggest" value="no">no<br>
      </div>
      <div>
        <label> 4)Is it worth visiting our site </label> <br>
        <input type="radio" name="worth" id="worth" value="yes"> yes<br>
        <input type="radio" name="worth" id="worth" value="no"> no<br>
      </div>
      <div>
       <label> 5)Any suggestions? </label> <br>
       <textarea name="comment" id="comment" cols="40" ></textarea><br>
     </div>
     <div>
      <input type="submit" class="aa-browse-btn" name="submit" value="Submit"> 
    </div>
  </form>
</div>
<?php $utilsObject->includeFooter(); ?>
<script type="text/javascript">
console.log(count++);
  var count=0;
  console.log("reinitialized count"+count);
</script>
</body>
</html>

