<?php
//EB downlading chits sent to EB
include_once "../helpers.php";
$conn=connect();
session_start();
if(!$_SESSION["eb"])
{
	header("Location: /chits/denied.php");
	exit();
}
try{
	header("Content-disposition: attachment; filename=chitsviaeb.txt");
	header("Content-type: text/plain");
	$stmt=$conn->prepare("select u1.country as 'To',u2.country as 'From',m.message,m.sent_at,m.id,m.eb from ".$_SESSION["council"]."_msg m, ".$_SESSION["council"]."_users u1,".$_SESSION["council"]."_users u2 where m.recipient=u1.username and m.frm=u2.username and m.eb=1 order by sent_at desc ",array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
$stmt->execute();
while($row=$stmt->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT))
{
	$dt=new DateTime($row["sent_at"]);
	echo "From : ".$row["From"]." To : ".$row["To"]." At:".$dt->format("M j g:i A")." Chit number :".$row["id"].PHP_EOL;
	echo $row["message"].PHP_EOL;
	echo "---------------".PHP_EOL;
}
}
catch(PDOException $e)
{
	echo $e->getMessage();
}
?>