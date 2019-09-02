<?php
session_start();

if ( isset( $_SESSION['user_id'] ) ) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
} else {
    // Redirect them to the login page
    header("Location: login.php");
}
?>

<html>
<head>
    <title>Pacifica</title>
	<!-- Favicon -->
	<link rel="icon" href="../images/logo3.png" type="image/gif" sizes="16x16" />
	<!-- Bootstrap Stylesheet -->
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" /> 
	<!-- Common Custom Stylesheet -->
    <link rel="stylesheet" type="text/css" href="../css/common.css" />

	<!-- jQuery -->
	<script src="../js/jquery.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="../js/umd/popper.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<!-- ChartJS -->
	<script src="../js/chart.min.js"></script>
	<script src="../js/bookchart.js"></script>
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/solid.css" integrity="sha384-wnAC7ln+XN0UKdcPvJvtqIH3jOjs9pnKnq9qX68ImXvOGz2JuFoEiCjT8jyZQX2z" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css" integrity="sha384-HbmWTHay9psM8qyzEKPc8odH4DsOuzdejtnr+OFtDmOcIVnhgReQ4GZBH7uwcjf6" crossorigin="anonymous" />
	
	<script type="text/javascript">
		function active() {
			var currentTab = document.getElementById('a0');
			currentTab.classList.add('active-tab');
		}

		window.onload = function() {
			active();
		}
	</script>
</head>

<body>
	<?php
		include 'common.php';
		$conn = connect_db();
		include 'menu.php';
	?> 
    
	<div class="content">
		<div class="header">
			<h1>Home</h1>
		</div>

		<div class="card-deck" style="margin-right: 5%; max-height: 11em; min-width: 500px; margin-top: 70px;">
				<div id= "d1" class="card mb-3 dashboard" style="max-width: 15rem; display: inline-block;">
					<div class="card-body">
						<h5 class="card-title">Books Registered</h5>
						<p class="card-text" style="font-size: 50">
								<i class="fas fa-book"></i>&nbsp;&nbsp;
								<?php
									$sql = "SELECT SUM(stock) AS books FROM books WHERE display = 1";
									$result = mysqli_query($conn, $sql);

									if (mysqli_num_rows($result) > 0) {  			
										while($row = mysqli_fetch_assoc($result)) { 
											$books = $row["books"];
											echo "<b>" . $books . "</b>";
										}
									}
								?>
						</p>
					</div>
				</div>

				<div id="d2" class="card mb-3 dashboard" style="max-width: 15rem; display: inline-block;">
					<div class="card-body">
						<h5 class="card-title">Students Registered</h5>
						<p class="card-text" style="font-size: 50">
							<i class="fas fa-users"></i>&nbsp;&nbsp;
							<?php
								$sql = "SELECT COUNT(*) AS 'studno' FROM students WHERE display = 1";
								$result = mysqli_query($conn, $sql);

								if (!$result) {
									echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
								}

								if (mysqli_num_rows($result) > 0) {  
									$row = mysqli_fetch_assoc($result);
									$studno = $row["studno"];
								}

								echo "<b>" . $studno . "</b>";				
							?>
						</p>
					</div>
				</div>

				<div id="d3" class="card mb-3 dashboard" style="max-width: 15rem; display: inline-block;">
					<div class="card-body">
						<h5 class="card-title">Books Issued</h5>
						<p class="card-text" style="font-size: 50">
							<i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;
							<?php
								$sql = "SELECT COUNT(*) AS issued "
									. " FROM transaction_record t, students s, books b"
									. " WHERE date_returned IS NULL AND t.student_srno = s.srno AND t.book_srno = b.srno"
									. " AND s.display = 1";

								$result = mysqli_query($conn, $sql);

								if (mysqli_num_rows($result) > 0) {  			
									while($row = mysqli_fetch_assoc($result)) { 
										$issued = $row["issued"];
										echo "<b>" . $issued . "</b>";
									}
								}
							?>
						</p>
					</div>
				</div>

				<div id="d4" class="card text-white bg-danger mb-3 dashboard" style="max-width: 15rem; display: inline-block;">
					<div class="card-body">
						<h5 class="card-title">Books Overdue</h5>
						<p class="card-text" style="font-size: 50">
							<i class="fas fa-exclamation-circle"></i>&nbsp;&nbsp;
							<?php
								$sql = "SELECT COUNT(*) AS pending"
									. " FROM students s, books b, transaction_record t"
									. " WHERE s.srno = t.student_srno AND b.srno = t.book_srno"
									. " AND t.date_returned IS NULL AND CURDATE() > t.date_due";

								$result = mysqli_query($conn, $sql);

								if (mysqli_num_rows($result) > 0) {  			
									while($row = mysqli_fetch_assoc($result)) { 
										$pending = $row["pending"];
										echo "<b>" . $pending . "</b>";
									}
								}
							?>
						</p>
					</div>
				</div>
		</div>

		<div class="block">
			<h4>Number of Books</h4>
			<div class="chart-container">
				<canvas id="mycanvas"></canvas>
			</div>
		</div>

		<div class="block credits">
			<h4>About</h4>
			Library Management System for India International School in Japan<br/>
			Designed and developed by Atharva Patil (Class of '19) in 2018<br/>
			Contact: <span id="home_email">atharvapatilpune@gmail.com</span><br/>
			Please feel free to send an email in case of system failure or for any clarification
		</div>

	</div>
	
</body>
</html>