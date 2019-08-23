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
    <title>Library System</title>
	<!-- Favicon -->
	<link rel="icon" href="../images/logo3.png" type="image/gif" sizes="16x16">
	<!-- DataTables Stylesheet -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
	<!-- Bootstrap Stylesheet-->
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" /> 
	<!-- Common Custom Stylesheet -->
    <link rel="stylesheet" type="text/css" href="../css/common.css" />
	<!-- jQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!-- DataTables jQuery --> 
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
	<!-- Bootstrap Javascript -->
	<script src="../javascript/umd/popper.min.js"></script>
	<script type="text/javascript" src="../javascript/bootstrap.min.js"></script>

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/solid.css" integrity="sha384-wnAC7ln+XN0UKdcPvJvtqIH3jOjs9pnKnq9qX68ImXvOGz2JuFoEiCjT8jyZQX2z" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css" integrity="sha384-HbmWTHay9psM8qyzEKPc8odH4DsOuzdejtnr+OFtDmOcIVnhgReQ4GZBH7uwcjf6" crossorigin="anonymous">
	<script type="text/javascript" charset="utf-8">
		$(document).ready( function () {
			// Setup - add a text input to each footer cell
			$('#pending thead tr').clone(true).appendTo( '#pending thead' );
			$('#pending thead tr:eq(1) th').each( function (i) {
				var title = $(this).text();

				$(this).html( '<input type="text" placeholder="Search '+title+'" />' );
		
				$( 'input', this ).on( 'keyup change', function () {
					if ( table.column(i).search() !== this.value ) {
						table
							.column(i)
							.search( this.value )
							.draw();
					}
				} ); 
			} );

			var table = $('#pending').DataTable({
				'ajax': "serverside/pendingServerSide.php",
				'order': [[ 5, 'desc' ]],
				'orderCellsTop': true,
				'language': { 'emptyTable': 'No overdue books!' },
				'columnDefs': [
					{
						'targets': 2,
						'width': '35%'
					},
					{
						"targets": 5,
						"className": "text-center"
					}
				]
			});
			
		});

		function active() {
			var currentTab = document.getElementById('a4');
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
			<h1>Overdue</h1>
			<div class="numOf">
			<h5 class="card-text" style="margin-bottom: 20px;">
					Books Overdue:&nbsp;
					<?php
						$sql = "SELECT COUNT(*) AS pending"
						. " FROM students s, books b, transaction_record t"
						. " WHERE s.srno = t.student_srno AND b.srno = t.book_srno"
						. " AND t.date_returned IS NULL AND CURDATE() > t.date_due"
						. " AND b.display = 1";
						$result = mysqli_query($conn, $sql);

						if (!$result) {
							echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
						}

						if (mysqli_num_rows($result) > 0) {  
							$row = mysqli_fetch_assoc($result);
							$pending = $row["pending"];
						}

						echo "<b>" . $pending . "</b>";				
						mysqli_close($conn);
					?>
					&nbsp;&nbsp;
				</h5>

				<!-- Download the list with a button -->
				<form action="./exportPending.php" method="GET" style="display: inline">
					<button id="btn-teal" type="submit" class="btn  btn-outline-light" name="export">
						<i class="fas fa-download"></i>&nbsp;&nbsp;Export Data
					</button>
				</form>
			</div>
		</div>	

		<div class="block block-top">
			<table id="pending" class="display" border=1 rules=none>
				<thead>
					<tr>
						<th>Class</th>
						<th>Name</th>
						<th>Title</th>
						<th>Date Borrowed</th>
						<th>Date Due</th>
						<th>Days Overdue</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Class</th>
						<th>Name</th>
						<th>Title</th>
						<th>Date Borrowed</th>
						<th>Date Due</th>
						<th>Days Overdue</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</body>
</html>