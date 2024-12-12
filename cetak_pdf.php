<?php
// cetak_pdf.php
require_once('dompdf/autoload.inc.php');
use Dompdf\Dompdf;

// Koneksi ke database
include('koneksi.php');

// Query untuk mengambil data dari tabel tb_traktir
$query = $conn->query("SELECT * FROM tb_pemesanan");

// Periksa jika query gagal
if (!$query) {
    die("Query gagal: " . $conn->error);
}

// Inisialisasi Dompdf
$dompdf = new Dompdf();

// Membuat konten HTML untuk PDF
$html = '<center><h3>Data Pemesanan</h3></center><hr/><br>';
$html .= '<table border="1" width="100%" cellspacing="0" cellpadding="5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pemesanan</th>
                    <th>Tanggal</th>
                    <th>Jenis Pesawat</th>
                </tr>
            </thead>
            <tbody>';

// Iterasi data untuk mengisi tabel
while ($row = $query->fetch_assoc()) {
    $html .= '<tr>
                <td>' . htmlspecialchars($row['id_pemesanan']) . '</td>
                <td>' . htmlspecialchars($row['nama_pemesanan']) . '</td>
                <td>' . htmlspecialchars($row['tanggal']) . '</td>
                <td>' . htmlspecialchars($row['jenis_pesawat']) . '</td>
              </tr>';
}

$html .= '</tbody></table>';

// Tambahkan konten HTML ke Dompdf
$dompdf->loadHtml($html);

// Atur ukuran kertas dan orientasi
$dompdf->setPaper('A4', 'portrait');

// Render HTML menjadi PDF
$dompdf->render();

// Tampilkan atau unduh file PDF
if (isset($_GET['download']) && $_GET['download'] === 'true') {
    $dompdf->stream('data_penerbangan.pdf', ['Attachment' => true]);
} else {
    $dompdf->stream('data_penerbangan.pdf', ['Attachment' => false]);
}
?>