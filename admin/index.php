<?php
//Admin authentication page
 include_once('../helpers.php');
 
 headers("Chit passing system - admin login");
 echo "<h1>Login Admin</h1>";
 $conn=connect();
//if($conn == null)
//	echo "Unable to connect";
//else
//	echo "Connection established";
?><form method="POST" action="auth.php">
Username:<input type="text" name="uname" /><br/>
Password:<input type="password" name="pwd" /><br/>

<input type="submit" />
</form>
<?php
 footers();
 ?>