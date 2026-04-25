<?php
session_start();
include "config/koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: auth/login.php");
    exit;
}

/* ✅ SUDAH JOIN KATEGORI */
$buku = mysqli_query($conn, "
SELECT buku.*, kategori.nama_kategori 
FROM buku 
LEFT JOIN kategori 
ON buku.kategori_id = kategori.id
ORDER BY buku.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Buku</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <div class="brand">PERPUSTAKAAN</div>

    <div class="nav-right">
        Hi, <b><?= htmlspecialchars($_SESSION['username']); ?></b>
        <a href="auth/logout.php" class="btn btn-delete">Logout</a>
    </div>
</div>

<div class="container">

    <!-- HEADER -->
    <div class="header-card">
        <div class="header-flex">
            <h2>Data Buku</h2>

            <div class="aksi">
                <a href="buku/tambah.php" class="btn btn-add">+ Tambah Buku</a>
                <a href="kategori/index.php" class="btn btn-add">Kelola Kategori</a>
            </div>
        </div>
    </div>

    <!-- ALERT -->
    <?php if(isset($_SESSION['success'])): ?>
        <div class="alert success">
            <?= $_SESSION['success']; ?>
        </div>
    <?php unset($_SESSION['success']); endif; ?>

    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert error">
            <?= $_SESSION['error']; ?>
        </div>
    <?php unset($_SESSION['error']); endif; ?>

    <!-- TABLE -->
    <div class="card">

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Tahun</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            <?php if(mysqli_num_rows($buku) > 0): ?>
                <?php $no = 1; ?>
                <?php while($row = mysqli_fetch_assoc($buku)) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['judul']); ?></td>
                    <td><?= htmlspecialchars($row['penulis']); ?></td>
                    <td><?= htmlspecialchars($row['tahun']); ?></td>

                    <!-- KATEGORI -->
                    <td>
                        <?= $row['nama_kategori'] ?? '-' ?>
                    </td>

                    <td class="aksi">
                        <a href="buku/edit.php?id=<?= $row['id']; ?>" class="btn btn-edit">Edit</a>
                        <a href="buku/hapus.php?id=<?= $row['id']; ?>"
                           class="btn btn-delete"
                           onclick="return confirm('Yakin ingin menghapus data ini?')">
                           Hapus
                        </a>
                    </td>
                </tr>
                <?php } ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="empty">
                        Belum ada data buku.
                    </td>
                </tr>
            <?php endif; ?>

            </tbody>
        </table>

    </div>

</div>

</body>
</html>