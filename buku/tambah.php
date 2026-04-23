<?php
session_start();
include "../config/koneksi.php";

// proses simpan
if(isset($_POST['submit'])) {

    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $tahun = $_POST['tahun'];

    $query = mysqli_query($conn,
        "INSERT INTO buku VALUES(NULL,'$judul','$penulis','$tahun')"
    );

    if($query){
        $_SESSION['success'] = "Data berhasil ditambahkan!";
    } else {
        $_SESSION['error'] = "Gagal menambahkan data!";
    }

    header("Location: ../data_buku.php");
    exit;
}
?>

<!-- FORM TAMBAH -->
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Buku</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="form-wrapper">
    <div class="form-card">

        <h2>Tambah Buku</h2>

        <form method="POST">

            <input type="text" name="judul" placeholder="Judul Buku" required>
            <input type="text" name="penulis" placeholder="Penulis" required>
            <input type="text" name="tahun" placeholder="Tahun" required>

            <button type="submit" name="submit">Simpan</button>

        </form>

        <a href="../data_buku.php" class="btn btn-back">Kembali</a>

    </div>
</div>

</body>
</html>