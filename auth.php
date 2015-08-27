<?php
//Authentication of delegates
include_once "helpers.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
	$table=$_POST["council"];
	$table=$table."_users";
	$name=$_POST["uname"];
	$pwd=$_POST["pwd"];
	$conn=connect();
	if($conn==null)
	{
		header("Location: denied.php");
		exit();
	}
	try{
	$stmt=$conn->prepare("SELECT * from ".$table." where username=:usr");
	$stmt->bindParam(':usr',$name);
	$stmt->execute();
	$result=$stmt->fetch(PDO::FETCH_ASSOC);
	if($result["password"]==$pwd){
		session_start();
		$_SESSION["loggedin"]=true;
		$_SESSION["user"]=$name;
		$_SESSION["country"]=$result["country"];
		$_SESSION["council"]=$_POST["council"];
		header("Location: home.php");
		exit();
	}
	else{
		header("Location: denied.php");
		exit();
	}
	}
	catch(PDOException $e)
	{
		headers("Error");
		echo "Error".$e->getMessage();
		footers();
	}
	
}
else{
	header("Location: denied.php");
	exit();
}
?>
