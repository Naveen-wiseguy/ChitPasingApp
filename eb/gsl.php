<?php
//EB GSL page
include_once '../helpers.php';

session_start();
if(!$_SESSION["eb"])
{
	header("Location: ../denied.php");
	exit();
}
headers("Welcome-chit passing");
?>

<h1>Welcome to the Chit passing system home ! </h1>

<?php

echo "Welcome EB !<br/>";
echo "GSL in council :" . $_SESSION["council"]."<br/>";
?>

<div id="speakers" >

</div>
<div id="status">

</div>
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

function removeFromGSL(id)
{
	var req=new XMLHttpRequest();
	req.open("POST","removefromgsl.php",true);
	req.onreadystatechange=function()
	{
		if(req.readyState==4){
			getGSL();
			document.getElementById("status").innerHTML=req.responseText;
		}
	};
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.send("id="+id);
}

setInterval(getGSL,7000);
getGSL();

</script>