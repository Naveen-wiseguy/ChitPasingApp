<?php
//AJAX target of creating the users. It uses DOB and name to genrate the username and password and adds to database
include_once('../helpers.php');
session_start();
$conn=connect();
if(!$_SESSION["admin"])
{
	header("Location: ../denied.php");
	exit();
}
$council = $_POST["council"];
$name= $_POST["name"];
$country= $_POST["country"];
$munid=$_POST["munid"];
$username=$munid;
$password=strrev($name);
try{
	$stmt=$conn->prepare("insert into ".$council."_countries values(:country)");
	$stmt->bindParam(':country',$country);
	$stmt->execute();
	$stmt=$conn->prepare("insert into ".$council."_users(username,password,country) values(:username,:password,:country)");
	$stmt->bindParam(':country',$country);
	$stmt->bindParam(':username',$country);
	$stmt->bindParam(':password',$munid);
	$stmt->execute();
	echo "OK";
}
catch(PDOException $e)
{
	echo "Duplicate entry. Kindly recheck !";
}

?>