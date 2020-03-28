<?php
    require_once("connection.php");
    session_start();
    $uid=$_SESSION['id'];
    $uname_1=$_SESSION['name'];
    $targetDir = 'images/'.$uname_1.'_';
    $fileName = test_input(basename($_FILES["dp_file"]["name"]));
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
    if(isset($_POST["dp_upload"]) && !empty($_FILES["dp_file"]["name"])){
        $allowTypes = array('jpg','png','jpeg','gif','svg');
        if(in_array($fileType, $allowTypes)){
            if(move_uploaded_file($_FILES["dp_file"]["tmp_name"], $targetFilePath)){
                $upload_query="UPDATE mrinal_user_info SET display_pic='$fileName' WHERE user_id=$uid;";
                $upload_result=$conn->query($upload_query);
                if($upload_result){
                    header("location:user.php");
                }
                else{
                    echo"<script>alert('something went wrong..');
                    location='user.php';</script>";
                }
            }
            else{
                echo"<script>alert('Image upload failed..');
                location='user.php';</script>";
            }
        }
        else{
            echo"<script>alert('Invalid image type..');
            location='user.php';</script>";
        }
    }
    else{
        echo"<script>alert('Please select a valid image..');
        location='user.php';</script>";
    }
?>
