<!DOCTYPE html>
<html>
<head>
	<title>Sign-up</title>
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

    /* Style for signup button */
	#signup{
		width: 60%;
		border-radius: 30px;
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
                    <h3 style="text-align: center;"><strong>Join TheGram</strong></h3>
                    <hr>
                </div>
                <div class="l-part">
                    <form action="" method="post">

                        <!-- Ask for First Name -->
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                            <input type="text" class="form-control" placeholder="First Name" name="first_name" required="required">
                        </div><br>

                        <!-- Ask for Last Name -->
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                            <input type="text" class="form-control" placeholder="Last Name" name="last_name" required="required">
                        </div><br>

                        <!-- Ask for Password-->
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="password" type="password" class="form-control" placeholder="Password" name="u_pass" required="required">
                        </div><br>

                        <!-- Ask for Email -->
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="email" type="email" class="form-control" placeholder="Email" name="u_email" required="required">
                        </div><br>

                        <!-- Ask to pick a country from a drop-down -->
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-chevron-down"></i></span>
                            <select class="form-control" name="u_country" required="required">
                                <option disabled>Select your Country</option>
                                <option>Canada</option>
                                <option>United States</option>
                                <option>China</option>
                                <option>Japan</option>
                                <option>UK</option>
                                <option>France</option>
                                <option>Germany</option>
                                <option>Russia</option>
                                <option>Lebanon</option>
                                <option>Saudi Arabia</option>
                                <option>Egypt</option>
                            </select>
                        </div><br>

                        <!-- Ask for Gender from a dropdown-->
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-chevron-down"></i></span>
                            <select class="form-control input-md" name="u_gender" required="required">
                                <option disabled>Select your Gender</option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Other</option>
                            </select>
                        </div><br>

                        <!-- Ask for Date of Birth -->
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            <input type="date" class="form-control input-md" placeholder="Date Of Birth" name="u_birthday" required="required">
                        </div><br>

                        <!-- If user has account, take them to signin page -->            <!-- data-toggle => this will create a popup ; and the popup will contain the text of "signin"--> 
                        <a style="text-decoration: none; float: right; color: #187FAB;" data-toggle="tooltip" title="Signin" href="signin.php">Already have an account?</a><br><br>

                        <!-- Creating signup button -->
                        <center><button id="signup" class="btn btn-info btn-lg" name="sign_up">Register</button></center>

                        <!--  Puts the user's information on the database -->
                        <?php include("insert_user.php"); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>