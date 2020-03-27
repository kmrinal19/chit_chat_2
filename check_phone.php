<?php
    require("connection.php");
    if(isset($_GET['phone'])){
        $phone=$_GET['phone'];
        $query_check_phone="SELECT user_id FROM mrinal_user_info WHERE phone='$phone';";
        $query_result=$conn->query($query_check_phone);
        if(($query_result->num_rows)>0){
            echo "true";
        }
        else
            echo"false";
    }
    else
        echo"false";
?>
