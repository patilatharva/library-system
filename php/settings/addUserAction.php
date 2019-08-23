<?php

include '../common.php';
$conn = connect_db();

$username = $_POST['username'];
$email = $_POST['email'];
$access = $_POST['access'];
$password = $_POST['pass1'];

$sql = "INSERT INTO users (username, email, password, access) VALUES ('$username', '$email', '$password','$access');";
mysqli_query($conn, $sql);

?>