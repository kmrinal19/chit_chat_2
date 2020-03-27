<?php
    require("connection.php");
    session_start();
    if(isset($_SESSION['id'])){
        header("location:home.php");
    }
    else if(isset($_COOKIE['session_id'])){
        $sid=session_id();
        $old_sid=$_COOKIE['session_id'];
        setcookie("session_id",$sid,time()+7776000);
        $match_session_query="SELECT user_id,username FROM mrinal_session INNER JOIN mrinal_users ON mrinal_session.user_id=mrinal_users.id WHERE session_id='$old_sid';";
        $session_query_result=$conn->query($match_session_query);
        if($session_query_result->num_rows==1){
            $session_query_array = $session_query_result->fetch_array();
            $_SESSION['id']=$session_query_array['user_id'];
            $_SESSION['name']=$session_query_array['username'];
            $_SESSION['sid']=$sid;
            $_SESSION['remember']='true';
            $update_session_query="UPDATE mrinal_session SET session_id='$sid' WHERE session_id='$old_sid';";
            $update_result = $conn->query($update_session_query);
            header("location:home.php");
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,700|Nunito+Sans:400,700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="chit_chat.css" rel="stylesheet"/>
    </head>
    <body>
        <?php require("navbar_default.php");?>

        <div class="content_container">
            <div class="content">
                <div class="content_left">
                    <img class="icon_big" src="icons/icon.svg"/>
                    <div class="content_text">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsam voluptatem ea aspernatur quis earum quisquam veniam temporibus fugiat perferendis, enim veritatis dolorem commodi magni. Dolorum sit modi excepturi sed ab.
                    </div>
                </div>
                <div class="content_right">
                    <div class="form_container" id="form_container">
                        <div class="form_head">
                            <a id="sign_up_tab">Sign-up</a>
                            <a id="sign_in_tab" class="head_not_selected complete_center" onclick="open_sign_in()">Sign-in</a>
                        </div>
                        <form class="form" id="sign_up_form" method="post" action="validate_sign_up.php">
                            <div class="form_input_container">
                                <div class="input_container"><input class="input" type="text" placeholder="Enter your username" name="up_uname" id="up_uname" onkeyup="check_up_username(this)"/><span id="up_uname_msg_icon"></span></div>
                                <span class="error_message" id="up_uname_err">Invalid user name</span>
                                <div class="input_container"><input class="input" type="text" placeholder="Enter your email-id" name="email" id="email"onkeyup="check_email(this)"/><span id="email_msg_icon"></span></div>
                                <span class="error_message"id="email_err">Invalid email id</span>
                                <div class="input_container"><input class="input" type="text" placeholder="Enter your phone no." name="phone" id="phone"onkeyup="check_phone(this)"/><span id="phone_msg_icon"></span></div>
                                <span class="error_message"id="phone_err">Invalid phone number</span>
                                <div class="input_container"><input class="input" type="password" placeholder="Enter your password" name="up_password" id="up_password"onkeyup="check_up_password(this)"/><span id="up_password_msg_icon"></span></div>
                                <span class="error_message"id="up_password_err">Invalid password</span>
                                <div class="input_container"><input class="input" type="password" placeholder="Confirm password" name="confirm_password" id="confirm_password"onkeyup="check_confirm_password(this)"/><span id="confirm_password_msg_icon"></span></div>
                                <span class="error_message"id="confirm_password_err">Wrong password</span>
                                <label class="gender_label">Gender:</label>
                                <div class="gender_radio_container">
                                    <div class="radio_name">
                                        <input type="radio" name="gender" value="M" id="male">
                                        <span>Male</span>
                                    </div>
                                    <div class="radio_name">
                                        <input type="radio"  name="gender" value="F" id="female">
                                        <span>Female</span>
                                    </div>
                                    <div class="radio_name">
                                        <input type="radio" name="gender" value="O" id="others">
                                        <span>Others</span>
                                    </div>
                                </div>
                                <span class="error_message"id="gender_err">Please select your gender</span>
                            </div>
                            <button class="submit_btn" type="button" onclick="send_sign_up_form()">Submit</button>
                        </form>
                    </div>
                    <div class="form_container_in" id="form_container_in">
                        <div class="form_head">
                            <a id="sign_up_tab" class="head_not_selected complete_center" onclick="open_sign_up()">Sign-up</a>
                            <a id="sign_in_tab">Sign-in</a>
                        </div>
                        <form class="form_in" id="sign_in_form" method="POST" action="validate_sign_in.php">
                            <div class="form_input_container">
                                <div class="input_container"><input class="input" type="text" placeholder="Enter your username" name="in_uname" id="in_uname" /><span id="in_uname_msg_icon"></span></div>
                                <span class="error_message" id="in_uname_err">Invalid user name</span>
                                <div class="input_container"><input class="input" type="password" placeholder="Enter your password" name="in_password" id="in_password"/><span id="in_password_msg_icon"></span></div>
                                <span class="error_message"id="in_password_err">Invalid password</span>
                                <div class="checkbox_container">
                                    <input type="checkbox" name="remember" value="remember" id="remember_checkbox">
                                    <span class="checkbox_label"> Remember me</span>
                                </div>
                            </div>
                            <button class="submit_btn" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php require("footer.php");?>

        <script src="validations.js"></script>
        <script src="chit_chat.js"></script>

        <?php
            if(isset($_GET['login_error'])){
                echo"<script>open_sign_in()</script>";
                if($_GET['login_error']==1){ 
                    echo"<script>display_in_uname_err()</script>";
                }
                else if($_GET['login_error']==2){ 
                    echo"<script>display_in_password_err()</script>";
                }
                unset($_GET['login_error']);
            }
        ?>
        
    </body>
</html>
