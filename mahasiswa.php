<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
     header('Location: index.php');
     exit;
}

include("./config/database.php");
?>

<!DOCTYPE html>
<html>

<head>
     <meta charset="utf-8">
     <title>Data Mahasiswa</title>
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
          <h2>Data Mahasiswa</h2>

          <?php
          echo "<table border='0' cellpadding='3' cellspacing='3' width='100%'>
              <tr>
              <td colspan=4>
              		<a href='tambah_data_mahasiswa.php'><button style='padding: 3px'>Tambah Data</button></a></td>
              <td colspan=4 style='text-align:right;'>
            </table>";
          $no = 1;
          $qry = mysqli_query($con, "SELECT COUNT(*) as total FROM mahasiswa");
          if ($data = mysqli_fetch_array($qry)['total'] != 0) {
               $qry = mysqli_query($con, "SELECT * FROM mahasiswa");
               while ($data = mysqli_fetch_array($qry)) {


                    echo "<table border='1' cellpadding='3' cellspacing='3' width='100%'>
              <tr style='text-align:center;'><td>NO</td><td>NIM</td>
              		<td>NAMA</td><td>PRODI</td>
              		<td>EMAIL</td><td>AGAMA</td>
              		<td>STATUS</td><td>ALAMAT</td><td>PROSES</td>
              </tr>";

                    echo "<tr>
	            <td>$no</td>
	            <td>$data[nim]</td>
	            <td>$data[nama]</td>
	            <td>$data[prodi]</td>
	            <td>$data[email]</td>
	            <td>$data[agama]</td>
	            <td>$data[status]</td>
	            <td>$data[alamat]</td>
	            <td align='center'>
	            	<a href='edit_data_mahasiswa.php?nim=$data[nim]'><button>Edit</button></a>
	            	<a href='hapus_data_mahasiswa.php?nim=$data[nim]'><button>Delete</button></a>
	       	</td>
	       	</tr>";
                    $no++;
               }
          } else {
               echo "<h3>Data Mahasiswa Kosong!</h3>";
          }
          echo "</table>";
          ?>
     </div>
</body>

</html>