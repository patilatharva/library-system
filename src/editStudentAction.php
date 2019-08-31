<?php
	include 'common.php';
    $conn = connect_db(); 

	$srno = mysqli_real_escape_string($conn, $_POST['srno']);
	$class =  mysqli_real_escape_string($conn, $_POST['class']);
	$roll_no = mysqli_real_escape_string($conn, $_POST['roll_no']);
	$name = mysqli_real_escape_string($conn, $_POST['name']);

	$sql = "UPDATE students " .
		   "SET class = '$class', roll_no = '$roll_no', name = '$name'" . 
		   "WHERE srno = '$srno'";
	
	if (mysqli_query($conn, $sql)) {
	   	header("Location: ./studlist.php");	
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	mysqli_close($conn);

?>