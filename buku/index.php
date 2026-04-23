<?php
session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}

$data = mysqli_query($conn, "SELECT * FROM buku");
?>

<h2>Data Buku</h2>

<a href="tambah.php">Tambah</a> |
<a href="../data_buku.php">Dashboard</a> |
<a href="../auth/logout.php">Logout</a>

<br><br>

<table border="1">
<tr>
    <th>Judul</th>
    <th>Penulis</th>
    <th>Tahun</th>
    <th>Aksi</th>
</tr>

<?php while($row = mysqli_fetch_assoc($data)) { ?>
<tr>
    <td><?= $row['judul']; ?></td>
    <td><?= $row['penulis']; ?></td>
    <td><?= $row['tahun']; ?></td>
    <td>
        <a href="edit.php?id=<?= $row['id']; ?>">Edit</a>
        <a href="hapus.php?id=<?= $row['id']; ?>">Hapus</a>
    </td>
</tr>
<?php } ?>
</table>