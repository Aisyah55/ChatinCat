<?php
session_start();
require "../kdb.php";

if (!isset($_SESSION['unique_id'])) {
    header("Location: login.php");
    exit;
}

$sql = mysqli_query($kdb, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
if (mysqli_num_rows($sql) > 0) {
    $row = mysqli_fetch_assoc($sql);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatCat</title>
    <link rel="stylesheet" href="../css/chat.css">
</head>
<body>
    <div class="wrapper">
        <section class="users">
            <header>
                <div class="details">
                    <span><?php echo $row['fname']; ?></span>
                    <p><?php echo $row['status']; ?></p>
                </div>
                <a href="logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>
            </header>

            <div class="search">
                <input type="text" placeholder="Masukkan nama untuk dicari...">
                <button class="clear">×</button>
            </div>

            <div class="users-list">
                <p class="no-users">Tidak ada pengguna yang tersedia untuk diajak chat</p>
            </div>
        </section>
    </div>
</body>
</html>
