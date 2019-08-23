  <?php
	include 'common.php';
    $conn = connect_db();

	session_start();
	
	$roll_no =  mysqli_real_escape_string($conn, $_POST['roll_no']);
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$class = mysqli_real_escape_string($conn, $_POST['class']);

	$class = strtoupper($class);

	
	$sql = "INSERT INTO students (roll_no, name, class) 
		VALUES ('$roll_no', '$name', '$class')";

	if (mysqli_query($conn, $sql)) {
	   	header("Location: ./studlist.php");	
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}				
?>