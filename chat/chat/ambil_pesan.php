<?php
session_start();
require "../kdb.php";

$outgoing_id = $_SESSION['unique_id'];
$incoming_id = $_POST['pesan_masuk'];
$output = "";

$sql = "SELECT * FROM pesan 
        WHERE (pesan_keluar = '$outgoing_id' AND pesan_masuk = '$incoming_id') 
        OR (pesan_keluar = '$incoming_id' AND pesan_masuk = '$outgoing_id')
        ORDER BY id_pesan";

$query = $kdb->query($sql);

if ($query->num_rows > 0) {
    while ($row = $query->fetch_assoc()) {
        if ($row['pesan_keluar'] === $outgoing_id) {
            $output .= '<div class="pesan pesan_keluar">
                            <p>'.$row['msg'].'</p>
                        </div>';
        } else {
            $output .= '<div class="pesan pesan_masuk">
                            <p>'.$row['msg'].'</p>
                        </div>';
        }
    }
}
echo $output;
