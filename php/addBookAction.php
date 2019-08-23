<?php
	
	include 'common.php';
    $conn = connect_db(); 

	$isbn =  mysqli_real_escape_string($conn, $_POST['isbn']);
	$author = mysqli_real_escape_string($conn, $_POST['author']);
	$title = mysqli_real_escape_string($conn, $_POST['title']);	
	$copies = mysqli_real_escape_string($conn, $_POST['copies']);
	$publisher = mysqli_real_escape_string($conn, $_POST['publisher']);
	$published_date = mysqli_real_escape_string($conn, $_POST['publishedDate']);
	$published_date = strval($published_date);	
	$description = mysqli_real_escape_string($conn, $_POST['description']);
	$pages = mysqli_real_escape_string($conn, $_POST['pageCount']);
	$categories = mysqli_real_escape_string($conn, $_POST['categories']);

	$query = "SELECT stock FROM books WHERE title = '$title'";
	$result = mysqli_query($conn, $query);
	if($row = mysqli_fetch_assoc($result)) {
		$stock = $row['stock'];

		if($stock > 0) {
			$newStock = $stock + $copies; 
			$sql = "UPDATE books SET stock = '$newStock' WHERE title = '$title'";
		}
	} else {
		
		$sql = "INSERT INTO books (isbn, title, author, stock, publisher, published_date, description, pages, categories) 
		VALUES ('$isbn', '$title', '$author', '$copies', '$publisher', '$published_date', '$description', '$pages', '$categories')";
	}

	mysqli_query($conn, $sql);
	
	$img = "../book_thumbnail/default6.png";
	$srno = mysqli_insert_id($conn);
	$coverLink = $_POST['coverLink'];

	// Save cover image
	if($coverLink != "default6.png") {
		$img = '../book_thumbnail/' . $srno . '.jpg';
		file_put_contents($img, file_get_contents($coverLink));
	}

	$sql = "UPDATE books SET img = '$img' WHERE srno = '$srno'";

	if (mysqli_query($conn, $sql)) {
		//echo $sql;
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	

	mysqli_close($conn);
?>