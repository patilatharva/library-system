<?php  
	include 'common.php';
	$conn = connect_db();

	$sql = "SELECT class, name, title, date_borrowed, date_due, DATEDIFF(CURDATE(), date_due) AS days_overdue"
		. " FROM students s, books b, transaction_record t"
		. " WHERE s.srno = t.student_srno AND b.srno = t.book_srno"
		. " AND t.date_returned IS NULL AND CURDATE() > t.date_due"
		. " ORDER BY class";
				
	$result = mysqli_query($conn, $sql);
	if (!$result) {
		echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
	} else {
	
		$csv_export = join("\t", ["Class", "Name", "Title", "Date Borrowed", "Date Due", "Days Overdue"]);
		$csv_export .= "\r\n";

		if (mysqli_num_rows($result) > 0) {      
			while($row = mysqli_fetch_assoc($result)) {
				$name = $row["name"];
				$class = $row["class"];
				$title = $row["title"];
				$date_borrowed = $row["date_borrowed"];
				$date_due =$row["date_due"];
				$days_overdue = $row["days_overdue"];
				$csv_export .=  join("\t", [$class, $name, $title, $date_borrowed, $date_due, $days_overdue]);
				$csv_export .= "\r\n";
			}
		}
		mysqli_close($conn);

		// Export the data and prompt a csv file for download
		$csv_filename = 'db_export_'.date('Y-m-d').'.xls';
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=$csv_filename");
		echo($csv_export);
	}
?>