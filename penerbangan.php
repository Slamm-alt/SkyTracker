<?php
// Konfigurasi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pesawat"; // Nama database

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tambah data
if (isset($_POST['create'])) {
    $nama_pemesanan = $_POST['nama_pemesanan'];
    $tanggal = $_POST['tanggal'];
    $jenis_pesawat = $_POST['jenis_pesawat'];

    $sql = "INSERT INTO tb_pemesanan (nama_pemesanan, tanggal, jenis_pesawat) 
            VALUES ('$nama_pemesanan', '$tanggal', '$jenis_pesawat')";
    $conn->query($sql);
    header("Location: penerbangan.php");
}

// Edit data
if (isset($_POST['update'])) {
    $id_pemesanan = $_POST['id_pemesanan'];
    $nama_pemesanan = $_POST['nama_pemesanan'];
    $tanggal = $_POST['tanggal'];
    $jenis_pesawat = $_POST['jenis_pesawat'];

    $sql = "UPDATE tb_pemesanan SET 
                nama_pemesanan='$nama_pemesanan', 
                tanggal='$tanggal', 
                jenis_pesawat='$jenis_pesawat' 
            WHERE id_pemesanan=$id_pemesanan";
    $conn->query($sql);
    header("Location: penerbangan.php");
}

// Hapus data
if (isset($_GET['delete'])) {
    $id_pemesanan = $_GET['delete'];
    $conn->query("DELETE FROM tb_pemesanan WHERE id_pemesanan=$id_pemesanan");
    header("Location: penerbangan.php");
}

// Ambil data untuk ditampilkan
$result = $conn->query("SELECT * FROM tb_pemesanan");

if (!$result) {
    die("Query gagal: " . $conn->error);
}

// Ambil data untuk form edit
$edit_data = null;
if (isset($_GET['edit'])) {
    $id_pemesanan = $_GET['edit'];
    $edit_data = $conn->query("SELECT * FROM tb_pemesanan WHERE id_pemesanan=$id_pemesanan")->fetch_assoc();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Penerbangan</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
<div class="sidebar">
    <h2>PESAWAT</h2>
    <ul>
        <li><a href="index.php"><img src="asset/airport_16422929.png" alt="Dashboard" class="icon"> Dashboard</a></li>
        <li><a href="pembelian/pembelian.php"><img src="asset/credit-card_7532957.png" alt="Pembelian" class="icon"> Pembelian</a></li>
        <li><a href="kategori.php"><img src="asset/bars_16369930.png" alt="kategori" class="icon"> Kategori</a></li>
        <li><a href="penerbangan.php"><img src="asset/airplane_407124.png" alt="Semua Layan" class="icon"> Penerbangan</a></li>
        <li><a href="trakteer/trakteer.php"><img src="asset/hotel_1821441.png" alt="Trakteer" class="icon"> Hotel</a></li>
    </ul>
</div>
<div class="content">
    <h1>CRUD Penerbangan</h1>
    
    <div class="form-container">
        <h3><?= isset($edit_data) ? 'Edit Data' : 'Tambah Data' ?></h3>
        <form action="penerbangan.php" method="POST">
            <input type="hidden" name="id_pemesanan" value="<?= $edit_data['id_pemesanan'] ?? '' ?>">
            <label>Nama Pemesanan:</label>
            <input type="text" name="nama_pemesanan" value="<?= $edit_data['nama_pemesanan'] ?? '' ?>" required>
            <label>Tanggal:</label>
            <input type="date" name="tanggal" value="<?= $edit_data['tanggal'] ?? '' ?>" required>
            <label>Jenis Pesawat:</label>
            <input type="text" name="jenis_pesawat" value="<?= $edit_data['jenis_pesawat'] ?? '' ?>" required>
            <button type="submit" name="<?= isset($edit_data) ? 'update' : 'create' ?>">
                <?= isset($edit_data) ? 'Update' : 'Simpan' ?>
            </button>
        </form>
    </div>

    <div style="margin: 20px 0;">
    <a href="cetak_pdf.php" target="_blank" class="btn-print"" style="
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;">Cetak PDF</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID Pemesanan</th>
                <th>Nama Pemesanan</th>
                <th>Tanggal</th>
                <th>Jenis Pesawat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id_pemesanan'] ?></td>
                    <td><?= $row['nama_pemesanan'] ?></td>
                    <td><?= $row['tanggal'] ?></td>
                    <td><?= $row['jenis_pesawat'] ?></td>
                    <td>
                        <a href="penerbangan.php?edit=<?= $row['id_pemesanan'] ?>">Edit</a>
                        <a href="penerbangan.php?delete=<?= $row['id_pemesanan'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
