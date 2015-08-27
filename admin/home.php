<?php
//Home page of the admin
include_once '../helpers.php';

session_start();
if(!$_SESSION["admin"])
{
	header("Location: /chits/denied.php");
	exit();
}
headers("Welcome-chit passing Admin");
?>
<h1>Welcome admin</h1>


<div id="send">
Select council <br/>
<select name="council" id="council">
<option value="disec">UNGA-DISEC</option>
<option value="sc">Security Council</option>
</select><br/>
First Name: <input type="text" id="name" /> <br/>
Country: <input type="text" id="country" /><br/>
Date of Birth: <input type="date" id="dob" /><br/>
<button type="submit" onclick="process()" >Add</button>
</div>

<div id="users"></div>


<script type="text/javascript">
//dummy test funtion
function clicked()
{
	alert(document.getElementById("dob").value);
}

//Refresh the number of users
function getUsers(){
	var req=new XMLHttpRequest();
	req.open("GET","getusers.php?council="+encodeURI(document.getElementById("council").value),true);
	req.onreadystatechange=function()
	{
		if(req.readyState==4)
			document.getElementById("users").innerHTML=req.responseText;
	};
	req.send();
}

//Adding a user to the database by sending the details
function process()
{
	//alert("TESTing");
	var req=new XMLHttpRequest();
	req.open("POST","adduser.php",true);
	req.onreadystatechange=function()
	{
		if(req.readyState==4 && req.status==200){
			document.getElementById("name").value="";
			document.getElementById("country").value="";
			document.getElementById("dob").value="";
			alert(req.responseText);
			getUsers();
		}
		else if(req.readyState==4)
			alert(req.responseText);
	};
	var params="name="+encodeURI(document.getElementById("name").value)+"&country="+encodeURI(document.getElementById("country").value)+"&dob="+encodeURI(document.getElementById("dob").value)+"&council="+encodeURI(document.getElementById("council").value);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.send(params);
}

getUsers();
</script>
<?php
footers();
?>