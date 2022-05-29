<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}

include './config/database.php';

$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();

?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Profile Page</title>
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>

<body class="loggedin">
	<nav class="navtop">
		<div>
			<h1>SIA</h1>
			<a href="profile.php"><i class="fas fa-user-circle"></i><?= $email ?></a>
			<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
		</div>
	</nav>
	<div class="content">
		<h2>Profile Page</h2>
		<div>
			<table>
				<tr>
					<td>Password:</td>
					<td><?= $password ?></td>
				</tr>
				<tr>
					<td>Email:</td>
					<td><?= $email ?></td>
				</tr>
			</table>
		</div>
	</div>
</body>

</html>