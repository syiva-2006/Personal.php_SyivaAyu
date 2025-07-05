<?php
include('../koneksi.php');
session_start();
if (!isset($_SESSION['username'])) {
  header('location:login.php');
  exit;
}

$id = $_GET['id'];
$query = mysqli_query($db, "DELETE FROM tbl_komentar WHERE id_komentar = '$id'");

if ($query) {
  echo "<script>alert('Komentar berhasil dihapus'); window.location='komentar.php';</script>";
} else {
  echo "<script>alert('Gagal menghapus'); history.back();</script>";
}
?>

