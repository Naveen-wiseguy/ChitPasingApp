<?php

//delegate GSL page

include_once 'helpers.php';



session_start();

if(!$_SESSION["loggedin"])

{

	header("Location: /ChitPasingApp/denied.php");

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

		<h3>General Speakers List ! </h3>



		<?php



		echo "Welcome delegate of ".$_SESSION["country"] ."<br/>";

		echo "GSL in council :" . $_SESSION["council"]."<br/><br/>";

		?>



		<div id="speakers" >



		</div>

		<div id="status"></div>

		<button type="button" class="btn btn-info "onclick="addToGSL()"><span class="glyphicon glyphicon-plus"></span> Add to GSL</button>

		<script type="text/javascript">

		function getGSL(){

			var req=new XMLHttpRequest();

			req.open("GET","get_gsl.php",true);

			req.onreadystatechange=function()

			{

				if(req.readyState==4)

					document.getElementById("speakers").innerHTML=req.responseText;

		

			};

			req.send();

			document.getElementById("status").innerHTML="";

		}



		function addToGSL()

		{

			var req=new XMLHttpRequest();

			req.open("POST","addtogsl.php",true);

			req.onreadystatechange=function()

			{

				if(req.readyState==4){

					getGSL();

					document.getElementById("status").innerHTML=req.responseText;

				}

			};

			req.send();

		}



		setInterval(getGSL,7000);

		getGSL();



		</script>
	</div><!-- for second column -->
	<div class="col-md-2">
	</div>	
	</div><!-- for row -->
