


<!-- display the comment section on the picture chosen by the user -->
<?php 

    // get the id from the website.
    $get_id = $_GET['post_id'];

    // access the databasse using that id tp get all the comments 
    $get_com = "SELECT * from comments where post_id='$get_id' ORDER by 1 DESC";
    $run_com = mysqli_query($con, $get_com);


    while($row = mysqli_fetch_array($run_com)){

        $com = $row['comment'];
        $com_name = $row['comment_author'];
        $date = $row['date'];
        

        // show the name of the user and date at which he/she commented on your post 
        echo"
            <div class='row'>
                <div class='col-sm-6 col-md-offset-3'>
                    <div class='panel panel-info'>
                        <div class='panel-body'>
                            <div>
                                <h4><strong>$com_name </strong><i>commented</i> on $date</h4>
                                <p class='text-primary' style='font-size:16px;'>$com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>       
        ";
    }

?>
