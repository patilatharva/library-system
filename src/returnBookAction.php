<?php
	include "common.php";
	$conn = connect_db();

	$trno =  mysqli_real_escape_string($conn, $_POST['trno']);
	$today = date("Y-m-d");

	$sql = "UPDATE transaction_record "
		 . " SET date_returned='$today' WHERE transaction_no = '$trno'";
	
	if (mysqli_query($conn, $sql)) {
	   	header("Location: transact.php");
		
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	mysqli_close($conn);
?>