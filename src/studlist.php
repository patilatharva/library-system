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
	<link rel="stylesheet" type="text/css" href="../css/datatables.min.css">
	<!-- Bootstrap Stylesheet -->
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<!-- Common Custom Stylesheet -->
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
			$('#students thead tr').clone(true).appendTo( '#students thead' );
			$('#students thead tr:eq(1) th').each( function (i) {
				var title = $(this).text();

				if(i!=0&&i<4)
					$(this).html( '<input type="text" placeholder="Search '+title+'" />' );
				else
					$(this).html('');
		
				$( 'input', this ).on( 'keyup change', function () {
					if ( table.column(i).search() !== this.value ) {
						table
							.column(i)
							.search( this.value )
							.draw();
					}
				} ); 
			} );

			var table = $('#students').DataTable({
				'order': [[ 1, "asc" ]],
				'orderCellsTop': true,
				'ajax': "serverside/studentServerSide.php",
				'columnDefs': [
					{
						"targets": 4,
						"className": "text-center",
						"orderable": false

					},
					{
						"targets": 5,
						"className": "text-center",
						"orderable": false
					}
				]
			});
		});
	</script>
	<script type="text/javascript">
		function editModal(srno, sclass, roll_no, name) {
			document.getElementById('srno_php').value = srno;
			document.getElementById('class').value = sclass;
			document.getElementById('roll_no').value = roll_no;
			document.getElementById('name').value = name;
		}

		function deleteModal(srno, sclass, roll_no, name) {
			document.getElementById('del_srno').value = srno;
			document.getElementById('del_class').value = sclass;
			document.getElementById('del_roll_no').value = roll_no;
			document.getElementById('del_name').value = name;
		}

		function validateForm() {
			var sclass = document.forms["addStudent"]["class"].value;
			var roll_no = document.forms["addStudent"]["roll_no"].value;
			var name = document.forms["addStudent"]["name"].value;

			if(name==""||sclass==""||(sclass!="OTHER")&&roll_no=="") {
				alert("All fields must be filled out.");
				return false;
			}
		}

		function active() {
			var currentTab = document.getElementById('a2');
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
		include "editStudent.php";
		include "deleteStudent.php";
		include "addStudent.php";
		include "importStudent.php";
	?>

	<div class="content">
		<div class="header">
			<h1>Student List</h1>
				<span class="numOf">
					<h5 class="card-text">
						Students Registered:&nbsp;
						<?php
							$sql = "SELECT COUNT(*) AS 'studno' FROM students WHERE display = 1;";
							$result = mysqli_query($conn, $sql);

							if (!$result) {
								echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
							}

							if (mysqli_num_rows($result) > 0) {  
								$row = mysqli_fetch_assoc($result);
								$studno = $row["studno"];
							}

							echo "<b>" . $studno . "</b>";				
							mysqli_close($conn);
						?>
						&nbsp;&nbsp;
					</h5>
					<button id="btn-blue" type="button" class="btn btn-outline-light" data-toggle="modal" data-target="#addstud" onclick="clearModal();">
						<i class="fas fa-user-plus"></i>&nbsp;&nbsp;Add Student
					</button>

					<button id="btn-green" type="button" class="btn btn-outline-light " data-toggle="modal" data-target="#import">
						<i class="fas fa-upload"></i>&nbsp;&nbsp;Import Data
					</button>

					<!-- Export student list -->
					<form action="./exportStudentAction.php" method="GET" style="display: inline-block">
						<button id="btn-teal" type="submit" class="btn  btn-outline-light" name="export">
							<i class="fas fa-download"></i>&nbsp;&nbsp;Export Data
						</button>
					</form>
			</span>
		</div>
			
		<div class="block block-top">
			<table id="students" class="display" rules=none>
				<thead>
					<tr>
						<th>ID</th>
						<th>Class</th>
						<th>Roll no.</th>
						<th>Name</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				</tbody>
				<tfoot>
					<tr>
						<th>ID</th>
						<th>Class</th>
						<th>Roll no.</th>
						<th>Name</th>
						<th></th>
						<th></th>
					</tr>
				</tfoot>						
			</table>
		</div>

    </div>
</body>
</html>