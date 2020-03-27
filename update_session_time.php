<?php
    require("connection.php");
    session_start();
    $sid=$_SESSION['sid'];
    if($_SESSION['remember']=='true'){
        $ses_up_query_long="UPDATE mrinal_session SET update_time=NOW(),expiry_time= DATE_ADD(NOW(),INTERVAL 3 MONTH) WHERE session_id='$sid';";
        $ses_up_long = $conn->query($ses_up_query_long);
    }
    else{
        $ses_up_query_short="UPDATE mrinal_session SET update_time=NOW(),expiry_time= DATE_ADD(NOW(),INTERVAL 15 MINUTE) WHERE session_id='$sid';";
        $ses_up_short = $conn->query($ses_up_query_short);
    }
    $del_query="DELETE FROM mrinal_session WHERE expiry_time<NOW();";
    $del=$conn->query($del_query);
    echo'true';
?>
