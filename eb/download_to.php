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
	header("Content-disposition: attachment; filename=receivedchits.txt");
	header("Content-type: text/plain");
$stmt=$conn->prepare("select u.country,m.message,m.sent_at,m.id,m.eb from ".$_SESSION["council"]."_msg m, ".$_SESSION["council"]."_users u where m.recipient= :usr and m.frm=u.username order by sent_at desc ",array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
$stmt->bindValue(':usr',"eb");
$stmt->execute();
echo "Received messages:". PHP_EOL;
while($row=$stmt->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT))
{
	$dt=new DateTime($row["sent_at"]);
	echo "From:".$row["country"]."At:".$dt->format("M j g:i A")." Chit number :".$row["id"].PHP_EOL;
	echo $row["message"];
	echo PHP_EOL ."----------------------".PHP_EOL;
}
}
catch(PDOException $e)
{
	echo $e->getMessage();
}
?>