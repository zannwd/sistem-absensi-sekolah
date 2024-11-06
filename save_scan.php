<?php
$koneksi = new mysqli("localhost", "root", "", "db_absensi");

$data = json_decode(file_get_contents("php://input"), true);
$nama = $data['qr_data'];
$tanggal = date("Y-m-d");
$waktu = date("H:i:s");
$status = "Hadir";

$sql = "INSERT INTO absensi (nama, tanggal, waktu, status) VALUES ('$nama', '$tanggal', '$waktu', '$status')";
if ($koneksi->query($sql)) {
    echo "Absensi berhasil untuk $nama!";
} else {
    echo "Gagal melakukan absensi.";
}
?>
