<?php

include_once '../helpers.php';

session_start();
if(!$_SESSION["eb"])
{
	header("Location: /chits/denied.php");
	exit();
}
headers("Welcome-chit passing EB");
?>
<h1>Welcome EB</h1>
<a href="logout.php">Logout</a><br/>
<a href="sent.php" target="_blank">View sent chits</a><br/>
<?php 
echo "Chits in council :" . $_SESSION["council"]."<br/>";
?>

<div id="toeb" >

</div>

<div id="viaeb">

</div>

<div id="send">
To : <select name="dest" id="dest">
	<?php printCountryList($_SESSION["council"],"EB"); ?>
</select>
<br/>
<textarea name="message" id="text"></textarea><button type="submit" onclick="process()" >Send</button>

</div>
<script type="text/javascript">
var isreply=false;
var chitno=0;
//Periodically refreshes the messages
setInterval(function(){
	var req=new XMLHttpRequest();
	req.open("GET","to_eb.php",true);
	req.onreadystatechange=function()
	{
		if(req.readyState==4)
			document.getElementById("toeb").innerHTML=req.responseText;
	};
	req.send();
	var req2=new XMLHttpRequest();
	req2.open("GET","via_eb.php",true);
	req2.onreadystatechange=function()
	{
		if(req2.readyState==4)
			document.getElementById("viaeb").innerHTML=req2.responseText;
	};
	req2.send();
},5000
);

//Makes the AJAX calls
function process()
{
	//alert("TESTing");
	var req=new XMLHttpRequest();
	req.open("POST","send.php",true);
	req.onreadystatechange=function()
	{
		if(req.readyState==4 && req.status==200){
			document.getElementById("text").value="";
			document.getElementById("dest").disabled=false;
		}
		else if(req.readyState==4)
			alert(req.responseText);
	};
	var msg;
	if(isreply)
	{
		msg="In reply to chit no "+chitno+"\n";
	}
	else
		msg="";
	msg+=document.getElementById("text").value;
	var params="dest="+encodeURI(document.getElementById("dest").value)+"&message="+msg;
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.send(params);
}

//Method to be called in order to reply to a chit
function reply(chit,from)
{
	isreply=true;
	document.getElementById("dest").value=from;
	chitno=chit;
	
	document.getElementById("dest").disabled=true;
}
</script>
<?php
footers();
?>