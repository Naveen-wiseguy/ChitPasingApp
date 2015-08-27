<?php
//AJAX target of creating the users. It uses DOB and name to genrate the username and password and adds to database
include_once('../helpers.php');
session_start();
$conn=connect();
if(!$_SESSION["admin"])
{
	header("HTTP/1.1 403 Forbidden");
	exit();
}
$council = $_POST["council"];
$name= $_POST["name"];
$country= $_POST["country"];
$dt=new DateTime($_POST["dob"]);
$username=$name.$dt->format("dm");
$password=$dt->format("dmY");
try{
	$stmt=$conn->prepare("insert into ".$council."_countries values(:country)");
	$stmt->bindParam(':country',$country);
	$stmt->execute();
	$stmt=$conn->prepare("insert into ".$council."_users(username,password,country) values(:username,:password,:country)");
	$stmt->bindParam(':country',$country);
	$stmt->bindParam(':username',$username);
	$stmt->bindParam(':password',$password);
	$stmt->execute();
	echo "OK";
}
catch(PDOException $e)
{
	echo $e->getMessage();
}

?>