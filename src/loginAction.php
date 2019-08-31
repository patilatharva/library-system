<?php

session_start();

if ( ! empty( $_POST ) ) {
    if ( isset( $_POST['username'] ) && isset( $_POST['password'] ) ) {
        // Getting submitted user data from database
        
        include "common.php";
        $conn = connect_db();

        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT user_id, password FROM users WHERE username = '$username';";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
        }

        if (mysqli_num_rows($result) > 0) {  
            $row = mysqli_fetch_assoc($result);
            $db_pass = $row['password'];
            $user_id = $row['user_id'];
        }
        
        // Verify user password and set $_SESSION
        if($db_pass==$password) {
            $_SESSION['user_id'] = $user_id;
            echo json_encode(array(
                'status' => 'allowed'
            ));
        } else {
            echo json_encode(array(
                'status' => 'denied'
            ));
        }
    }
}