<?php
session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}

$data = mysqli_query($conn, "SELECT * FROM kategori ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Kategori</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="navbar">
    <div class="brand">PERPUSTAKAAN</div>
    <div>
        Hi, <?= $_SESSION['username']; ?>
        <a href="../auth/logout.php" class="logout">Logout</a>
    </div>
</div>

<div class="container">

    <div class="header-card">
        <div class="header-flex">
            <h2>Data Kategori</h2>
            <div>
                <a href="tambah.php" class="btn btn-add">+ Tambah</a>
                <a href="../data_buku.php" class="btn btn-add">Kembali</a>
            </div>
        </div>
    </div>

    <?php if(isset($_SESSION['success'])): ?>
        <div class="alert success">
            <?= $_SESSION['success']; ?>
        </div>
    <?php unset($_SESSION['success']); endif; ?>

    <div class="card">
        <table>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>

            <?php $no=1; while($row=mysqli_fetch_assoc($data)) { ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nama_kategori']; ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-edit">Edit</a>
                    <a href="hapus.php?id=<?= $row['id']; ?>" 
                       class="btn btn-delete"
                       onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>

</div>
</body>
</html>

