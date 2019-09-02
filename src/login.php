
<?php
	session_start();

	if ( isset( $_SESSION['user_id'] ) ) {
		// Redirect them to the home page
		header("Location: index.php");
	} else {
		// nothing to do here
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Pacifica</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<!-- Favicon -->
	<link rel="icon" href="../images/logo3.png" type="image/gif" sizes="16x16">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/util.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
<!--===============================================================================================-->

	<script>
		function loginAjax() {
			var data = $("#login-form").serialize();
			$.ajax({
				data: data,
				dataType: "json",
				type: "post",
				url: "loginAction.php",
				error: function(err) {
					alert(err);
				},
				success: function(response) {
					if(response.status==="allowed")
						window.location.replace("index.php");
					else if(response.status==="denied") {
						$('head').append('<style>.focus-input100::before{background-image: -webkit-linear-gradient(left, orange, red) !important;}</style>');
						$('#denied').html('invalid credentials');
					}
				}
			});
		}
	</script>

</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div id="welcome">
				Welcome to
				<div id="pacifica">
					Pacifica
				</div>
			</div>
			<div class="wrap-login100">
				<form id="login-form" class="login100-form validate-form">
					<span class="login100-form-title p-b-40">
						<img src="../images/logo3.png" style="vertical-align: middle; height: 70px;"/>
						<br/>
					</span>
					<span class="login100-form-title p-b-30">
						<i class="zmdi zmdi-font"></i>
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="username" autocomplete="off">
						<span class="focus-input100" data-placeholder="Username"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password" autocomplete="off">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" onclick="loginAjax(); return false;">
								Login
							</button>
						</div>
					</div>
					

					<div class="text-center p-t-67">
					<div id='denied' style="height: 1em; margin-top: -50px; font-size: 13px; color: crimson"></div>
						<br/><br/>
						<span class="txt1">
							Forgot username/password
						</span>
						<br/>
						<a class="txt2" href="#">
							Send recovery email
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../js/main.js"></script>

</body>
</html>