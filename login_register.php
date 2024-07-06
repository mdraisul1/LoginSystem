<?php 
require 'connection.php';

if(isset($_POST['register-btn'])) {
    // Use prepared statements to prevent SQL injection
    $stmt = $con->prepare("SELECT * FROM `register` WHERE `username` = ? OR `email` = ?");
    $stmt->bind_param("ss", $_POST['username'], $_POST['email']);
    $stmt->execute();
    $user_exist_result = $stmt->get_result();

    if($user_exist_result) {
        # Check if username or email already exists
        if(mysqli_num_rows($user_exist_result) > 0) {
            # Username or email already exists
            $result_fetch = mysqli_fetch_assoc($user_exist_result);
            if($result_fetch['username'] == $_POST['username']) {
                # Username already exists
                echo "
                <script>
                    alert('Username already exists');
                    window.location.href = 'index.php';
                </script>";
            } else {
                # Email already exists
                echo "
                <script>
                    alert('Email already exists');
                    window.location.href = 'index.php';
                </script>";
            }
        } else {
            # Insert query
            $hashed_password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $stmt = $con->prepare("INSERT INTO `register`(`first_name`, `username`, `email`, `password`) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $_POST['full-name'], $_POST['username'], $_POST['email'], $hashed_password);

            if($stmt->execute()) {
                # If data is inserted successfully
                echo "
                <script>
                    alert('Data inserted successfully');
                    window.location.href = 'index.php';
                </script>";
            } else {
                # If data cannot be inserted
                echo "
                <script>
                    alert('Cannot run query');
                    window.location.href = 'index.php';
                </script>";
            }
        }
    } else {
        echo "
        <script>
            alert('Cannot run query');
            window.location.href = 'index.php';
        </script>";
    }
}

if(isset($_POST['login-btn'])) {
    // Handle login logic here
    // Note: Make sure to use prepared statements and password_verify for login
}
?>
