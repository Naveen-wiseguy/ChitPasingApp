<?php
//delegate home page
include_once 'helpers.php';

session_start();
if(!$_SESSION["loggedin"])
{
	header("Location: denied.php");
	exit();
}
headers("Welcome-chit passing");
?>

<h1>Welcome to the Chit passing system home ! </h1>
<a href="logout.php">Logout</a><br/>
<?php

echo "Welcome delegate of ".$_SESSION["country"] ."<br/>";
echo "Chits in council :" . $_SESSION["council"]."<br/>";
?>
<a href="gsl.php" target="_blank">View GSL </a> <br/>
<a href="sent.php" target="_blank">View sent chits</a> <br/>
Received messages: <br/>
<div id="messages" >

</div>

<div id="send">
To : <select name="dest" id="dest">
	<?php printCountryList($_SESSION["council"],$_SESSION["country"]); ?>
</select>
<input type="checkbox" id="EB" value="EB"/> Via EB
<br/>
<textarea name="message" id="text"></textarea><button type="submit" onclick="process()" >Send</button>

</div>


<script type="text/javascript">
var isreply=false;
var chitno=0;
setInterval(function(){
	var req=new XMLHttpRequest();
	req.open("GET","retrieved.php",true);
	req.onreadystatechange=function()
	{
		if(req.readyState==4)
			document.getElementById("messages").innerHTML=req.responseText;
	};
	req.send();
},5000
);

function process()
{
	//alert("TESTing");
	var req=new XMLHttpRequest();
	req.open("POST","send.php",true);
	req.onreadystatechange=function()
	{
		if(req.readyState==4 && req.status==200){
			document.getElementById("text").value="";
			isreply=false;
			chitno=0;
			document.getElementById("EB").disabled=false;
			document.getElementById("dest").disabled=false;
		}
		else if(req.readyState==4)
			alert(req.responseText);
		//else
			//alert(req.responseText);
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
	if(document.getElementById("EB").checked)
		params+="&EB=true";
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.send(params);
}

//Method to be called in order to reply to a chit
function reply(chit,from,eb)
{
	isreply=true;
	document.getElementById("dest").value=from;
	chitno=chit;
	
	document.getElementById("dest").disabled=true;
	if(eb)
	{
		document.getElementById("EB").checked=true;
		document.getElementById("EB").disabled=true;
	}
}
</script>
<?php
footers();
?>