<?php
//Authentication of EB
include_once "../helpers.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
	$council=$_POST["council"];
	$pwd=$_POST["pwd"];
	$conn=connect();
	if($conn==null)
	{
		header("Location: denied.php");
		exit();
	}
	try{
	$stmt=$conn->prepare("SELECT * from eb_cred where council=:council");
	$stmt->bindParam(':council',$council);
	$stmt->execute();
	$result=$stmt->fetch(PDO::FETCH_ASSOC);
	if($result["password"]==$pwd){
		session_start();
		$_SESSION["eb"]=true;
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
