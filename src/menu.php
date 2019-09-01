<script>
	function logoutAjax() {
			$.ajax({
				type: "post",
				url: "logoutAction.php",
				error: function(err) {
					alert(err);
				},
				success: function() {
					window.location.replace("login.php");
				}
			});
		}
</script>

<?php
// find username to display in sidenav
$user_id = $_SESSION['user_id'];
$sql = "SELECT username FROM users WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql);
if (!$result) {
	echo "Error: " . $sql . "<br/>" . mysqli_error($conn);
}

if (mysqli_num_rows($result) > 0) {  
	$row = mysqli_fetch_assoc($result);
	$username = $row["username"];
}
?>

<div class="sidenav">
	<a id="title" class="banner">
		<div style="margin: auto; width: fit-content; display: table">
			<img src="../images/logo3.png" id="logo"/>
			<h1 style="display: table-cell; vertical-align: middle; margin-bottom: 0; padding-left: 10px">Pacifica</h1>
		</div>
	</a>
	<div id="user" class="banner">
		<div style="margin: auto; width: fit-content; padding: 10px; text-align: center">
			<i class="fas fa-user-circle"></i>
			<div class="dropdown">
				<button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?= $username ?>
				</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					<a class="dropdown-item" onclick="logoutAjax();" href="logout">
						<i class="fas fa-sign-out-alt"></i>&nbsp;
						Log out
					</a>
				</div>
			</div>
		</div>
		
</div>
	<a href="index.php" id="a0">
		<i class="fas fa-home" style="margin-left: 21px; margin-right: 19px"></i>Home
	</a>
    <a href="transact.php" id="a1">
		<i class="fas fa-exchange-alt" style="margin-left: 22px; margin-right: 22px"></i>Issue/Return
	</a>
    <a href="studlist.php" id="a2" >
		<i class="fas fa-users" style="margin-left: 20px; margin-right: 19px"></i>Students
	</a>
	<a href="booklist.php" id="a3" >
		<i class="fas fa-book" style="margin-left: 23px; margin-right: 24px"></i>Books
	</a>
    <a href="pending.php" id="a4" >
		<i class="fas fa-exclamation-circle" style="margin-left: 22px"></i>
		<span style="margin-left: 18px;">
				Overdue

				<?php
						$sql = "SELECT COUNT(*) AS 'count'"
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
								$count = $row["count"];
						}

						if($count > 0)	
							echo "&nbsp;<span class='badge' style='background-color: #ff4765; color: white'>" . $count . "</span>";				
					?>
		</span>
	</a>
    <a href='history.php' id="a5" >
		<i class="fas fa-history" style="margin-left: 22px; margin-right: 22px;"></i>History
	</a>
	<a href="settings.php" id="a6"> 
	<i class="fas fa-cog" style="margin-left: 21px; margin-right: 22px;"></i>Settings
	</a>

	<div style="position: absolute; bottom: 20px; left: 35px; font-size: 14px; color: #78909C">
		&copy; 2019 Atharva Patil
	</div>

	<!--button id='logout' class='btn btn-primary' onclick="logoutAjax();">
		&nbsp;<i class="fas fa-sign-out-alt"></i>&nbsp;
		Log out
	</button-->
</div>
