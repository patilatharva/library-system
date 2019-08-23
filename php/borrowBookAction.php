<?php
	
	include 'common.php';
	$conn = connect_db();

	$isbn =  mysqli_real_escape_string($conn, $_GET['isbn']);
	$s_srno = mysqli_real_escape_string($conn, $_GET['s_srno']);
	$period = mysqli_real_escape_string($conn, $_GET['period']);
	$type = mysqli_real_escape_string($conn, $_GET['type']);
	$b_srno = mysqli_real_escape_string($conn, $_GET['b_srno']);

	date_default_timezone_set("Asia/Tokyo");
	$current_date = date("Y-m-d");
	
	$due_date = strtotime ( "+" . $period . " " . $type , strtotime ( $current_date ) ) ;
	$due_date = date ( "Y-m-d" , $due_date );

	if($b_srno=="") {
		$sql = "SELECT srno FROM books WHERE isbn = '$isbn'";
		$result = mysqli_query($conn, $sql); 
		while($row = mysqli_fetch_assoc($result)) {
			$b_srno = $row['srno'];
		}
	}

	$sql = "INSERT INTO transaction_record (student_srno, book_srno, date_borrowed, date_due)" .
			 "VALUES ('$s_srno', '$b_srno', '$current_date', '$due_date')";

	if (mysqli_query($conn, $sql)) {
	   	header("Location: ./transact.php");	
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	mysqli_close($conn);

?>