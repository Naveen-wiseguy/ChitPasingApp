<?php
//Logging out a user
session_start();

if(!$_SESSION["loggedin"])
{
	header("Location: denied.php");
	exit();
}

$_SESSION["loggedin"]=false;
$_SESSION["user"]=null;
$_SESSION["council"]=null;
$_SESSION["country"]=null;

header("Location: index.php");
exit();
?>
