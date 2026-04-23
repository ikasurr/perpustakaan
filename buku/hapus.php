<?php
include "../config/koneksi.php";

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM buku WHERE id=$id");

// langsung ke dashboard
header("Location: ../data_buku.php");
exit;
?>