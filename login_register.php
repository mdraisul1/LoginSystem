<?php 

require 'connection.php';

if(isset($_POST['register'])){
    $user_exist_query = "SELECT * FORM `register` WHERE `username` = '$_POST[username]' OR `email` = '$_POST[email]'";
    $user_exist_result = mysqli_query($con, $user_exist_query);
}

