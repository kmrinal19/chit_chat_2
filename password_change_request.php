<?php
    require_once("connection.php");
    session_start();
    if(isset($_SESSION['id'])){
        $uid=$_SESSION['id'];
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $curr_password=$_POST['current_password'];
            $new_password=$_POST['new_password'];
            $get_pass_query="SELECT password FROM mrinal_users WHERE id=$uid;";
            $get_pass_result=$conn->query($get_pass_query);
            $get_pass_value=($get_pass_result->fetch_assoc())['password'];
            if(password_verify($curr_password,$get_pass_value)){
                if(!empty($curr_password)){
                    $new_password_hash=password_hash($new_password,PASSWORD_DEFAULT);
                    $pass_update_query="UPDATE mrinal_users SET password='$new_password_hash' WHERE id=$uid;";
                    $pass_update_result=$conn->query($pass_update_query);
                    if($pass_update_result){
                        echo"<script>alert('Password update successful');
                        location.href='user.php';</script>";
                    }
                    else{
                        echo"<script>alert('something went wrong');
                        location.href='user.php';</script>";
                    }
                }
                else{
                    echo"<script>alert('New password too short');
                    location.href='user.php';</script>";
                }
            }
            else{
                echo"<script>alert('Current password didn\'t match');
                location.href='user.php';</script>";
            }
        }
        else{
            echo"<script>alert('something went wrong');
                location.href='user.php';</script>";
        }
    }
    else{
        echo"<script>alert('something went wrong');
                location.href='index.php';</script>";
    }
?>
