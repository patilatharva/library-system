<?php

include '../common.php';
$conn = connect_db();

session_start();

$user_id = $_SESSION['user_id'];
$email = $_POST['email'];

$sql = "UPDATE users SET email = '$email' WHERE user_id = '$user_id'";
mysqli_query($conn, $sql);

?>