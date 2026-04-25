<?php
session_start();
include "../config/koneksi.php";

$kategori = mysqli_query($conn, "SELECT * FROM kategori");
// AMBIL DATA UNTUK FORM
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM buku WHERE id='$id'"));

// PROSES UPDATE
if(isset($_POST['submit'])) {

    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $tahun = $_POST['tahun'];
    $kategori_id = $_POST['kategori_id'];

    $update = mysqli_query($conn,
        "UPDATE buku 
         SET judul='$judul', penulis='$penulis', tahun='$tahun', kategori_id= '$kategori_id'
         WHERE id='$id'"
    );

    if($update){
        $_SESSION['success'] = "Data berhasil diupdate!";
    } else {
        $_SESSION['error'] = "Gagal mengupdate data!";
    }

    header("Location: ../data_buku.php");
    exit;
}
?>

<!-- FORM EDIT -->
<!DOCTYPE html>
<html>
<head>
    <title>Edit Buku</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="form-wrapper">
    <div class="form-card">

        <h2>Edit Buku</h2>

        <form method="POST">

            <input type="hidden" name="id" value="<?= $data['id']; ?>">

            <input type="text" name="judul" value="<?= $data['judul']; ?>" required>
            <input type="text" name="penulis" value="<?= $data['penulis']; ?>" required>
            <input type="text" name="tahun" value="<?= $data['tahun']; ?>" required>
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
            <button type="submit" name="submit" class="btn btn-add" style="margin-top:15px;">
                Simpan
            </button>

        </form>

        <a href="../data_buku.php" class="btn btn-back">Kembali</a>

    </div>
</div>

</body>
</html>