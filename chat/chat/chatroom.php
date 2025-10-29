<?php
session_start();
require "../kdb.php";

if (!isset($_SESSION['unique_id'])) {
    header("location: ../login.php");
    exit;
}

// Ambil data user penerima
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $sql = $kdb->query("SELECT * FROM users WHERE unique_id = '$user_id'");
    if ($sql->num_rows > 0) {
        $row = $sql->fetch_assoc();
    } else {
        echo "<script>alert('Pengguna tidak ditemukan!'); document.location.href='users.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Pilih pengguna untuk chat!'); document.location.href='users.php';</script>";
    exit;
}

$outgoing_id = $_SESSION['unique_id'];
$incoming_id = $user_id;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" href="../css/chat.css">
</head>
<body>
    <div class="chat-container">
        <header>
            <div class="details">
                <h2><?= $row['fname']; ?></h2>
                <p><?= $row['status']; ?></p>
            </div>
            <a href="../logout.php" class="logout">Logout</a>
        </header>

        <div class="chat-box" id="chatBox"></div>

        <form id="chatForm" autocomplete="off">
            <input type="text" name="message" placeholder="Ketik pesan..." required>
            <input type="hidden" name="pesan_masuk" value="<?= $incoming_id; ?>">
            <button type="submit">Kirim</button>
        </form>
    </div>

    <script>
        const form = document.getElementById("chatForm"),
              chatBox = document.getElementById("chatBox");

        form.onsubmit = (e) => {
            e.preventDefault();
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "kirim.php", true);
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    form.message.value = "";
                }
            };
            let formData = new FormData(form);
            xhr.send(formData);
        };

        setInterval(() => {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ambil_pesan.php", true);
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    chatBox.innerHTML = xhr.response;
                    chatBox.scrollTop = chatBox.scrollHeight;
                }
            };
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("pesan_masuk=<?= $incoming_id; ?>");
        }, 1000);
    </script>
</body>
</html>
