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
<?php 
echo "Council :".$_SESSION["council"];
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

function process()
{
	//alert("TESTing");
	var req=new XMLHttpRequest();
	req.open("POST","send.php",true);
	req.onreadystatechange=function()
	{
		if(req.readyState==4 && req.status==200)
			document.getElementById("text").value="";
		else if(req.readyState==4)
			alert(req.responseText);
		else
			alert(req.responseText);
	};
	var params="dest="+encodeURI(document.getElementById("dest").value)+"&message="+encodeURI(document.getElementById("text").value);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.send(params);
}
</script>
<?php
footers();
?>