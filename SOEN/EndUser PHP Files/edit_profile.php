<!DOCTYPE html>
<?php

session_start();

// allows us to access the variables we created in the header file 
include("includes/header.php");

?>
<?php 

    // allows us to directly go to the main page when we run our localhost 
    if(!isset($_SESSION['user_email'])){
        
        header("location: index.php");

    }

    else{ // else starts here
?>

<html>

    <head>
        <title>Edit Account Settings</title>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="style/home_style2.css">
    </head>

    <style>

    </style>

    <body>
        <div class="row">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-8">
                <form action="" method="post" enctype="multipart/form-data">
                    <table class="table table-bordered table-hover">
                        <!-- Every <tr> tag creates a row in the table -->
                        <tr align="center">
                            <td colspan="6" class="active"><h2>Edit Your Profile</h2></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Change Your First Name</td>
                            <td>
                                <!-- Allow the user to input a new first name ; This displays the previous first name  -->
                                <input class="form-control" type="text" name="f_name" required="required" value="<?php echo $first_name;?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Change Your Last Name</td>
                            <td>
                                <!-- Allow the user to input a new last name ; This displays the previous last name -->
                                <input class="form-control" type="text" name="l_name" required="required" value="<?php echo $last_name;?>"/>
                            </td>
                        </tr>

                        <tr>
                            <td style="font-weight: bold;">Change your Bio</td>
                            <td>
                                <!-- Allow the user to input a new BIO ; This displays the previous BIO -->
                                <input class="form-control" type="text" name="describe_user" required="required" value="<?php echo $describe_user;?>"/>
                            </td>
                        </tr>

                        <tr>
                            <td style="font-weight: bold;">Change your Relationship Status</td>
                            <td>
                                <!-- Allow the user to choose a new relationship status -->
                                <select class="form-control" name="Relationship">
                                    <!-- This displays the previous relationship status --> 
                                    <option><?php echo $Relationship_status;?></option>
                                    <option>Engaged</option>
                                    <option>Married</option>
                                    <option>Single</option>
                                    <option>In an Relationship</option>
                                    <option>Separated</option>
                                    <option>Divorced</option>
                                    <option>Widowed</option>
                                </select>
                            </td>
                        </tr>
                        
                        <tr>
                            <td style="font-weight: bold;">Change your Password</td>
                            <td>
                                <!-- Allow the user to input a new password ; This displays the previous password -->
                                <input class="form-control" type="password" name="u_pass" id="mypass" required="required" value="<?php echo $user_pass;?>"/>
                                <!-- Allow the user to see the password by clicking on the check box--> 
                                <input type="checkbox" onclick="show_password()"> <strong>Show Password</strong>
                            </td>
                        </tr>
                        
                        <tr>
                            <td style="font-weight: bold;">Change your Country</td>
                            <td>
                                <!-- Allow the user to input a new country -->
                                <select class="form-control" name="u_country">
                                    <!-- This displays the previous country -->
                                    <option><?php echo $user_country;?></option>
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
                            </td>
                        </tr>
                        
                        <tr>
                            <td style="font-weight: bold;"> Change your Gender</td>
                            <td>
                                <!-- Allow the user to input a new gender -->
                                <select class="form-control" name="u_gender">
                                    <!--  This displays the previous gender -->
                                    <option><?php echo $user_gender;?></option>
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Other</option>
                                </select>
                            </td>
                        </tr>
                        
                        <tr>
                            <td style="font-weight: bold;"> Change your date of Birth</td>
                            <td>
                                <!-- Allow the user to input a new date of birth ; This displays the previous date of birth -->
                                <input type="date" name="u_birthday" class="form-control input-md" value="<?php echo $user_birthday;?>" required="required" >
                            </td> 
                        </tr>
                        

            <!--------------------------------------------------------------------------- recovery option start ------------------------------------------------------------------------>

                        <!-- The user will answer one security question , if answered correctly, they will be able to change the password -->
                        <tr>
                            <td style="font-weight: bold;">Forgot Password</td>
                            <td>
                                
                                <!-- allow the user to activate the forgot password feature -->
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Turn On</button>

                                <!-- Modal => its like a popup that the user will get -->
                                <div id="myModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <!-- This is a close button if the user wants to close the model -->
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Modal Header</h4>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Allow the user to save an answer for the security question -->
                                                <form action="recovery.php?id=<?php echo $user_id;?>" method="post" id="f">
                                                    <strong>What is your mother's maiden name?</strong>
                                                    <textarea class="form-control" cols="83" rows="4" name="content" placeholder="Enter Name Here..."></textarea><br/>
                                                    <!-- Create the submit button -->
                                                    <input class="btn btn-default" type="submit" name="sub" value="Submit" style="width:100px;" /><br><br>
                                                    <pre>The above question will be asked as a security question if you forgot your <br>password.</pre>
                                                    <br><br>
                                                </form>


                                                <!-- update the "recovery_account" cell from the users table in the database ( for the recovery password )-->
                                                <?php

                                                    // if the submit button is clicked 
                                                    if(isset($_POST['sub'])){
                                                        // get the information from the text area 
                                                        $bfn = htmlentities($_POST['content']);

                                                        // if the text area is empty , display to the user to enter sth and refresh the page
                                                        if($bfn==''){
                                        
                                                            echo "<script>alert('Please Enter Something!')</script>";
                                                            echo "<script>window.open('edit_profile.php?u_id=$user_id','_self')</script>";
                                                            
                                                            exit();
                                                        
                                                        }
                                                        else {

                                                            // update the the recovery_account variable in the users table  
                                                            $update = "UPDATE users set recovery_account='$bfn' where user_id='$user_id'";
                                        
                                                            $run = mysqli_query($con,$update); 
                                                            
                                                            // if the variable was updated successfully
                                                            if($run){                                                          
                                                                echo "<script>alert('Successful !!!')</script>";
                                                                echo "<script>window.open('edit_profile.php?u_id=$user_id','_self')</script>";
                                                            }else{
                                                                echo "<script>alert('Error while Updating information...!')</script>";
                                                                echo "<script>window.open('recovery.php','_self')</script>";
                                                            }
                                                        }
                                                    }
                                                
                                                ?>

            <!---------------------------------------------------------------------------- recovery option ends here ------------------------------------------------------------------->

                                            </div>
                                            <div class="modal-footer">
                                                <!-- add a close button-->
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>                               
                        <tr align="center">
                            <td colspan="6">
                                <!-- add the update button-->
                                <input class="btn btn-info" style="width: 250px;" type="submit" name="update" value="Update"/>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <div class="col-sm-2">
            </div>
        </div>
    </body>
</html>
    
<!-- Update the rest of the information into the user's acount -->
<?php 
	if(isset($_POST['update'])){
	
        // get all the information from the textarea 
        $first_name = htmlentities($_POST['f_name']);
        $last_name = htmlentities($_POST['l_name']);
        $describe_user = htmlentities($_POST['describe_user']);
        $Relationship_status = htmlentities($_POST['Relationship']);
        $user_pass = htmlentities($_POST['u_pass']);
        $user_country = htmlentities($_POST['u_country']);
        $user_gender = htmlentities($_POST['u_gender']);
        $user_birthday = htmlentities($_POST['u_birthday']);
		
		
		$update = "UPDATE users set f_name='$first_name', l_name='$last_name',describe_user='$describe_user',Relationship='$Relationship_status', user_pass='$user_pass',user_country='$user_country',user_gender='$user_gender',user_birthday='$user_birthday' where user_id='$user_id'";
		
		$run = mysqli_query($con,$update); 
		
		if($run){
		
            echo "<script>alert('Your Profile Updated Successfully !!')</script>";
            echo "<script>window.open('home.php','_self')</script>";
		}else{
            echo "<script>alert('ERROR !! Your Profile was NOT updated !!')</script>";
        }
	
	}


?>
<?php } // else ends here?>


<script>

    // allow the user to see the password they are entering 
    function show_password() {

        var x = document.getElementById("mypass");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }      
    }

</script>