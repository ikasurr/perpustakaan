<?php
session_start();
include "../config/koneksi.php";

/* ✅ AMBIL DATA KATEGORI (WAJIB) */
$kategori = mysqli_query($conn, "SELECT * FROM kategori");

/* PROSES SIMPAN */
if(isset($_POST['submit'])) {

    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $tahun = $_POST['tahun'];
    $kategori_id = $_POST['kategori_id'];

    $query = mysqli_query($conn, "
        INSERT INTO buku (judul, penulis, tahun, kategori_id)
        VALUES ('$judul', '$penulis', '$tahun', '$kategori_id')
    ");

    if($query){
        $_SESSION['success'] = "Data berhasil ditambahkan!";
    } else {
        $_SESSION['error'] = "Gagal menambahkan data!";
    }

    header("Location: ../data_buku.php");
    exit;
}
?>

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

            <!-- 🔥 DROPDOWN KATEGORI -->
            <div class="card">
                <select name="kategori_id" class="kategori" required>
                    <option value="" disabled selected>-- Pilih Kategori --</option>
                    <?php while($k = mysqli_fetch_assoc($kategori)) { ?>
                        <option value="<?= $k['id']; ?>">
                            <?= $k['nama_kategori']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <!-- 🔥 BUTTON SIMPAN -->
            <button type="submit" name="submit" class="btn btn-add" style="margin-top:15px;">
                Simpan
            </button>

        </form>

        <!-- BACK BUTTON -->
        <a href="../data_buku.php" class="btn btn-back" style="margin-top:10px;">
            Kembali
        </a>

    </div>
</div>

</body>
</html>