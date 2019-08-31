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


<!-- LIST OF BOOKS -->

<html>
<head>
    <title>Library System</title>
	<!-- Favicon -->
	<link rel="icon" href="../images/logo3.png" type="image/gif" sizes="16x16">
	<!-- DataTables Stylesheet -->
	<link rel="stylesheet" type="text/css" href="../css/datatables.min.css">
	<!-- Bootstrap Stylesheet -->
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<!-- Common Custom Stylesheet-->
	<link rel="stylesheet" type="text/css" href="../css/common.css" />
	<!-- Google Books API JavaScript -->
	<script type="text/javascript" src="../js/addbook.js" ></script>
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
		/************************** DataTables JavaScript *************************** */			
		$(document).ready( function () {
			// Setup - add a text input to each footer cell
			$('#booklist thead tr').clone(true).appendTo( '#booklist thead' );
			$('#booklist thead tr:eq(1) th').each( function (i) {
				var title = $(this).text();

				if(i>1&&i<6)
					$(this).html( '<input type="text" placeholder="Search '+title+'" />' );
				else
					$(this).html('');
		
				$( 'input', this ).on( 'keyup change', function () {
					if ( bookTable.column(i).search() !== this.value ) {
						bookTable
							.column(i)
							.search( this.value )
							.draw();
					}
				} ); 
			} );

			var bookTable = $('#booklist').DataTable({
				'order': [[ 0, "desc" ]],
				'orderCellsTop': true,
				'ajax': "serverside/bookServerSide.php",
				'columnDefs': [
					{
						"targets": 1,
						"width": "120px",
						"className": "text-center",
						"orderable": false
					},
					{
						"targets": 5,
						"width": "120px",
					},
					{
						"targets": 6,
						"className": "text-center",
						"orderable": false
					},
					{
						"targets": 7,
						"className": "text-center",
						"orderable": false
					}
				]
			});
		});

	/**************************** Misc. JavaScript ************************ */
		function active() {
			var currentTab = document.getElementById('a3');
			currentTab.classList.add('active-tab');
		}

		window.onload = function() {
			active();	// highlight text on menu 
		}


	</script>
</head>

<body>
	<?php 
		include 'common.php';
		$conn = connect_db();

		include 'menu.php';
		include 'addBook.php';
		include "editBook.php"; // modal to edit book
		include "deleteBook.php"; // modal to confirm deleting book
		include "importBook.php";
		include "bookDetails.php";
	?>

    <div class="content">
		<div class="header">
			<h1>Book List</h1>
			<div class="numOf">
				<h5 class="card-text">
					Books Registered:&nbsp;
					<?php
						$sql = "SELECT SUM(stock) AS 'bookno' FROM books WHERE display = 1";
						$result = mysqli_query($conn, $sql);

						if (!$result) {
							echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
						}

						if (mysqli_num_rows($result) > 0) {  
							$row = mysqli_fetch_assoc($result);
							$bookno = $row["bookno"];
						}

						echo "<b>" . $bookno . "</b>";				
						mysqli_close($conn);
					?>
					&nbsp;&nbsp;
				</h5>

				<!-- Trigger the modal with a button -->
				<button id="btn-blue" type="button" class="btn  btn-outline-light" data-toggle="modal" data-target="#addbook" onclick="clearModal();">
					<i class="fas fa-plus"></i>&nbsp;&nbsp;Add Book
				</button>

				<button id="btn-green" type="button" class="btn btn-outline-light " data-toggle="modal" data-target="#import">
					<i class="fas fa-upload"></i>&nbsp;&nbsp;Import Data
				</button>

				<!-- Export booklist -->
				<form action="./exportBooklist.php" method="GET" style="display: inline-block">
					<button id="btn-teal" type="submit" class="btn  btn-outline-light" name="export">
						<i class="fas fa-download"></i>&nbsp;&nbsp;Export Data
					</button>
				</form>
			</div>
		</div>		
		
		<div class="block block-top">
			<table id="booklist" class="display" border=1 rules=none>
				<thead>
					<tr>
						<th>ID</th>
						<th></th>
						<th>Title</th>
						<th>Author(s)</th>
						<th>ISBN</th>
						<th>Copies</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>ID</th>
						<th></th>
						<th>Title</th>
						<th>Author</th>
						<th>ISBN</th>
						<th>Copies</th>
						<th></th>
						<th></th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</body>
</html>