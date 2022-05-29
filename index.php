<?php

session_start();

include './config/database.php';

$errorMessage = '';

if (isset($_POST['login-submit'])) {
	if (!isset($_POST['email'], $_POST['password'])) {
		exit('Please fill both the username and password fields!');
	}

	if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE email = ?')) {
		$stmt->bind_param('s', $_POST['email']);
		$stmt->execute();
		$stmt->store_result();
	}

	if ($stmt->num_rows > 0) {
		$stmt->bind_result($id, $password);
		$stmt->fetch();
		if (password_verify($_POST['password'], $password)) {
			session_regenerate_id();
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['name'] = $_POST['email'];
			$_SESSION['id'] = $id;
			header('Location: home.php'); // redirect page
		} else {
			$errorMessage =  'Email/password salah';
		}
	} else {
		$errorMessage =  'Email/password salah';
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div class="login">
		<h1>Login</h1>
		<p style="color: darkred; font-style: italic; text-align: center;" id="error"> <?= $errorMessage ?> </p>

		<script>
			setTimeout(function() {
				var elem = document.getElementById("error");
				elem.parentNode.removeChild(elem);
			}, 1000); // 1000 ms / 1 detik
		</script>

		<form action="index.php" method="post">
			<label for="email">
				<i class="fas fa-envelope"></i>
			</label>
			<input type="text" name="email" placeholder="Email" id="email" required>
			<label for="password">
				<i class="fas fa-lock"></i>
			</label>
			<input type="password" name="password" placeholder="Password" id="password" required>
			<span style="color: gray;">Belum punya akun? Silahkan <a href="register.php" style="text-decoration: none; color: #45b39d; font-weight: bold;">Register</a></span>
			<input type="submit" name="login-submit" value="Login">
		</form>
	</div>
</body>

</html>