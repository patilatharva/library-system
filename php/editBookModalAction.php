<?php

include 'common.php';
$conn = connect_db();

if(isset($_POST['srno'])) {
	$srno = $_POST['srno'];

	$sql = "SELECT * FROM books WHERE srno = '$srno' AND display = 1";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {  
		$row = mysqli_fetch_assoc($result);
		$details = json_encode($row);
		echo $details;
	}
}
?>