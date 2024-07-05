<?php 

require 'connection.php';

if(isset($_POST['register'])){
    $user_exist_query = "SELECT * FORM `register` WHERE `username` = '$_POST[username]' OR `email` = '$_POST[email]'";
    $user_exist_result = mysqli_query($con, $user_exist_query);

    if($user_exist_result){
        if(mysqli_num_rows($user_exist_result) > 0){
            #username or email already exist
            $result_fetch = mysqli_fetch_assoc($user_exist_result);
            if($result_fetch['username'] == $_POST['username']){
                echo "
                <script>alert('Username already exist');
                    window.location.href = 'index.php';
                </script>";
            }else{

            }
        }else{

        }
    }else{
        echo "
        <script>alert('Cannot run query');
            window.location.href = 'index.php';
        </script>";
    }
}

