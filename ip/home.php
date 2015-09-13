<?php

include_once '../helpers.php';

session_start();
if(!$_SESSION["ip"])
{
	header("Location: ../denied.php");
	exit();
}
headers("Welcome-chit passing EB");
?>
<h1>Welcome IP</h1>
<a href="logout.php">Logout</a><br/>
<?php
	echo "Chits from council :".$_SESSION["council"];
	
?>
	
<div id="messages">
	
</div>
	
<script type="text/javascript">
setInterval(getMsgs,20000);
function getMsgs()
{
	var req=new XMLHttpRequest();
	req.open("GET","retrieved.php",true);
	req.onreadystatechange=function()
	{
		if(req.readyState==4)
			document.getElementById("messages").innerHTML=req.responseText;
	};
	req.send();
}

getMsgs();
</script>