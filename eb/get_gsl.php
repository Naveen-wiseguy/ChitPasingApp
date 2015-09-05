<?php
include_once('../helpers.php');
$conn=connect();
session_start();
if(!$_SESSION["eb"])
{
	header("Location: /chits/denied.php");
	exit();
}
try{
$stmt=$conn->prepare("select * from ".$_SESSION["council"]."_gsl order by id",array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
$stmt->execute();


while($row=$stmt->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT))
{
	echo $row["country"];
	echo "<button onclick='removeFromGSL(".$row["id"].")'>Done</button>";
	echo "<hr/>";
}

}
catch(PDOException $e)
{
	echo $e->getMessage();
}
?>