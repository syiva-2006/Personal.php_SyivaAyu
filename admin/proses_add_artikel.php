<?php 
include('../koneksi.php'); 
session_start(); 
if (!isset($_SESSION['username'])) { 
  header('location:login.php'); 
  exit; 
} 
$judul = mysqli_real_escape_string($db, $_POST['nama_artikel']); 
$isi   = mysqli_real_escape_string($db, $_POST['isi_artikel']); 
$kategori = mysqli_real_escape_string($db, $_POST['kategori']);
$kategori = mysqli_real_escape_string($db, $_POST['kategori']);
$sql = "INSERT INTO tbl_artikel (nama_artikel, kategori, isi_artikel) VALUES 
('$judul', '$kategori', '$isi')"; 
$query = mysqli_query($db, $sql); 
 
if ($query) { 
  echo "<script>alert('Artikel berhasil ditambahkan.'); 
window.location='data_artikel.php';</script>"; 
} else { 
  echo "<script>alert('Gagal menambahkan artikel.'); 
history.back();</script>"; 
} 
?> 
