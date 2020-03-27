<?php session_start();
    if(!(isset($_SESSION['id']))){
        header("location:index.php");
    }
    require_once("connection.php");
    $uid=$_SESSION['id'];
    $info_query="SELECT * FROM mrinal_user_info WHERE user_id=$uid;";
    $info_query_result=$conn->query($info_query);
    $info_array=$info_query_result->fetch_assoc();
    $dp=$info_array['display_pic'];
    $info_name=$info_array['name'];
    $info_uname=$_SESSION['name'];
    $info_email=$info_array['email'];
    $info_phone=$info_array['phone'];
    $bio=$info_array['bio'];
    $bday=$info_array['birthday'];
    $bday_year=date("Y",strtotime($bday));
    $bday_month=date("m",strtotime($bday));
    $bday_date=date("d",strtotime($bday));
    $months=array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
    $info_gender=$info_array['gender'];
?>
<!DOCTYPE html>
<html>
    <head>
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,700|Nunito+Sans:400,700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="chit_chat.css" rel="stylesheet"/>
    <link href="user.css" rel="stylesheet"/>
    </head>
    <body>
        <?php require("navbar_login.php");?>
        <div class="overlay" id="overlay">
            <div class="change_password_container">
                <div class="change_password_head">
                    <div class="password_head">Change Password</div>
                    <button class="password_close" onclick="hide_overlay()">X</button>
                </div>
                <form class="password" method="post" action="password_change_request.php" id="password_form">
                    <div class="info_input_container password_input">
                        <div class="info_input_label">Current Password:</div>
                        <input class="info_input" type="password" name="current_password" id="current_password"/>
                    </div>
                    <span class="error_message" id="current_pass_err">Password didn't match</span>
                    <div class="info_input_container password_input">
                        <div class="info_input_label">New Password:</div>
                        <input class="info_input" type="password" name="new_password" id="new_password" onkeyup="password_change_validate()"/>
                    </div>
                    <span class="error_message" id="new_pass_err">Invalid password</span>
                    <button class="password_button" type="button" onclick="password_change_request()">Change Password</button>
                </div>
            </div>
        </div>
        <div class="content_container">
            <div class="user_content">
                <div class="user_head">
                    <div class="dp_image_container">
                        <img class="dp_image" src="images/<?php echo$dp;?>"/>
                        <form class="dp_form" action="dp_upload.php" method="post" enctype="multipart/form-data">
                            <input type="file" id="dp_file" name="dp_file"/>
                            <button type="submit" name="dp_upload" value="dp_upload" class="upload_button">Upload</button>
                        </form>
                    </div>
                    <div class="username_head">
                        <?php echo$_SESSION['name'];?>
                    </div>
                </div>
                <form class="info_left" id="profile_info_left" method="post" action="update_profile_info.php">
                    <div class="info_input_container">
                        <div class="info_input_label">Name:</div>
                        <input class="info_input" type="text" name="name_info" id="name_info" placeholder="Enter your name" value='<?php echo$info_name?>' onkeyup="check_info_name()"/>
                    </div>
                    <span class="error_message" id="info_name_err">Invalid name</span>
                    <div class="info_input_container">
                        <div class="info_input_label">Username:</div>
                        <input class="info_input" type="text" name="username_info" id="username_info"  value='<?php echo$info_uname?>' readonly/>
                    </div>
                    <span class="error_message" id="info_username_err">Invalid username</span>
                    <div class="info_input_container">
                        <div class="info_input_label">E-mail:</div>
                        <input class="info_input" type="text" name="email_info" id="email_info"  value='<?php echo$info_email?>'onkeyup="check_info_email()" />
                    </div>
                    <span class="error_message" id="info_email_err">Invalid e-mail</span>
                    <div class="info_input_container">
                        <div class="info_input_label">Phone no.:</div>
                        <input class="info_input" type="text" name="phone_info" id="phone_info"  value='<?php echo$info_phone?>'onkeyup="check_info_phone()"/>
                    </div>
                    <span class="error_message" id="info_phone_err">Invalid phone</span>
                    <div class="info_input_container">
                        <div class="info_input_label">Birthday:</div>
                        <div class="birthday_container">
                            <select class="select_bday"id="birthdate" name="birthdate" >
                                <?php for($i=1;$i<=31;$i++){
                                    if($i==$bday_date){
                                        echo"<option selected='selected'>$i</option>"; 
                                    }
                                    else{
                                        echo"<option>$i</option>";
                                    }
                                }?>
                            </select>
                            <select class="select_bday"id="birthmonth" name="birthmonth">
                                <?php 
                                    
                                    for($i=0;$i<12;$i++){
                                        $month=$months[$i];
                                        if($i==$bday_month-1){
                                            echo"<option selected='selected'>$month</option>";
                                        }
                                        else{
                                            echo"<option>$month</option>";
                                        }
                                }?>
                            </select>
                            <select class="select_bday"id="birthyear" name="birthyear">
                                <?php for($i=1905;$i<=2019;$i++){
                                    if($i==$bday_year){
                                        echo"<option selected='selected'>$i</option>"; 
                                    }
                                    else{
                                        echo"<option>$i</option>";
                                    }
                                }?>
                            </select>
                        </div>
                    </div>
                    <span class="error_message" id="info_birthday_err">Invalid birthday</span>
                    <div class="info_input_container">
                        <div class="info_input_label">Gender:</div>
                        <select class="select_bday small_select"  name="gender_info" id="gender_info" >
                            <option <?php if($info_gender=='M') echo"selected='selected'";?>>Male</option>
                            <option <?php if($info_gender=='F') echo"selected='selected'";?>>Female</option>
                            <option <?php if($info_gender=='O') echo"selected='selected'";?>>Others</option>
                        </select>
                    </div>
                    <span class="error_message" id="info_gender_err">  </span>
                    <button type="button" class="upload_button" onclick="check_profile_status()">Update</button>
                    <a class="password_link" onclick="show_overlay()">Change Password</a>
                </form>
                <form class="info_right" method="post" action="add_bio.php">
                    <span class="biolabel">Bio:</span>
                    <textarea class="bio_text" id="bio_text" name="bio_text"rows="10" placeholder="Say something about yourself......"><?php echo$bio?></textarea>
                    <button type="submit" class="upload_button button_end">Add Bio.</button>
                </form>
                <button class="upload_button button_end btn_col_2"><a href="home.php">Home</a></button>
            </div>
        </div>
        <?php require("footer.php");?>
        <script src="sessions.js"></script>
        <script src="info_validation.js"></script>
        <script src="chit_chat.js"></script>
    </body>
</html>
