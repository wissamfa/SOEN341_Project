
<?php

// allow us to connect to the database
$con = mysqli_connect("localhost","root","","social_network") or die("Connection was not established");

// get the post id and store it in a variable
if(isset($_GET['post_id'])){
    $post_id = $_GET['post_id'];

    // access the database and delete the
    $delete_post = "DELETE from posts where post_id ='$post_id'";
    $run_delete = mysqli_query($con, $delete_post);

    if($run_delete){
        echo "<script>alert('The post has been deleted!!')</script>";
        echo "<script>window.open('../home.php','_self')</script>";
    }else{
        echo "<script>alert('ERROR!!')</script>";
        echo "<script>window.open('../home.php','_self')</script>";
    }

}

?>
