<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
  header('Location: index.php');
  exit;
}

include("./config/database.php");

$nim = $_GET['nim'];

$sql = "DELETE FROM mahasiswa WHERE nim=$nim";
if ($con->query($sql) === TRUE) {
  echo "Record deleted successfully";
  header('Location: mahasiswa.php');
} else {
  echo "Error deleting record: " . $conn->error;
}
