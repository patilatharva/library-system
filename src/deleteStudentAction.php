<?php
	$srno =  $_POST['srno'];
	
	include 'common.php';
    $conn = connect_db();
	$sql = "UPDATE students SET display=0 WHERE srno ='$srno'";
    $result = mysqli_query($conn, $sql);

	if (mysqli_query($conn, $sql)) {
		header("Location: ./studlist.php");	
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
				
?>