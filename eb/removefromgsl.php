<?php
//AJAX target of adding a user to the GSL
include_once('../helpers.php');
session_start();
$conn=connect();
if(!$_SESSION["eb"])
{
	header("Location: /chits/denied.php");
	exit();
}
$council = $_SESSION["council"];
$id= $_POST["id"];
try{
	$stmt=$conn->prepare("delete from ".$council."_gsl where id=:id");
	$stmt->bindParam(':id',$id);
	$stmt->execute();
	echo "Successfully removed !";
}
catch(PDOException $e)
{
	echo $e->getMessage();
}

?>