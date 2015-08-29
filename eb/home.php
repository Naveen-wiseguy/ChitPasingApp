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

footers();
?>