<?php
     $servername="localhost";
     $username="first_year";
     $password="first_year";
     $db="first_year";
     $conn=new mysqli($servername,$username,$password,$db);
     if($conn->connect_error){
         die("Connection failed ".$conn->connect_error);
     }
     function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
 ?>
