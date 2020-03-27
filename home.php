<?php 
    require_once("connection.php");
    session_start();
    if(!(isset($_SESSION['id']))){
        header("location:index.php");
    }
    else{
        $uid=$_SESSION['id'];
        $status_query="SELECT info_status FROM mrinal_user_info WHERE user_id=$uid;";
        $status_result=$conn->query($status_query);
        $status_value=($status_result->fetch_assoc())['info_status'];
        if($status_value==0){
            header("location:user.php");
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,700|Nunito+Sans:400,700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="chit_chat.css" rel="stylesheet"/>
    <link href="home.css" rel="stylesheet"/>
    </head>
    <body>
        <?php require("navbar_login.php");?>
        <div class="overlay" id="chat_overlay">
            <div class="chat_container">
                <div class="chat_head">
                    <div class="chat_head_name" id="chat_head_name"></div>
                    <button class="chat_close" id="chat_close" onclick="closechatbox()">X</button>
                </div>
                <div class="chat_wrapper">
                    <div class="chat" id="chat">
                    </div>
                    <div class="chat_input">
                        <textarea class="chat_text" rows="2" id="chat_text"placeholder="Type a message..."></textarea>
                        <button class="send_button" id="sendchat">Send</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="content_container">
            <div class="home_content">
                <div class="people_container">
                   <div class="people_head">People</div>
                   <?php 
                    $uid2=$_SESSION['id'];
                    $people_query="SELECT user_id,display_pic,username FROM mrinal_user_info INNER JOIN mrinal_users ON mrinal_user_info.user_id=mrinal_users.id WHERE user_id != $uid2;";
                    $people_result=$conn->query($people_query);
                    while($people_query_arr=$people_result->fetch_assoc()){
                        $people_uname=$people_query_arr['username'];
                        $people_dp=$people_query_arr['display_pic'];
                        echo"<div class='info_wrapper'>
                                <div class='people_image_container'>
                                    <img class='people_image' src='images/$people_dp'/>
                                    <div class='people_name'>$people_uname</div>
                                </div>
                                <div class='people_options'>
                                    <a>view profile</a>
                                    <a onclick='openchatbox(\"$people_uname\")'>message</a>
                                </div>
                            </div>";
                    }

                    ?>
                </div>
                <div class="online_container">
                    <div class="online_head">Online</div>
                    <div class="people_list" id="people_list">
                    </div>
                </div>
            </div>
        </div>
        <?php require("footer.php");?>
        <script src="sessions.js"></script>
        <script src="home.js"></script>
    </body>
</html>
