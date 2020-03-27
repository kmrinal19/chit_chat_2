<?php
    require("connection.php");
    session_start();
    $sid=$_SESSION['sid'];
    $del_ses_query="delete from mrinal_session where session_id='$sid';";
    $del_ses_result=$conn->query($del_ses_query);
    $_SESSION=array();
    if(isset($_COOKIE["session_id"])){
        setcookie("session_id", "",time()-42000);
    }
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-42000, '/');
	}
    session_destroy();
    header("location:index.php");
    ?>
