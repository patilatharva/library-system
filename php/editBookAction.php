<?php
	include 'common.php';
    $conn = connect_db(); 

	$srno = mysqli_real_escape_string($conn, $_POST['srno']);
	$title =  mysqli_real_escape_string($conn, $_POST['title']);
	$author = mysqli_real_escape_string($conn, $_POST['author']);
	$isbn = mysqli_real_escape_string($conn, $_POST['isbn']);
	$stock = mysqli_real_escape_string($conn, $_POST['copies']);	
	$description = mysqli_real_escape_string($conn, $_POST['description']);
	$pages = mysqli_real_escape_string($conn, $_POST['pageCount']);
	$categories = mysqli_real_escape_string($conn, $_POST['categories']);
	$publisher = mysqli_real_escape_string($conn, $_POST['publisher']);
	$published_date = mysqli_real_escape_string($conn, $_POST['publishedDate']);
	$published_date = strval($published_date);	


	$sql = "UPDATE books 
		   	SET title = '$title', author = '$author', isbn = '$isbn', stock = '$stock', description = '$description', 
			   	pages = '$pages', categories = '$categories', publisher = '$publisher', published_date = '$published_date'
		   	WHERE srno = $srno";
	
	if (mysqli_query($conn, $sql)) {

	} else {
    	echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}


	mysqli_close($conn);
	

?>