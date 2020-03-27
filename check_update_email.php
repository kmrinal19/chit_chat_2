<?php
    require_once("connection.php");
    session_start();
    if(isset($_SESSION['id'])){
        $uid=$_SESSION['id'];
        if(isset($_GET['email'])){
            $email=$_GET['email'];
            $query_check_email="SELECT user_id FROM mrinal_user_info WHERE email='$email' AND user_id!=$uid;";
            $query_result=$conn->query($query_check_email);
            if(($query_result->num_rows)>0){
                echo "true";
            }
            else
                echo"false";
        }
        else
            echo"false";
    }
    else
        echo"false";
?>
