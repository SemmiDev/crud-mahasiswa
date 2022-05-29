<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit;
}

include("./config/database.php");

if (isset($_POST['submit'])) {
	$nim = $_POST['nim'];
	$nama = $_POST['nama'];
	$prodi = $_POST['prodi'];
	$email = $_POST['email'];
	$agama = $_POST['agama'];
	$status = $_POST['status'];
	$alamat = $_POST['alamat'];

	$sql = "INSERT INTO mahasiswa(nim,nama,prodi,email,agama,status,alamat) VALUES ('$nim', '$nama', '$prodi', '$email', '$agama', '$status', '$alamat')";

	if ($con->query($sql) === TRUE) {
		echo "data berhasil disimpan";
		header('Location: mahasiswa.php');
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Tambah Data Mahasiswa</title>
	<link href="style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>

<body class="loggedin">
	<nav class="navtop">
		<div>
			<h1>Sistem Informasi Akademik</h1>
			<a href="profile.php"><i class="fas fa-user-circle"></i><?= $_SESSION['name'] ?></a>
			<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
		</div>
	</nav>
	<div class="content">
		<h2>Tambah Data Mahasiswa</h2>
		<form action="tambah_data_mahasiswa.php" method="post" accept-charset="utf-8">
			<input type="text" name="nim" placeholder="Masukkan NIM" required><br>
			<input type="text" name="nama" placeholder="Masukkan Nama" required><br>
			<select name="prodi" required>
				<option value="">Prodi</option>
				<option value="SI">SI</option>
				<option value="MI">MI</option>
			</select><br>
			<input type="email" name="email" placeholder="Masukkan Email" required><br>
			<select name="agama" required>
				<option value="" selected>Agama</option>
				<option value="Islam">Islam</option>
				<option value="Kristen">Kristen</option>
				<option value="Buddha">Buddha</option>
			</select>
			<select name="status" required>
				<option value="" selected>Status</option>
				<option value="Aktif">Aktif</option>
				<option value="Cuti">Cuti</option>
			</select><br>

			<textarea name="alamat" placeholder="Alamat..." required></textarea><br><br>
			<button type="submit" name="submit">Simpan</button>
		</form>
	</div>
</body>

</html>