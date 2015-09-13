<?php

//delegate home page

include_once 'helpers.php';



session_start();

if(!$_SESSION["loggedin"])

{

	header("Location: denied.php");

	exit();

}

headers("Welcome-chit passing");

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

			<h3>Welcome to the Chit passing system home ! </h3>


			<?php



			echo "Welcome delegate of ".$_SESSION["country"] ."<br/>";

			echo "Chits in council :" . $_SESSION["council"]."<br/>";

			?>

			<a href="gsl.php" class="btn btn-info " target="_blank"><span class="glyphicon glyphicon-th-list"></span>  View GSL </a> 

			<a href="sent.php" class="btn btn-info " target="_blank"><span class="glyphicon glyphicon-eye-open"></span>  View sent chits</a> 
			<a href="logout.php" class="btn btn-info"><span class="glyphicon glyphicon-log-out"></span>  Logout</a><br/>
			
			<hr/><br/>



			<div id="send">

			To : <select name="dest" id="dest">

				<?php printCountryList($_SESSION["council"],$_SESSION["country"]); ?>

			</select>

			<input type="checkbox" id="EB" value="EB"/> Via EB

			<br/>

			<textarea name="message" id="text" rows="5" cols="50"></textarea><br/>
			<button class="btn btn-info" type="submit" onclick="process()" ><span class="glyphicon glyphicon-envelope"></span> Send</button>



			</div>

			Received messages: <br/>

			<div id="messages" >



			</div>







	<script type="text/javascript">

	var isreply=false;

	var chitno=0;

	setInterval(function(){

		var req=new XMLHttpRequest();

		req.open("GET","retrieved.php",true);

		req.onreadystatechange=function()

		{

			if(req.readyState==4)

				document.getElementById("messages").innerHTML=req.responseText;

		};

		req.send();

	},5000

	);



	function process()

	{

		//alert("TESTing");

		var req=new XMLHttpRequest();

		req.open("POST","send.php",true);

		req.onreadystatechange=function()

		{

			if(req.readyState==4 && req.status==200){

				document.getElementById("text").value="";

				isreply=false;

				chitno=0;

				document.getElementById("EB").disabled=false;

				document.getElementById("dest").disabled=false;

			}

			else if(req.readyState==4)

				alert(req.responseText);

			//else

				//alert(req.responseText);

		};

		var msg;

		if(isreply)

		{

			msg="In reply to chit no "+chitno+"\n";

		}

		else

			msg="";

		msg+=document.getElementById("text").value;

		var params="dest="+encodeURI(document.getElementById("dest").value)+"&message="+msg;

		if(document.getElementById("EB").checked)

			params+="&EB=true";

		req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		req.send(params);

	}



	//Method to be called in order to reply to a chit

	function reply(chit,from,eb)

	{

		isreply=true;

		document.getElementById("dest").value=from;

		chitno=chit;

	

		document.getElementById("dest").disabled=true;

		if(eb)

		{

			document.getElementById("EB").checked=true;

			document.getElementById("EB").disabled=true;

		}

	}

	</script>
	</div><!-- for second column -->
	<div class="col-md-2">
	</div>	
</div><!-- for row -->

<?php

footers();

?>
