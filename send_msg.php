<?php
    require("connection.php");
    session_start();
    $my_id=$_SESSION['id'];
    $other_name=$_POST['chat_with'];
    $info_query="SELECT id FROM mrinal_users WHERE username='$other_name';";
    $info_res=$conn->query($info_query);
    $info_row=$info_res->fetch_assoc();
    $other_id=$info_row['id'];
    $content=$_POST["content"];
    $write_query="INSERT INTO mrinal_chats (from_id,to_id,content,sent_time) VALUES ($my_id,$other_id,'$content',NOW());";
    $write=$conn->query($write_query);
    echo "true";
?>
