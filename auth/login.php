<?php
session_start();
include "../config/koneksi.php";

// kalau sudah login, langsung ke dashboard
if(isset($_SESSION['login'])){
    header("Location: ../data_buku.php");
    exit;
}

// PROSES LOGIN
if(isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    $data = mysqli_fetch_assoc($query);

    if($data && password_verify($password, $data['password'])) {

        $_SESSION['login'] = true;
        $_SESSION['username'] = $data['username'];

        header("Location: ../data_buku.php");
        exit;

    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="login-wrapper">
    <div class="login-card">

        <h2>Login</h2>

        <?php if(isset($error)) { ?>
            <p style="color:red;"><?= $error; ?></p>
        <?php } ?>

        <form method="POST">

            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>

            <button type="submit" name="login">Login</button>

        </form>

    </div>
</div>

</body>
</html>