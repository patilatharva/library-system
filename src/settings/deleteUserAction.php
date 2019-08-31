<?php

include '../common.php';
$conn = connect_db();

$user_id = $_POST['user_id'];

$sql = "DELETE FROM users WHERE user_id = '$user_id'";
mysqli_query($conn, $sql);

?>