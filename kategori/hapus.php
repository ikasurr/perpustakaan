<?php
session_start();
include "../config/koneksi.php";

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM kategori WHERE id='$id'");

$_SESSION['success'] = "Kategori berhasil dihapus!";
header("Location: index.php");
exit;