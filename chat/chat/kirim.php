<?php
session_start();
require "../kdb.php";

if (isset($_SESSION['unique_id'])) {
    $pesan_keluar = $_SESSION['unique_id'];
    $pesan_masuk = $_POST['pesan_masuk'];
    $message = $_POST['message'];

    if (!empty($message)) {
        $kdb->query("INSERT INTO pesan (pesan_masuk, pesan_keluar, msg)
                     VALUES ('$pesan_masuk', '$pesan_keluar', '$message')");
    }
}
