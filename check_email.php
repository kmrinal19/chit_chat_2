<?php
    require("connection.php");
    if(isset($_GET['email'])){
        $email=$_GET['email'];
        $query_check_email="SELECT user_id FROM mrinal_user_info WHERE email='$email';";
        $query_result=$conn->query($query_check_email);
        if(($query_result->num_rows)>0){
            echo "true";
        }
        else
            echo"false";
    }
    else
        echo"false";
?>
