<?php
//Landing page for eb asking for credentials
 include_once '../helpers.php';
 
 headers("Chit passing system ");
 echo "<h1>Welcome EB ! Login :</h1>";
 $conn=connect();
//if($conn == null)
//	echo "Unable to connect";
//else
//	echo "Connection established";
?><form method="POST" action="auth.php">
Council :<select name="council"><br/>
<option value="disec">UNGA-DISEC</option>
<option value="sc">Security Council</option>
<option value="hrc">HRC</option>
<option value="eu">European Union</option>
<option value="iaea">IAEA</option>
</select>
Password:<input type="password" name="pwd" />
<input type="submit" />
</form>
<?php
 footers();
 ?>