<?php
session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM kategori WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    mysqli_query($conn, "UPDATE kategori SET nama_kategori='$nama' WHERE id='$id'");
    $_SESSION['success'] = "Kategori berhasil diupdate!";
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Buku</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="form-wrapper">
    <div class="form-card">

        <h2>Edit Kategori</h2>

        <form method="POST">
            <div class="form-group">
                <input type="text" name="nama" 
                       value="<?= $row['nama_kategori']; ?>" required>
            </div>

            <div class="form-action">
                <button type="submit" name="update" class="btn btn-edit">Update</button>
                <a href="index.php" class="btn btn-back">Kembali</a>
            </div>
        </form>

    </div>
</div>

</body>
</html>