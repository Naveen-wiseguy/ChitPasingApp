<?php
include_once('../helpers.php');
$conn=connect();
session_start();
if(!$_SESSION["admin"])
{
	header("Location: ../denied.php");
	exit();
}
try{
$stmt=$conn->prepare("select * from ".$_GET["council"]."_users ",array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
$stmt->execute();
echo "<table border='2'>";
echo "<tr><th>Country</th><th>Username</th><th>Password</th></tr>";


while($row=$stmt->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT))
{
	echo "<tr>";
	echo "<td>".$row["country"]."</td> <td>".$row["username"]."<td>".$row["password"]."</td>";
	echo "</tr>";
}
echo "</table>";
}
catch(PDOException $e)
{
	echo $e->getMessage();
}
?>