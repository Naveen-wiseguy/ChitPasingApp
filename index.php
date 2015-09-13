<?php
//Landing page asking for credentials
 include_once 'helpers.php';
 
 headers("Chit passing system ");
 echo "<h1>Login</h1>";
 $conn=connect();
//if($conn == null)
//	echo "Unable to connect";
//else
//	echo "Connection established";
?><form method="POST" action="auth.php">
Username:<input type="text" name="uname" /><br/>
Password:<input type="password" name="pwd" /><br/>
Council :<select name="council">
<option value="disec">UNGA-DISEC</option>
<option value="sc">Security Council</option>
<option value="hrc">HRC</option>
<option value="eu">European Union</option>
<option value="iaea">IAEA</option>
</select>
<input type="submit" />
</form>
<?php
 footers();
 ?>