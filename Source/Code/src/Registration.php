<!DOCTYPE html>
 <html>
 <body>
 <?php include 'header.php';?>
 


 <form method="post" action="uregistration.php";>
 
<table align=center>
<tr>
<td>Name:</td>
<td> <input type="text" name="uname"><br/></td> </tr>


<tr><td>Email:</td>
<td> <input type="text" name="email"><br/> </td></tr>
<tr>
<td>address:</td>
<td><textarea rows="4" maxlen="200" name="address" cols="20"></textarea></td></tr>
<tr><td>Password:
</td> 
<td><input type="password" name="pwd"><br/></td></tr>  
  
<tr><td>cellNumber:</td>
<td> <input type="text" name="mobile"><span id="numloc"></span><br/></td></tr>  
<tr><td>user_type:</td>
<td><select name="usertype">
  <option value="admin">Admin</option>
  <option value="customer">Customer</option>
  <option value="deliverer">Deliverer</option>
</select></br><br/></td></tr>
        
<tr>
<td><br><input type="submit" name="submit" value="Submit"></td></tr></table>
</form>
 <?php include 'footer.php';?>
 </body>
 </html>


 