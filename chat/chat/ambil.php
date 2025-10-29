<?php
session_start();
require "../kdb.php";

$unique_id = $_SESSION['unique_id'];
$output = "";

$sql = $kdb->query("SELECT * FROM users WHERE NOT unique_id = '{$unique_id}' AND status='Active now'");
if ($sql->num_rows == 0) {
    $output .= "Tidak ada pengguna yang tersedia untuk chat";
} else {
    while ($row = $sql->fetch_assoc()) {
        $output .= '<a href="#">
                        <div class="content">
                            <div class="details">
                                <span>'.$row['fname'].'</span>
                                <p>'.$row['status'].'</p>
                            </div>
                        </div>
                    </a>';
    }
}
echo $output;
