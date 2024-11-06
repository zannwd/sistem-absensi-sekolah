<?php
require 'vendor/autoload.php';

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

$data = 'NamaPengguna'; // Ubah dengan data pengguna yang ingin di-generate

$qrCode = new QrCode($data);
$writer = new PngWriter();

header('Content-Type: image/png');
echo $writer->write($qrCode)->getString();
exit;
?>
