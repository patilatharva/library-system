<?php
	include 'common.php';
    $conn = connect_db();
	$srno =  mysqli_real_escape_string($conn, $_POST['srno']);

	$sql = "UPDATE books SET display=0 WHERE srno = '$srno'";
    $result = mysqli_query($conn, $sql);

	if (mysqli_query($conn, $sql)) {
		header("Location: booklist.php");	
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	mysqli_close($conn);
?>