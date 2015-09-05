<?php
//AJAX call target to get the messages of the users
include_once('helpers.php');
$conn=connect();
session_start();
if(!$_SESSION["loggedin"])
{
	header("Location: denied.php");
	exit();
}
try{
$stmt=$conn->prepare("select u.country,m.message,m.sent_at,m.id,m.eb from ".$_SESSION["council"]."_msg m, ".$_SESSION["council"]."_users u where m.recipient= :usr and m.frm=u.username order by sent_at desc ",array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));
$stmt->bindParam(':usr',$_SESSION["user"]);
$stmt->execute();
while($row=$stmt->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT))
{
	$dt=new DateTime($row["sent_at"]);
	echo "<div class='msg'><span class=\"country\">".$row["country"]."</span> <span class=\"time\">".$dt->format("M j g:i A")."</span> Chit number :".$row["id"]."<br/>";
	echo "<span class=\"content\">".$row["message"]."</span></div>";
	if($row["eb"]==1)
		echo "Sent via eb";
	$click="reply(".$row["id"].",'".$row["country"]."',".$row["eb"].")";
	echo "<br/><button onclick=\"".$click."\">Reply</button>";
	echo "<hr/>";
}
}
catch(PDOException $e)
{
	echo $e->getMessage();
}
?>