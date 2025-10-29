<?php
session_start();
require "kdb.php";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $res = $kdb->query($query);

    if ($res->num_rows > 0) {
        $user = $res->fetch_assoc();
        $_SESSION['unique_id'] = $user['unique_id'];

        $kdb->query("UPDATE users SET status='Active now' WHERE unique_id='{$user['unique_id']}'");

        // pastikan tidak ada output sebelum ini
        header("Location: chat/chat.php");
        exit;
    } else {
        echo "<script>alert('Email atau kata sandi salah!');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/signin.css">
</head>
<body>
    <form action="" method="POST">
        <div class="container">
            <div class="signin">
                <h2 class="title">Masuk ke Akun</h2>

                <input type="text" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Kata Sandi" required>

                <input type="submit" name="login" value="Masuk" class="btn-signin">

                <p>Belum punya akun? <a href="signin.php">Daftar di sini</a></p>
            </div>
        </div>
    </form>
</body>
</html>
