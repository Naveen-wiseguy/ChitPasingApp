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

<?php

echo "Welcome delegate of ".$_SESSION["country"] ."<br/>";
echo "Chits in council :" . $_SESSION["council"];
?>
<div id="messages" >

</div>

<div id="send">
To : <select name="dest" id="dest">
	<?php printCountryList($_SESSION["council"],$_SESSION["country"]); ?>
</select>
<br/>
<textarea name="message" id="text"></textarea><button type="submit" onclick="process()" >Send</button>

</div>


<script type="text/javascript">
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
		if(req.readyState==4 && req.status==200)
			document.getElementById("text").value="";
		else if(req.readyState==4)
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