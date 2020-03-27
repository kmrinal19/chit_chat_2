<?php
    require_once("connection.php");
    session_start();
    if(isset($_SESSION['id'])){
        $uid=$_SESSION['id'];
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $name=test_input($_POST['name_info']);
            $email=test_input($_POST['email_info']);
            $phone=test_input($_POST['phone_info']);
            $bdate=$_POST['birthdate'];
            $bmonth=$_POST['birthmonth'];
            $byear=$_POST['birthyear'];
            $month_code=array('Jan'=>'1','Feb'=>'2','Mar'=>'3','Apr'=>'4','May'=>'5','Jun'=>'6','Jul'=>'7','Aug'=>'8','Sep'=>'9','Oct'=>'10','Nov'=>'11','Dec'=>'12');
            $birthday=$byear."-".$month_code[$bmonth]."-".$bdate;
            $gen=test_input($_POST['gender_info']);
            $gen_code=array('Male'=>'M','Female'=>'F','Others'=>'O');
            $gender=$gen_code[$gen];
            if((!empty($name))&&(!empty($email))&&(!empty($phone))&&(!empty($gender))){
                $update_query="UPDATE mrinal_user_info SET name='$name', email='$email',phone='$phone',birthday='$birthday',gender='$gender',info_status=1 WHERE user_id=$uid;";
                $query_result=$conn->query($update_query);
                if($query_result){
                    echo"<script>alert('Update Successful');
                location='user.php';</script>";
                }
                else{
                    echo"<script>alert('something went wrong');
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
                location.href='user.php';</script>";
        }
    }
    else{
        echo"<script>alert('something went wrong');
                location.href='index.php';</script>";
    }
?>
