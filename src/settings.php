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
	<link rel="icon" href="../images/logo3.png" type="image/gif" sizes="16x16" />
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
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/solid.css" integrity="sha384-wnAC7ln+XN0UKdcPvJvtqIH3jOjs9pnKnq9qX68ImXvOGz2JuFoEiCjT8jyZQX2z" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css" integrity="sha384-HbmWTHay9psM8qyzEKPc8odH4DsOuzdejtnr+OFtDmOcIVnhgReQ4GZBH7uwcjf6" crossorigin="anonymous" />
	
	<script type="text/javascript">
		function active() {
			var currentTab = document.getElementById('a6');
			currentTab.classList.add('active-tab');
		}

		window.onload = function() {
			active();
		}

		// edit user modal
		function editUser(user_id, username, email, access, date_added) {
			$('#userId').val(user_id);
			$('#username').val(username);
			$('#editEmail').val(email);
			//$('#access').val(access);
			$("#editUserForm select").val(access);
			$('#dateAdded').val(date_added);
		}

		// delete user modal
		function deleteUser(user_id, username, email, access, date_added) {
			$('#del-userId').val(user_id);
			$('#del-username').val(username);
			$('#del-email').val(email);
			$('#del-access').val(access);
			$('#del-dateAdded').val(date_added);
		}

		// recover student modal
		function restoreStudent(srno, Class, name, roll_no, date_added) {
			$('#rest-srno').val(srno);
			$('#rest-class').val(Class);
			$('#rest-name').val(name);
			$('#rest-rollNo').val(roll_no);
			$('#rest-dateAdded').val(date_added);
		}

		function restoreBook(srno, title, author, isbn, stock, date_added) {
			$('#restb-srno').val(srno);
			$('#restb-title').val(title);
			$('#restb-author').val(author);
			$('#restb-isbn').val(isbn);
			$('#restb-stock').val(stock);
			$('#restb-dateAdded').val(date_added);
		}
	</script>
</head>

<body>
	<?php
		include 'common.php';
		$conn = connect_db();


		include 'menu.php';

		$user_id = $_SESSION['user_id'];
		$sql = "SELECT username, password, email FROM users WHERE user_id = $user_id";
		$result = mysqli_query($conn, $sql);
		if (!$result) {
			echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
		}

		if (mysqli_num_rows($result) > 0) {  
			$row = mysqli_fetch_assoc($result);
			$username = $row["username"];
			$password = $row["password"];
			$email = $row["email"];
		}

		for($i=0; $i<strlen($password); $i++) {
			$password[$i] = '*';
		}
	?> 
    
	<div class="content">
		<?php
			include 'settings/editPassword.php';
			include 'settings/editEmail.php';
			include 'settings/addUser.php';
			include 'settings/editUser.php';
			include 'settings/deleteUser.php';
			include 'settings/restoreStudent.php';
			include 'settings/restoreBook.php';
		?>

		<div class="header">
			<h1>Settings</h1>
		</div>

		<!--==============================================================
			User Panel
		===============================================================-->
		<div class="block block-top">
			<h4>About the user</h4> 

			<div style="display: inline-block; text-align: center; min-width: 100px; padding: 10px; color: #495057">
				<i class="fas fa-user-circle" style="font-size: 3em;"></i>
				<br/>
				<?= $username ?>
			</div>

			<div style="display: inline-block; vertical-align: top; min-width: 500px; padding: 10px;">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1" style="width: 125px">
							<i class="fas fa-id-card"></i>&nbsp;&nbsp;
							User ID
						</span>
					</div>
					<input type="text" class="form-control" value="<?= $user_id ?>" aria-describedby="basic-addon1" readonly>
				</div>
				
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1" style="width: 125px">
							<i class="fas fa-key"></i>&nbsp;&nbsp;
							Password
						</span>
					</div>
					<input id="pass" type="password" class="form-control" value="<?= $password ?>" aria-describedby="basic-addon1" readonly>
					<div class="input-group-append">
						<button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#editPassModal"><i class="fas fa-edit"></i></button>
					</div>
				</div>

				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1" style="width: 125px">
							<i class="fas fa-envelope"></i> &nbsp;&nbsp;
							Email
						</span>
					</div>
					<input id="email" type="text" class="form-control" value="<?= $email ?>" aria-describedby="basic-addon1" readonly>
					<div class="input-group-append">
						<button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#editEmailModal"><i class="fas fa-edit"></i></button>
					</div>
				</div>
			</div>
		</div>

		<!--===============================================================
			Users Table
		================================================================-->
		<div class="block">
			<h4 style="display: inline-block">All users</h4>
			<button class="btn btn-primary" data-toggle="modal" data-target="#addUser" style="float: right;">
				<i class="fas fa-user-plus"></i>&nbsp;&nbsp;Add user
			</button>

			<table id="users" class="display" border=1 rules=none>
				<thead>
					<tr>
						<th>ID</th>
						<th>Username</th>
						<th>Email</th>
						<th>Access</th>
						<th>Date added</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				</tbody>
				<tfoot>
					<tr>
						<th>ID</th>
						<th>Username</th>
						<th>Email</th>
						<th>Access</th>
						<th>Date added</th>
						<th></th>
						<th></th>
					</tr>
				</tfoot>						
			</table>
		</div>


		<!--===============================================================
			Recover students table
		===================================================================-->
		<div class="block">
			<h4>Recover deleted students</h4>

			<table id="students" class="display" border=1 rules=none>
				<thead>
					<tr>
						<th>ID</th>
						<th>Class</th>
						<th>Name</th>
						<th>Roll No.</th>
						<th>Date added</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				</tbody>
				<tfoot>
					<tr>
						<th>ID</th>
						<th>Class</th>
						<th>Name</th>
						<th>Roll No.</th>
						<th>Date added</th>
						<th></th>
					</tr>
				</tfoot>						
			</table>
		</div>

		<!--===============================================================
			Recover books table
		===================================================================-->
		<div class="block">
			<h4>Recover deleted books</h4>

			<table id="books" class="display" border=1 rules=none>
				<thead>
					<tr>
						<th>ID</th>
						<th>Title</th>
						<th>Author</th>
						<th>ISBN</th>
						<th>Copies</th>
						<th>Date added</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				</tbody>
				<tfoot>
					<tr>
						<th>ID</th>
						<th>Title</th>
						<th>Author</th>
						<th>ISBN</th>
						<th>Copies</th>
						<th>Date added</th>
						<th></th>
					</tr>
				</tfoot>						
			</table>
		</div>
	</div>


	<script>

		/*================================================================
			Users DataTable
		*=================================================================*/
		$(document).ready( function () {
			// Setup - add a text input to each footer cell
			
			$('#users thead tr').clone(true).appendTo( '#users thead' );
			$('#users thead tr:eq(1) th').each( function (i) {
				var title = $(this).text();

				if(i!=0&&i<5)
					$(this).html( '<input type="text" placeholder="Search '+title+'" />' );
				else
					$(this).html('');
		
				$( 'input', this ).on( 'keyup change', function () {
					if ( userTable.column(i).search() !== this.value ) {
						userTable
							.column(i)
							.search( this.value )
							.draw();
					}
				} ); 
			} );
			
			var userTable = $('#users').DataTable({
				'order': [[ 3, "asc" ]],
				"lengthMenu": [5, 10, 25, 50],
				'orderCellsTop': true,
				'ajax': {
					'type': 'POST',
					'url': 'serverside/userServerSide.php',
					'data': {
						user_id: <?= $user_id ?>
					}
				},

				'columnDefs': [
					{
						"targets": 5,
						"className": "text-center",
						"orderable": false
					},
					{
						"targets": 6,
						"className": "text-center",
						"orderable": false
					}
				]
			});
		});

		/*================================================================
			Recover students DataTable
		*=================================================================*/

		$(document).ready( function () {
			// Setup - add a text input to each footer cell
			
			$('#students thead tr').clone(true).appendTo( '#students thead' );
			$('#students thead tr:eq(1) th').each( function (i) {
				var title = $(this).text();

				if(i!=0&&i<5)
					$(this).html( '<input type="text" placeholder="Search '+title+'" />' );
				else
					$(this).html('');
		
				$( 'input', this ).on( 'keyup change', function () {
					if ( studentTable.column(i).search() !== this.value ) {
						studentTable
							.column(i)
							.search( this.value )
							.draw();
					}
				} ); 
			} );
			
			var studentTable = $('#students').DataTable({
				'order': [[ 3, "asc" ]],
				"lengthMenu": [5, 10, 25, 50],
				'orderCellsTop': true,
				'ajax': "serverside/restStudServerSide.php",
				'columnDefs': [
					{
						"targets": 5,
						"className": "text-center",
						"orderable": false
					}
				]
			});
		});
		
		/*================================================================
			Recover books DataTable
		*=================================================================*/

		$(document).ready( function () {
			// Setup - add a text input to each footer cell
			
			$('#books thead tr').clone(true).appendTo( '#books thead' );
			$('#books thead tr:eq(1) th').each( function (i) {
				var title = $(this).text();

				if(i!=0&&i<6)
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
			
			var bookTable = $('#books').DataTable({
				'order': [[ 3, "asc" ]],
				"lengthMenu": [5, 10, 25, 50],
				'orderCellsTop': true,
				'ajax': "serverside/restBookServerSide.php",
				'columnDefs': [
					{
						"targets": 6,
						"className": "text-center",
						"orderable": false
					}
				]
			});
		});


	</script>



</body>
</html>