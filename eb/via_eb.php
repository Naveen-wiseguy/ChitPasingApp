<?php
//AJAX call target to get the messages sent to the EB
include_once('../helpers.php');
$conn=connect();
session_start();
if(!$_SESSION["eb"])
{
	header("Location: /chits/denied.php");
	exit();
}
try{
$stmt=$conn->prepare("select u1.country as 'To',u2.country as 'From',m.message,m.sent_at,m.id,m.eb from ".$_SESSION["council"]."_msg m, ".$_SESSION["council"]."_users u1,".$_SESSION["council"]."_users u2 where m.recipient=u1.username and m.frm=u2.username and m.eb=1 order by sent_at desc ",array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
$stmt->execute();
echo "<div class='title'>Sent via EB: </div>";
while($row=$stmt->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT))
{
	$dt=new DateTime($row["sent_at"]);
	echo "<div class='msg'><span class=\"country\">From : ".$row["From"]."</span> <span class=\"country\">To : ".$row["To"]."</span>  <span class=\"time\">".$dt->format("M j g:i A")."</span> Chit number :".$row["id"]."<br/>";
	echo "<span class=\"content\">".$row["message"]."</span></div>";
	echo "<hr/>";
}
}
catch(PDOException $e)
{
	echo $e->getMessage();
}
?>