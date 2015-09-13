<?php

//Landing page asking for credentials

 include_once 'helpers.php';

 

 headers("Chit passing system ");

 $conn=connect();

//if($conn == null)

//	echo "Unable to connect";

//else

//	echo "Connection established";

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

	

	.container{

        padding: 125px 29px 29px;

	}



      .form-signin {

        max-width: 300px;

        padding: 19px 29px 29px;

        margin: 0 auto 20px;

        background-color: #fff;

        border: 1px solid #e5e5e5;

        -webkit-border-radius: 5px;

           -moz-border-radius: 5px;

                border-radius: 5px;

        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);

           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);

                box-shadow: 0 1px 2px rgba(0,0,0,.05);

      }

      .form-signin .form-signin-heading,

      .form-signin .checkbox {

        margin-bottom: 10px;

      }

      .form-signin input[type="text"],

      .form-signin input[type="password"] {

        font-size: 16px;

        height: auto;

        margin-bottom: 15px;

        padding: 7px 9px;

      }

    .overlay {

    background-color:rgba(0,150,255, 0.4);

    position:absolute;

    top:0;

    left:0;

    right:0;

    bottom:0;

    width:100%;

    height:100%;

}



    </style>

<div class="container overlay">

<form method="POST" action="auth.php" class="form-signin">

 	<h2 class="form-signin-heading" align="center">Please sign in</h2>

	<input type="text" name="uname" class="form-control" placeholder="Country Name" required autofocus/>

	<input type="password" name="pwd" class="form-control" placeholder="Password" required/>

	Council :

	<select name="council">

		<option value="disec">UNGA-DISEC</option>

		<option value="sc">Security Council</option>

	</select>

	<br/><br/>

 <center><input type="submit" class="btn btn-info" value="Submit "/></center>

</form>

</div>





<?php

 footers();

 ?>
