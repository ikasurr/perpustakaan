<?php
session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    mysqli_query($conn, "INSERT INTO kategori (nama_kategori) VALUES ('$nama')");
    $_SESSION['success'] = "Kategori berhasil ditambahkan!";
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kategori</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="form-wrapper">
    <div class="form-card">

        <h2>Tambah Kategori</h2>

        <form method="POST">
            <div class="form-group">
                 <input type="text" name="nama" placeholder="nama kategori" required>
            </div>

            <div class="form-action">
                <button type="submit" name="simpan" class="btn btn-add">Simpan</button>
                <a href="index.php" class="btn btn-back">Kembali</a>
            </div>
        </form>

    </div>
</div>

</body>
</html>