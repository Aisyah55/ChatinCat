<?php
require "kdb.php";

if (isset($_POST['signup'])) {
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $unique_id = rand(time(), 100000000);
    $status = "Active now";

    $query = "INSERT INTO users (unique_id, fname, email, password, status)
              VALUES ('$unique_id', '$fname', '$email', '$password', '$status')";
    $res = $kdb->query($query);

    if ($res) {
        echo "<script>alert('Registrasi berhasil!'); document.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Registrasi gagal!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Registrasi</title>
    <link rel="stylesheet" href="css/signin.css">
</head>
<body>
    <form action="" method="POST">
        <div class="container">
            <div class="signin">
                <h2 class="title">Form Registrasi</h2>

                <input type="text" name="fname" placeholder="Nama Lengkap" required>
                <input type="text" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Kata Sandi" required>

                <input type="submit" name="signup" value="Daftar" class="btn-signin">

                <p>Sudah punya akun? <a href="login.php">Masuk di sini</a></p>
            </div>
        </div>
    </form>
</body>
</html>
