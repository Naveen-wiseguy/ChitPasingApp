<?php
//AJAX target of adding a user to the GSL
include_once('helpers.php');
session_start();
$conn=connect();
if(!$_SESSION["loggedin"])
{
	header("Location: /chits/denied.php");
	exit();
}
$council = $_SESSION["council"];
$country= $_SESSION["country"];
try{
	$stmt=$conn->prepare("insert into ".$council."_gsl(country) values(:country)");
	$stmt->bindParam(':country',$country);
	$stmt->execute();
	echo "Successfully added !";
}
catch(PDOException $e)
{
	echo "Cannot add you to GSL";
}

?>