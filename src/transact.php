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
			$('#transact thead tr').clone(true).appendTo( '#transact thead' );
			$('#transact thead tr:eq(1) th').each( function (i) {
				var title = $(this).text();

				if(i<2||i==3)
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
			
			var table = $('#transact').DataTable({
				'orderCellsTop': true,
				'ajax': 'serverside/transactServerSide.php',
				'columnDefs': [
					{
						'targets': 0,
						'width': '20%'
					},
					{
						"targets": 2,
						"className": "text-center"
					},
					{
						'targets': 3,
						'width': '50%'
					},
					{
						"targets": 4,
						"className": "text-center",
						"width": "100px",
						"orderable": false
					}
				]
			});
		});	

		function showModal(srno) {
			 document.getElementById('srno').value = srno;
		}

		function active() {
			var currentTab = document.getElementById('a1');
			currentTab.classList.add('active-tab');
		}

		window.onload = function() {
			active();
		}

		function check() {
			if(document.getElementById('table').style.visibility == "hidden") {
				document.getElementById('searchName').style.visibility = "hidden";
			}
		}


		/*		Functions to make the "Sure?" option possible
		 * 		Pretty inefficient but it manages to work so I'm not touching it
		 */	
		var activated=0;
		var selectedTrno;

		function confirm(button, trno) {
			button.classList.remove("btn-outline-primary");
			button.classList.add("btn-primary", "selected");
			button.innerHTML = "Sure?";
			button.setAttribute( "onClick", "runReturnAjax(" + trno + "); return false;" );
			
				selectedTrno = trno;
			activated++;
		}
		
		$(window).click(function(e) {
			
			var attr = "";
			if(e.target.hasAttribute("onclick")) {
				var attr = e.target.getAttribute("onclick");
				if(attr === "runReturnAjax(" + selectedTrno + "); return false;" && activated == 1){
					e.preventDefault();
					return;
				}
			}

			if(attr !== "")
				attr = attr.substring(0,3);

			if(activated>0) {
				var buttons = document.querySelectorAll(".selected");
				var button;	
				for(var i=0; i<buttons.length; i++) {
					if(buttons[i] != e.target)
						button = buttons[i];
				}
				button.classList.remove("btn-primary", "selected");
				button.classList.add("btn-outline-primary");
				button.innerHTML = "Return";
				var func = button.getAttribute("onclick");
				var newFunc = "confirm(this," + func.slice(14);

				button.setAttribute( "onClick", newFunc );
				//if(attr !== "run")
					activated--;
			}
		});

		/*************** Function to run ajax to return book ********************/		
		function runReturnAjax(returnId) {
			var data = $("#returnBookForm" + returnId).serialize();
			$.ajax({
				data: data,
				type: "post",
				url: "returnBookAction.php",
				error: function(err) {
					alert(err);
				},
				success: function() {
					$('#transact').DataTable().ajax.reload();
				}
			});
		};

	</script>
</head>

<body>
	<?php 
		include 'common.php';
		$conn = connect_db();
		include 'menu.php';
		include 'borrowBook.php';	// modal to borrow book
	?>

    <div class="content">
		<div class="header">
			<h1>Issue/Return</h1>
			<div class="numOf" style="float: none; text-align: right;">
				<h5 class="card-text">
					Books Issued:&nbsp;
					<?php
						$sql = "SELECT COUNT(*) AS issued "
							. " FROM transaction_record t, students s, books b"
							. " WHERE date_returned IS NULL AND t.student_srno = s.srno AND t.book_srno = b.srno"
							. " AND b.display = 1 AND s.display = 1";
						
						$result = mysqli_query($conn, $sql);

						if (!$result) {
							echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
						}

						if (mysqli_num_rows($result) > 0) {  
							$row = mysqli_fetch_assoc($result);
							$issued = $row["issued"];
						}

						echo "<b>" . $issued . "</b>";				
					?>

					&emsp;Books in Stock:&nbsp;
					<?php
						$sql = "SELECT SUM(stock) AS total FROM books WHERE display = 1";
						$result = mysqli_query($conn, $sql);

						if (!$result) {
							echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
						}

						if (mysqli_num_rows($result) > 0) {  
							$row = mysqli_fetch_assoc($result);
							$total = $row["total"];
						}

						$stock = $total - $issued;

						echo "<b>" . $stock . "</b>";				
						mysqli_close($conn);
					?>
				</h5>
			</div>
		</div>
		
		<div class="block block-top">
			<table id="transact" class="display" border=1 rules=none>
				<thead>
					<tr>
						<th>Name</th>
						<th>Class</th>
						<th>Roll No. </th>
						<th>Books</th>
						<th></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Name</th>
						<th>Class</th>
						<th>Roll No.</th>
						<th>Books</th>
						<th></th>
					</tr>
				</tfoot>
			</table>
		</div>

	</div>
</body>

</html>