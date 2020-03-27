<?php
    require_once("connection.php");
    session_start();
    if(isset($_SESSION['id'])){
        $uid=$_SESSION['id'];
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $bio=test_input($_POST['bio_text']);
            if(!empty($bio)){
                $bio_query="UPDATE mrinal_user_info SET bio='$bio' WHERE user_id='$uid';";
                $query_result=$conn->query($bio_query);
                if($query_result){
                    echo"<script>alert('Bio. added successfully');
                    location='user.php';</script>";
                }
                else{
                    echo"<script>alert('Invalid image type..');
                    location='user.php';</script>";
                }
            }
        }
        else{
            echo"<script>alert('Invalid image type..');
            location='user.php';</script>";
        }
    }
    else{
        echo"<script>alert('Invalid image type..');
        location='index.php';</script>";
    }
?>
