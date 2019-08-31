<?php  
	include 'common.php';
	$conn = connect_db();

	$sql = "SELECT srno, title, author, isbn, stock, date_added FROM books WHERE display = 1 ORDER BY srno DESC";
				
	$result = mysqli_query($conn, $sql);
	if (!$result) {
		echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
	} else {
	
		$csv_export = join(",", ["S. No.", "Title", "Author", "ISBN", "Copies", "Date Added"]);
		$csv_export .= "\r\n";

		if (mysqli_num_rows($result) > 0) {      
			while($row = mysqli_fetch_assoc($result)) {
				$srno = $row["srno"];
				$title = "\"".$row["title"]."\"";
				$author = "\"".$row["author"]."\"";
				$isbn = (string) $row["isbn"];
				$copies = $row["stock"];
				$date_added = $row["date_added"];
				
				$csv_export .=  join(",", [$srno, $title, $author, $isbn, $copies, $date_added]);
				$csv_export .= "\r\n";
			}
		}
		mysqli_close($conn);

		// Export the data and prompt a csv file for download
		$csv_filename = 'Inventory'.date('Y-m-d').'.csv';
		header("Content-Disposition: attachment; filename=$csv_filename");
		echo($csv_export);
	}
?>