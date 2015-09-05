<?php
//Logging out a user
session_start();

if(!$_SESSION["eb"])
{
	header("Location: /chits/denied.php");
	exit();
}

$_SESSION["eb"]=false;
$_SESSION["council"]=null;

header("Location: index.php");
exit();
?>
