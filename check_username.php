<?php
    require("connection.php");
    if(isset($_GET['uname'])){
        $uname=$_GET['uname'];
        $query_check_user="select username from mrinal_users where username='$uname';";
        $query_result=$conn->query($query_check_user);
        if(($query_result->num_rows)>0){
            echo "true";
        }
        else
            echo"false";
    }
    else
        echo"false";
?>
