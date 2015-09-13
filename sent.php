<?php

//Single page to get the messages sent by the users

include_once('helpers.php');

headers("Sent chits");

$conn=connect();

session_start();

if(!$_SESSION["loggedin"])

{

	header("Location: denied.php");

	exit();

}

?>

     <style>

	 body {

	background-image: url("images/un.jpg");

    	background-position: center top;

    	background-size: 100% auto;

        padding-top: 40px;

        padding-bottom: 40px;

        background-color: #f5f5f5;

      }
	.nav{
	    max-height: 500px;
	    overflow-y:scroll; 
	}


      </style>
<div class="row">
	<div class="col-md-2">
	</div>

	<div class="col-md-8 jumbotron container nav well well-lg">	

			<?php echo "Welcome delegate of ".$_SESSION["country"] ."<br/>";

			echo "Chits sent by you in council :" . $_SESSION["council"];

			echo "<div id=\"messages\" >";



			try{

			$stmt=$conn->prepare("select u.country,m.message,m.sent_at from ".$_SESSION["council"]."_msg m, ".$_SESSION["council"]."_users u where m.recipient= u.username and m.frm=:usr order by sent_at desc ",array(PDO::ATTR_CURSOR=>PDO::CURSOR_SCROLL));

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
	</div><!-- for second column -->
	<div class="col-md-2">
	</div>	
</div><!-- for row -->
