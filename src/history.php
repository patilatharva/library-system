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
	<link rel="icon" href="../images/logo3.png" type="image/gif" sizes="16x16">
	<!-- DataTables Stylesheet -->
	<link rel="stylesheet" type="text/css" href="../css/datatables.min.css">
	<!-- Bootstrap Stylesheet -->
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<!-- Common Custom Stylesheet-->
	<link rel="stylesheet" type="text/css" href="../css/common.css" />
	<!-- jQuery -->
	<script src="../js/jquery.min.js"></script>
	<!-- DataTables jQuery -->
	<script type="text/javascript" charset="utf8" src="../js/datatables.min.js"></script>
	<!-- Bootstrap Javascript -->
	<script src="../js/umd/popper.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/solid.css" integrity="sha384-wnAC7ln+XN0UKdcPvJvtqIH3jOjs9pnKnq9qX68ImXvOGz2JuFoEiCjT8jyZQX2z" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css" integrity="sha384-HbmWTHay9psM8qyzEKPc8odH4DsOuzdejtnr+OFtDmOcIVnhgReQ4GZBH7uwcjf6" crossorigin="anonymous">
	<script type="text/javascript" charset="utf-8">
		$(document).ready( function () {
			// Setup - add a text input to each footer cell
			$('#history thead tr').clone(true).appendTo( '#history thead' );
			$('#history thead tr:eq(1) th').each( function (i) {
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

			var table = $('#history').DataTable({
				'order': [[ 0, "desc" ]],
				'processing': true,
				'serverSide': true,
				'orderCellsTop': true,
				'ajax': "serverside/historyServerSide.php"
			}); 
		});

		function active() {
			var currentTab = document.getElementById('a5');
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
			<h1>History</h1>
		</div>

		<div class="block block-top">
			<table id="history" class="display" border=1 rules=none>
				<thead>
					<tr>
						<th>Action No.</th>
						<th>Class</th>
						<th>Student</th>
						<th>Title</th>
						<th>Date Borrowed </th>
						<th>Date Due</th>
						<th>Date Returned</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
				<tfoot>
					<tr>
						<th>Action No.</th>
						<th>Class</th>
						<th>Student</th>
						<th>Title</th>
						<th>Date Borrowed </th>
						<th>Date Due</th>
						<th>Date Returned</th>
					</tr>
				</tfoot>						
			</table>
		</div>
		
    </div>

</body>
</html>