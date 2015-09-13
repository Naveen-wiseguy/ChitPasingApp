<?php
//Logging out a user
session_start();

if(!$_SESSION["ip"])
{
	header("Location: ../denied.php");
	exit();
}

$_SESSION["ip"]=false;
$_SESSION["council"]=null;

header("Location: index.php");
exit();
?>
