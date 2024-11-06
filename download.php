<?php
require 'vendor/autoload.php';

$koneksi = new mysqli("localhost", "root", "", "db_absensi");
$type = $_GET['type'];

if ($type == 'excel') {
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $sheet->setCellValue('A1', 'Nama');
    $sheet->setCellValue('B1', 'Tanggal');
    $sheet->setCellValue('C1', 'Waktu');
    $sheet->setCellValue('D1', 'Status');

    $result = $koneksi->query("SELECT * FROM absensi");
    $row = 2;
    while ($data = $result->fetch_assoc()) {
        $sheet->setCellValue('A'.$row, $data['nama']);
        $sheet->setCellValue('B'.$row, $data['tanggal']);
        $sheet->setCellValue('C'.$row, $data['waktu']);
        $sheet->setCellValue('D'.$row, $data['status']);
        $row++;
    }

    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $filename = 'data_absensi.xlsx';
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment; filename=\"$filename\"");
    $writer->save("php://output");
} elseif ($type == 'pdf') {
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 12);

    $pdf->Cell(40, 10, 'Nama');
    $pdf->Cell(40, 10, 'Tanggal');
    $pdf->Cell(40, 10, 'Waktu');
    $pdf->Cell(40, 10, 'Status');
    $pdf->Ln();

    $result = $koneksi->query("SELECT * FROM absensi");
    while ($data = $result->fetch_assoc()) {
        $pdf->Cell(40, 10, $data['nama']);
        $pdf->Cell(40, 10, $data['tanggal']);
        $pdf->Cell(40, 10, $data['waktu']);
        $pdf->Cell(40, 10, $data['status']);
        $pdf->Ln();
    }

    $pdf->Output('D', 'data_absensi.pdf');
}
?>
