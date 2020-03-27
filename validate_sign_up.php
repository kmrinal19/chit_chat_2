<?php
    require("connection.php");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $uname=test_input($_POST['up_uname']);
        $email=test_input($_POST['email']);
        $phone=test_input($_POST['phone']);
        $gender=test_input($_POST['gender']);
        $up_password=password_hash(test_input($_POST['up_password']),PASSWORD_DEFAULT);
        if($uname=="" || $email=="" || $phone=="" || $gender=="" || $up_password==""){
            echo"<script>alert('something went wrong');
                location.href='index.php';</script>";
        }
        else{
            $insert_query="INSERT INTO mrinal_users (username,password) VALUES ('$uname','$up_password');";
            $query_result=$conn->query($insert_query);
            if($query_result){
                $get_id_query="SELECT id FROM mrinal_users WHERE username='$uname';";
                $get_id_result=$conn->query($get_id_query);
                $get_id_array=$get_id_result->fetch_assoc();
                $id=$get_id_array['id'];
                $insert_info_query="INSERT INTO mrinal_user_info (user_id,email,phone,gender) VALUES ($id,'$email','$phone','$gender');";
                $insert_info_result=$conn->query($insert_info_query);
                session_start();
                $sid=session_id();
                $_SESSION['id']=$id;
                $_SESSION['name']=$uname;
                $_SESSION['sid']=$sid;
                $session_update_query="INSERT INTO mrinal_session VALUES ('$sid','$id',NOW(),DATE_ADD(NOW(),INTERVAL 15 MINUTE));";
                $session_update_result=$conn->query($session_update_query);
                $_SESSION['remember']='false';
                header("location:user.php");
            }
            else{
                echo"<script>alert('something went wrong');
                location.href='index.php';</script>";
            }
        }
    }
?>
