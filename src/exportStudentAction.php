<?php  
	include 'common.php';
	$conn = connect_db();

	$sql = "SELECT class, roll_no, name FROM students WHERE display = 1 ORDER BY class, roll_no";
				
	$result = mysqli_query($conn, $sql);
	if (!$result) {
		echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
	} else {
	
		$csv_export = join(",", ["Class", "Roll No.", "Name"]);
		$csv_export .= "\r\n";

		if (mysqli_num_rows($result) > 0) {      
			while($row = mysqli_fetch_assoc($result)) {
				$class = $row["class"];
				$roll_no = $row["roll_no"];
				$name = "\"".$row["name"]."\"";
				
				$csv_export .=  join(",", [$class, $roll_no, $name]);
				$csv_export .= "\r\n";
			}
		}
		mysqli_close($conn);

		// Export the data and prompt a csv file for download
		$csv_filename = 'StudentList'.date('Y-m-d').'.csv';
		header("Content-Disposition: attachment; filename=$csv_filename");
		echo($csv_export);
	}
?>