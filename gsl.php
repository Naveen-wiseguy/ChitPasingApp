<?php
//delegate GSL page
include_once 'helpers.php';

session_start();
if(!$_SESSION["loggedin"])
{
	header("Location: /chits/denied.php");
	exit();
}
headers("Welcome-chit passing");
?>

<h1>Welcome to the Chit passing system home ! </h1>

<?php

echo "Welcome delegate of ".$_SESSION["country"] ."<br/>";
echo "GSL in council :" . $_SESSION["council"]."<br/>";
?>

<div id="speakers" >

</div>
<div id="status"></div>
<button type="button" onclick="addToGSL()">Add to GSL</button>
<script type="text/javascript">
function getGSL(){
	var req=new XMLHttpRequest();
	req.open("GET","get_gsl.php",true);
	req.onreadystatechange=function()
	{
		if(req.readyState==4)
			document.getElementById("speakers").innerHTML=req.responseText;
		
	};
	req.send();
	document.getElementById("status").innerHTML="";
}

function addToGSL()
{
	var req=new XMLHttpRequest();
	req.open("POST","addtogsl.php",true);
	req.onreadystatechange=function()
	{
		if(req.readyState==4){
			getGSL();
			document.getElementById("status").innerHTML=req.responseText;
		}
	};
	req.send();
}

setInterval(getGSL,7000);
getGSL();

</script>