<?php
    require("connection.php");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $uname=test_input($_POST['in_uname']);
        $in_password=test_input($_POST['in_password']);
        $check_query="SELECT * FROM mrinal_users WHERE username='$uname';";
        $check_query_result=$conn->query($check_query);
        if($check_query_result->num_rows==1){
            $check_query_array=$check_query_result->fetch_assoc();
            if(password_verify($in_password,$check_query_array['password'])){
                session_start();
                $sid=session_id();
                $uid=$check_query_array['id'];
                $_SESSION['id']=$uid;
                $_SESSION['name']=$uname;
                $_SESSION['sid']=$sid;
                if(isset($_POST['remember'])){
                    setcookie("session_id",$sid,time()+7776000);
                    $session_update_query="INSERT INTO mrinal_session VALUES ('$sid','$uid',NOW(),DATE_ADD(NOW(),INTERVAL 3 MONTH));";
                    $session_update_result=$conn->query($session_update_query);
                    $_SESSION['remember']='true';
                }
                else{
                    $session_update_query="INSERT INTO mrinal_session VALUES ('$sid','$uid',NOW(),DATE_ADD(NOW(),INTERVAL 15 MINUTE));";
                    $session_update_result=$conn->query($session_update_query);
                    $_SESSION['remember']='false';
                }
                header("location:home.php");
            }
            else{
                header("location:index.php?login_error=2");//error code 2 : invalid password
            }
        }
        else{
            header("location:index.php?login_error=1");//error code 1 : Invalid username
        }
    }
?>
