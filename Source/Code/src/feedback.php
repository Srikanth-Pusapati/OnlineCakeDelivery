<!DOCTYPE html>
<html>
<body>
<?php include 'header.php';?>


<script type="text/javascript">
function validform() {
  var rating = document.getElementById("UI_rating").value;
  var  cake_availability= document.getElementById("cake_available").value;
  var  suggest= document.getElementById("suggest").value;
  var   worth= document.getElementById("worth").value;
  var comment = document.getElementById("comment").value;
    
    if (rating==null || cake_availability ==null|| suggest==null||worth==null||comment==null)
    {
        alert("invalid");
	
      
    }
}</script>
<form action="feedback_script.php" method="post" onsubmit="validform()" >
1) <strong>Is the UI comfortable?</strong><br>
               <input type="radio" name="UI_rating" value="excellent" > excellent<br>
              <input type="radio" name="UI_rating" value="good" > good<br>
               <input type="radio" name="UI_rating" value="average"> average<br>
2) Did you find the cake of your wish?<br>
<input type="radio" name="cake_available" value="yes" > yes<br>
  <input type="radio" name="cake_available" value="no"> no<br>
3)would you like to suggest Online cake delivery to your friends?<br>
<input type="radio" name="suggest" value="yes" > yes<br>
  <input type="radio" name="suggest" value="no">no<br>
4)Is it worth visiting our site><br>
<input type="radio" name="worth" value="yes"> yes<br>
  <input type="radio" name="worth" value="no"> no<br>
5)Any suggestions?<br>
<textarea name="comment"></textarea><br>
<input type="submit" name="submit" value="Submit"> 



  
   
</form>
<?php include 'footer.php';?>
</body>
</html>

