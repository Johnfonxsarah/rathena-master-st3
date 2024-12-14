<?php
	session_start();
	header("content-type: text/html; charset=UTF-8");
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login Refill Center</title>
	<meta name="robots" content="index,follow">
	<meta name="googlebots" content="index,follow" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="css/style.css" rel="stylesheet">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="system/system.min.js"></script>
</head>

<body>
	<div class="container">
		<form id="loginForm" action="member.php" method="post">
			<div class="row">
				<div class="col-md-6 mx-auto mt-5" style="margin-top: 10rem!important;">
					<div class="card animated bounceInDown">
						<div class="card-header text-center">
							<h5><b>Refill Login</b></h5>
							<h6>เข้าสู่ระบบเติมเงิน</h6>
							<h6 style="color:red">*** ไม่สามารถโอนผ่าน True Wallet และ ธนาคาร UOB ได้ ***</h6>
						</div>
						<div class="card-body">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-user"></i></span>
								</div>
								<input type="text" class="form-control" id="txtUsername" onkeypress="return text_only(event);" name="txtUsername" placeholder="ไอดีเกมของคุณ">
							</div>
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fa fa-lock"></i></span>
								</div>
								<input type="password" class="form-control" id="txtPassword" onkeypress="return text_only(event);" name="txtPassword" placeholder="รหัสผ่านของคุณ">
							</div>
						</div>
						<div class="card-footer text-center">
							<button type="button" class="btn btn-success btn-block" onclick="doCallAjaxLogin();">Login</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</body>
<script>
	document.onkeydown = chkEvent

	function chkEvent(e) {
		var keycode;
		if (window.event) keycode = window.event.keyCode; //*** for IE ***//
		else if (e) keycode = e.which; //*** for Firefox ***//
		if (keycode == 13) {
			setTimeout(function() {
				doCallAjaxLogin();
			}, 5);
		}
	}
</script>

</html>