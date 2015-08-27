<?php
function headers($title){
 echo "<!DOCTYPE html>";
 echo "<html>";
 echo "<head>";
 echo "<title>$title</title>";
 echo "<link rel=\"stylesheet\" href=\"http://localhost/chits/common.css\"></link>";
 echo "</head>";
 echo "<body>";
}


function footers(){
 echo "</body>";
 echo "</html>";
}

function connect($servername="localhost", $dbname="mun",$username="root",$password="")
{

 try{
 $conn=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
 $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 return $conn;
 }
 catch(PDOException $e)
 {
	 return null;
 }
}

function printCountryList($council,$country)
{
	$conn=connect();
	try{
	$stmt=$conn->prepare("select * from ".$council."_countries",array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
	$stmt->execute();
	while($row=$stmt->fetch(PDO::FETCH_ASSOC,PDO::FETCH_ORI_NEXT))
	{
		if($row["country"]==$country)
			continue;
		echo "<option value='".$row["country"]."'>".$row["country"]."</option>";
	}
	}
	catch(PDOException $ex)
	{
		return null;
	}
}
?>