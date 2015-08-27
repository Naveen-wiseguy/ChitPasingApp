<?php
//Sedns the messages to the user 
include_once('helpers.php');
session_start();
$conn=connect();
if(!$_SESSION["loggedin"])
{
	header("HTTP/1.1 403 Forbidden");
	exit();
}
$council=$_SESSION["council"];
$sender=$_SESSION["user"];
$country=$_POST["dest"];
$message=$_POST["message"];
try{
	$stmt=$conn->prepare("select username from ".$council."_users where country=:country");
	$stmt->bindParam(':country',$country);
	$stmt->execute();
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	$to=$row["username"];
	$stmt=$conn->prepare("insert into ".$council."_msg(frm,recipient,message) values(:sender,:recipient,:message)");
	$stmt->bindParam(':sender',$sender);
	$stmt->bindParam(':recipient',$to);
	$stmt->bindParam(':message',$message);
	$stmt->execute();
}
catch(PDOException $e)
{
	echo $e->getMessage();
}
?>