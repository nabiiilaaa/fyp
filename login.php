<?php include($_SERVER['DOCUMENT_ROOT'].'/ReadersZone/include/sessionCheckLogout.php');?>
<!DOCTYPE html>
<html>
<head>
	<title>Login and Registration Form</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="HandheldFriendly" content="true">
	<link rel="stylesheet" href="wwwroot/css/Login.css">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>

<!-------- Body ----------->

<body class="hero">
	<div>
		<div class="form-box">
			<center>
				<div class="button-box">
					<div id="btn"></div>
					<button type="button" class="toggle-btn" onclick="login()">Log In</button>
					<button type="button" class="toggle-btn" onclick="register()">Register</button>
				</div>
			</center>
			<form id="login" class="input-group">
				<input type="text" class="inout-field" name="UserNamel" placeholder="Username" autocomplete="off" required>
				<input type="password" class="inout-field" name="Passwordl" placeholder="Password" required>
				<input type="checkbox" class="check-box" onclick="ShowPassword(this)"><span>Show Password</span>
				<h1 style="color: transparent; font-size: 12px;" onclick="forgetpass()">Forgot Password?</h1>
				<input type="button" name="submit" value="login" onclick="CheckLogin()" class="submit-btn">
			</form>
			<form id="register" class="input-group">
				<input type="text" class="inout-field" name="UserName" placeholder="Username" autocomplete="off" required>
				<input type="password" class="inout-field" name="Password" placeholder="Password" required>
				<input type="email" class="inout-field" name="Email" placeholder="Email" autocomplete="off" required>
				<input type="checkbox" class="check-box" id="tac"><span1>I Agree to the Terms and Conditions</span1>
				<input type="button" name="submit" value="Sign Up" onclick="Insert()" class="submit-btn">
			</form>
		</div>
	</div>
	<script src="/ReadersZone/wwwroot/js/login.js"></script>
</body>
</html>