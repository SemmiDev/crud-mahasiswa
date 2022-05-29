<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
     header('Location: index.php');
     exit;
}
?>

<!DOCTYPE html>
<html>

<head>
     <meta charset="utf-8">
     <title>Home Page</title>
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
          <h2>Home Page</h2>
          <p id="welcome">Selamat Datang, <?= $_SESSION['name'] ?>!</p>
         
          <ul>
               <li><a href="mahasiswa.php" style="text-decoration: none; font-weight: bold;">Kelola Data Mahasiswa</a></li>
               <li><a href="dosen.php" style="text-decoration: none; font-weight: bold;">Kelola Data Dosen</a></li>
               <li><a href="mata_kuliah.php" style="text-decoration: none; font-weight: bold;">Kelola Data Mata Kuliah</a></li>
          </ul>
     </div>
</body>

</html>