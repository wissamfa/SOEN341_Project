<!DOCTYPE html>
<html>
<head>
	<title>TheGram login and signup</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<style>

	/* remove the horizontal line scrolling of the page  */ 
	body{
		overflow-x: hidden; 
	}

	/* Style for 1st text on the left page */
	#centered1{
		position: absolute;
		font-size: 10vw;
		top: 30%;
		left: 30%;
		transform: translate(-50%, -50%);
	}

	/* Style for 2nd text on the left page */
	#centered2{
		position: absolute;
		font-size: 10vw;
		top: 50%;
		left: 40%;
		transform: translate(-50%, -50%);
	}

	/* Style for 3rd text on the left page */
	#centered3{
		position: absolute;
		font-size: 10vw;
		top: 70%;
		left: 30%;
		transform: translate(-50%, -50%);
	}

	/* Style for signup button */
	#signup{
		width: 60%;
		border-radius: 30px;
	}

	/* Style for login button */
	#login{
		width: 60%;
		background-color: #fff;
		border: 1px solid #1da1f2;
		color: #1da1f2;
		border-radius: 30px;
	}

	/* hover's login button when cursor is on top of it */
	#login:hover{
		width: 60%;
		background-color: #fff; /* white */
		color: #1da1f2;	/* light blue */
		border: 2px solid #1da1f2; /* light blue */
		border-radius: 30px;
	}

	/* Style for top side fo page */
	.well{
		background-color: #187FAB; /* blue */
	}

</style>
<body>
	<div class="row">
		<div class="col-sm-12">
			<div class="well">
				<center><h1 style="color: white;">TheGram</h1></center>
			</div>
		</div>
	</div>
	<div class="row">
		<!--left side of the front page-->
		<div class="col-sm-6" style="left:0.5%;"> 
			<img src="images/codingcafe.jpeg" class="img-rounded" title="Coding cafe" width="650px" height="565px">
			<!--&nbsp is a nonbreakable space => basically just a white space-->
			<div id="centered1" class="centered"><h3 style="color:white;"><span class="glyphicon glyphicon-search"></span>&nbsp&nbsp<strong>Follow Your Interests.</strong></h3></div>
			<div id="centered2" class="centered"><h3 style="color:white;"><span class="glyphicon glyphicon-search"></span>&nbsp&nbsp<strong>Hear what People are talking about.</strong></h3></div>
			<div id="centered3" class="centered"><h3 style="color:white;"><span class="glyphicon glyphicon-search"></span>&nbsp&nbsp<strong>Join the Conversation.</strong></h3></div>
		</div>
		<!--right side of the front page-->
		<div class="col-sm-6" style="left:8%;">
			<img src="images/TheGram.jpg" class="img-rounded" title="Coding cafe" width="80px" height="80px">
			<h2><strong>See what's happening in <br> the world right now</strong></h2><br><br>
			<h4><strong>Join TheGram Today.</strong></h4>
			<form method="post" action="">
				<!-- Register Button -->
				<button id="signup" class="btn btn-info btn-lg" name="signup">Sign up</button><br><br>
				<?php
					// if button is clicked, open the signup.php page
					if(isset($_POST['signup'])){
						echo "<script>window.open('signup.php','_self')</script>";
					}
				?>
				<!-- Login Button -->
				<button id="login" class="btn btn-info btn-lg" name="login">Login</button><br><br>
				<?php
					// if button is clicked, open the signup.php page
					if(isset($_POST['login'])){
						echo "<script>window.open('signin.php','_self')</script>";
					}
				?>
			</form>
		</div>
	</div>
</body>
</html>
