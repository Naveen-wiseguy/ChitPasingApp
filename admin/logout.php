<?php
//Logging out a user
session_start();

if(!$_SESSION["admin"])
{
	header("Location: /chits/denied.php");
	exit();
}

$_SESSION["admin"]=false;

header("Location: index.php");
exit();
?>
