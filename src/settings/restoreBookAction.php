<?php

include '../common.php';
$conn = connect_db();

$srno = $_POST['srno'];

$sql = "UPDATE books SET display=1 WHERE srno = '$srno'";
mysqli_query($conn, $sql);

?>