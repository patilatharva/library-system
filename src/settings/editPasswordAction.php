<?php

include '../common.php';
$conn = connect_db();

session_start();

$password = $_POST['newPass1'];
$user_id = $_SESSION['user_id'];

$sql = "UPDATE users SET password = '$password' WHERE user_id = '$user_id'";
mysqli_query($conn, $sql);

?>