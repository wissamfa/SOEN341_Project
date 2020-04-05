<!DOCTYPE html>
<html>
<head>
	<title>Sign-in</title>
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

    /* Style for information asked from user */
	.main-content{
		width: 50%;
		height: 40%;
		margin: 10px auto;
		background-color: #fff;
		border: 2px solid #e6e6e6;
		padding: 40px 50px;
	}

    /* Style for header of the page*/
	.header{
		border: 0px solid #000;
		margin-bottom: 5px;
	}

    /* Style for top side fo page */
	.well{
		background-color: #187FAB;
	}

    /* Style for login button */
	#signin{
		width: 60%;
		border-radius: 30px;
	}

    /* Positions the "forgot password" inside the password box*/
	.overlap-text{
		position: relative;
	}

    /* Style for password box ( and the items around it ) */
	.overlap-text a{
		position: absolute;
		top: 8px;
		right: 10px;
		font-size: 14px;
		text-decoration: none;
		font-family: 'Overpass Mono', monospace;
		letter-spacing: -1px;

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
	<div class="col-sm-12">
		<div class="main-content">
			<div class="header">
				<h3 style="text-align: center;"><strong>Login to TheGram</strong></h3>
			</div>
			<div class="l-part">
				<form action="" method="post">
                    <!-- Ask for Email -->
					<input type="email" name="email" placeholder="Email" required="required" class="form-control input-md"><br>
					<div class="overlap-text">
                        <!-- Ask for Password -->
						<input type="password" name="pass" placeholder="Password" required="required" class="form-control input-md"><br>

                        <!-- If user forgot thier passowrd, take them to forgot password page --> 
						<a style="text-decoration:none;float: right;color: #187FAB;" data-toggle="tooltip" title="Reset Password" href="forgot_password.php">Forgot Passowrd ?</a>
					</div>

                    <!-- If user doesnt have an account, take them to registration page --> 
					<a style="text-decoration: none;float: right;color: #187FAB;" data-toggle="tooltip" title="Create Account!" href="signup.php">Don't have an account ?</a><br><br>

                    <!-- Creating login button -->
					<center><button id="signin" class="btn btn-info btn-lg" name="login">Login</button></center>

                    <!-- Checks the user's informations and logs them in -->
					<?php include("login.php"); ?>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>