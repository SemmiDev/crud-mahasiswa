<?php

include './config/database.php';

$errorMessage = '';

if (isset($_POST['register-submit'])) {
	if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE email = ?')) {
		$stmt->bind_param('s', $_POST['email']);
		$stmt->execute();
		$stmt->store_result();
		if ($stmt->num_rows > 0) {
			$errorMessage =  'Email telah terdaftar';
		} else {
			if ($stmt = $con->prepare('INSERT INTO accounts (email,password) VALUES (?,?)')) {
				$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
				$stmt->bind_param('ss', $_POST['email'], $password);
				$stmt->execute();
				header('Location: index.php');
			} else {
				$errorMessage =  'Could not prepare statement!';
			}
		}
	} else {
		$errorMessage =  'Could not prepare statement!';
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Register</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<div class="register">
		<h1>Register</h1>
		<p style="color: darkred; font-style: italic; text-align: center;" id="error"> <?= $errorMessage ?> </p>

		<script>
			setTimeout(function() {
				var elem = document.getElementById("error");
				elem.parentNode.removeChild(elem);
			}, 1000);
		</script>

		<form action="register.php" method="post" autocomplete="off">
			<label for="email">
				<i class="fas fa-envelope"></i>
			</label>
			<input type="email" name="email" placeholder="Email" id="email" required>
			<label for="email">
				<i class="fas fa-user"></i>
			</label>
			<input type="password" name="password" placeholder="Password" id="password" required>
			<span style="color: gray;">Sudah punya akun? Silahkan <a href="index.php" style="text-decoration: none; color: #45b39d; font-weight: bold;">Login</a></span>
			<input type="submit" name="register-submit" value="Register">
		</form>
	</div>
</body>

</html>