<?php
//Home page of the admin
include_once '../helpers.php';

session_start();
if(!$_SESSION["admin"])
{
	header("Location: ../denied.php");
	exit();
}
headers("Welcome-chit passing Admin");
?>
<h1>Welcome admin</h1>

<a href="logout.php">Logout</a><br/>
<div id="send">
Select council <br/>
<select name="council" id="council">
<option value="disec">UNGA-DISEC</option>
<option value="sc">Security Council</option>
<option value="hrc">HRC</option>
<option value="eu">European Union</option>
<option value="iaea">IAEA</option>
</select><br/>
First Name: <input type="text" id="name" /> <br/>
Country: <input type="text" id="country" /><br/>
MUN ID: <input type="text" id="munid" /><br/>
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
			document.getElementById("munid").value="";
			alert(req.responseText);
			getUsers();
		}
		else if(req.readyState==4)
			alert(req.responseText);
	};
	var params="name="+encodeURI(document.getElementById("name").value)+"&country="+encodeURI(document.getElementById("country").value)+"&munid="+encodeURI(document.getElementById("munid").value)+"&council="+encodeURI(document.getElementById("council").value);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.send(params);
}

getUsers();
</script>
<?php
footers();
?>