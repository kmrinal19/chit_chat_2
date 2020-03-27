<?php
    require("connection.php");
    session_start();
    $sid=$_SESSION['sid'];
    $uid=$_SESSION['id'];
    $user_log_query="SELECT id,username,max(update_time) AS update_time FROM mrinal_users INNER JOIN mrinal_session ON mrinal_users.id=mrinal_session.user_id  WHERE id!=$uid GROUP BY username;";
    $user_log=$conn->query($user_log_query);
    $current_time_query="select now() as curr_time;";
    $current_time_result=$conn->query($current_time_query);
    $time_now=$current_time_result->fetch_assoc();
    $date_own=strtotime($time_now['curr_time']);
    while($info=$user_log->fetch_assoc()){
        $date=strtotime($info['update_time']);
        $diff = abs($date_own-$date);
        if($diff<15)
            $o_uname=$info['username'];
            $o_uid=$info['id'];
            $user_info_query="SELECT display_pic FROM mrinal_user_info WHERE user_id=$o_uid;";
            $user_info_result=$conn->query($user_info_query);
            $dp=($user_info_result->fetch_assoc())['display_pic'];
            echo"<div class='online_people'>
                    <div class='online_image_container'>
                        <img class='online_people_image' src='images/$dp'/>
                        <div class='online_people_name' onclick='openchatbox(\"$o_uname\")'>$o_uname</div>
                    </div>
                    <div class='green_circle'></div>
                </div>";
        }
?>
