<?php
//Authenticate the admin
include_once('../helpers.php');
session_start();

if($_POST["uname"]=="admin" && $_POST["pwd"]=="ssnMUN")
{
	$_SESSION["admin"]=true;
	header("Location: home.php");
	exit();
}
else{
	header("Location: /chits/denied.php");
	exit();
}
?>