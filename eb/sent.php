<?php
//Single page to get the messages sent by the users
include_once('../helpers.php');
headers("Sent chits");
$conn=connect();
session_start();
if(!$_SESSION["eb"])
{
	header("Location: /chits/denied.php");
	exit();
}


echo "Welcome EB <br/>";
echo "Chits sent by you in council :" . $_SESSION["council"];
echo "<div id=\"messages\" >";

try{
$stmt=$conn->prepare("select u.country,m.message,m.sent_at from ".$_SESSION["council"]."_msg m, ".$_SESSION["council"]."_users u where m.recipient= u.username and m.frm='eb' order by sent_at desc ",array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
$stmt->bindParam(':usr',$_SESSION["user"]);
$stmt->execute();
while($row=$stmt->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT))
{
	$dt=new DateTime($row["sent_at"]);
	echo "<div class='msg'><span class=\"country\">".$row["country"]."</span> <span class=\"time\">".$dt->format("M j g:i A")."</span><br/>";
	echo "<span class=\"content\">".$row["message"]."</span></div>";
	echo "<hr/>";
}
}
catch(PDOException $e)
{
	echo $e->getMessage();
}
echo "</div>";
footers();
?>