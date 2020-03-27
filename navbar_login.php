<?php
    require_once("connection.php");
    //session_start();
    $uid=$_SESSION['id'];
    $dp_query="SELECT display_pic FROM mrinal_user_info WHERE user_id=$uid;";
    $dp_query_result=$conn->query($dp_query);
    $dp_array=$dp_query_result->fetch_assoc();
    $dp=$dp_array['display_pic'];
?>
<div class="navbar_container">
    <div class="navbar_login">
        <div class="navbar_head">
            <img class="navbar_icon" src="icons/icon.svg"/>
            <div class="navbar_brand"><a href="#">Chit-Chat</a></div>
        </div>
        <div class="navbar_link_container_login">
            <div class="navbar_login_img_container">
                <img class="navbar_login_img" src="images/<?php echo$dp;?>"/>
                <a class="navbar_username" href="user.php"><?php echo $_SESSION['name']; ?></a>
            </div>
            <a class="navbar_link" href="home.php">Home</a>
            <a class="navbar_link" href="logout.php">Log-out</a>
        </div>
    </div>
</div>
