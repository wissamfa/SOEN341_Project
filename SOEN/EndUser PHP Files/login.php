<?php


session_start();



include("includes/connection.php");

    // check the information of the user in the database when the login button is clicked 
	if (isset($_POST['login'])) {

		$email = htmlentities(mysqli_real_escape_string($con, $_POST['email']));
		$pass = htmlentities(mysqli_real_escape_string($con, $_POST['pass']));

		$select_user = "SELECT * from users where user_email='$email' AND user_pass='$pass' AND status='verified'";
        $query= mysqli_query($con, $select_user);

        // this checks all the usernames and emails in the database one by one. It also checks if the account is verified
		$check_user = mysqli_num_rows($query);

        // if the username and email is found in the database, log them in and take them to the home page
		if($check_user == 1){
			$_SESSION['user_email'] = $email;

			echo "<script>window.open('home.php', '_self')</script>";
		}else{
            // if username and email werent found, tell the user to try again
			echo"<script>alert('Your Email or Password is incorrect')</script>";
		}
	}
?>