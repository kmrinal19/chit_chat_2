<?php
    $other_name=$_GET['chatWith'];
    require("connection.php");
    session_start();
        $_SESSION['last_chat']=0;
    
    $my_id=$_SESSION['id'];
    $info_query="SELECT id,display_pic FROM mrinal_users INNER JOIN mrinal_user_info ON mrinal_users.id=mrinal_user_info.user_id WHERE username='$other_name';";
    $info_res=$conn->query($info_query);
    $info_row=$info_res->fetch_assoc();
    $other_id=$info_row['id'];
    $other_dp=$info_row['display_pic'];
    $msg_query="SELECT chat_id,from_id,to_id,content FROM mrinal_chats WHERE (from_id=$my_id AND to_id=$other_id) OR (from_id=$other_id AND to_id = $my_id) ORDER BY sent_time ASC;";
    $msg=$conn->query($msg_query);
    if($msg->num_rows>0){
        while($msg_a=$msg->fetch_assoc()){
            if($msg_a['from_id']==$my_id){
                echo'<div class="right_chat">'.$msg_a['content'].'</div>';
                $_SESSION['last_chat']=$msg_a['chat_id'];
            }
            else{
                echo'<img class="left_pic" src="images/'.$other_dp.'"/>
                    <div class="left_chat">'.$msg_a['content'].'</div>';
                $_SESSION['last_chat']=$msg_a['chat_id'];
            }
        }
    }
?>
