<?php

include '../common.php';
$conn = connect_db();

session_start();

$user_id = $_POST['user_id'];
$email = $_POST['email'];
$access = $_POST['access'];

$sql = "UPDATE users SET email = '$email', access='$access' WHERE user_id = '$user_id'";
mysqli_query($conn, $sql);

?>