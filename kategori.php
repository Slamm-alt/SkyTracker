<!DOCTYPE html>
<html lang="en">
<?php 
    session_start();
    if (!isset($_SESSION['username'])) {
        header('location:login.php');
        exit;
    }
    include "koneksi.php"; // Pastikan file koneksi.php ada di folder yang sama

    // Handle delete
    if (isset($_GET['delete'])) {
        $id_kategori = intval($_GET['delete']); // Hindari SQL Injection
        $query = "DELETE FROM tb_kategori WHERE id_kategori = $id_kategori";
        if (mysqli_query($conn, $query)) {
            header("Location: kategori.php");
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    // Handle create or update
    if (isset($_POST['save'])) {
        $id_kategori = intval($_POST['id_kategori']);
        $tipe_pesawat = mysqli_real_escape_string($conn, $_POST['tipe_pesawat']);
        $kapasitas_penumpang = intval($_POST['kapasitas_penumpang']);

        // Proses upload file
        $poto = '';
        if (!empty($_FILES['poto']['name'])) {
            $target_dir = "uploads/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true); // Buat folder jika belum ada
            }
            $target_file = $target_dir . basename($_FILES['poto']['name']);
            $poto = $target_file;

            // Validasi dan upload
            if (!move_uploaded_file($_FILES['poto']['tmp_name'], $target_file)) {
                echo "Error uploading file.";
            }
        }

        if ($id_kategori == 0) {
            // Tambah data baru
            $query = "INSERT INTO tb_kategori (tipe_pesawat, kapasitas_penumpang, poto) 
                      VALUES ('$tipe_pesawat', $kapasitas_penumpang, '$poto')";
        } else {
            // Update data yang sudah ada
            $query = "UPDATE tb_kategori 
                      SET tipe_pesawat='$tipe_pesawat', kapasitas_penumpang=$kapasitas_penumpang, 
                          poto='$poto'
                      WHERE id_kategori=$id_kategori";
        }

        if (mysqli_query($conn, $query)) {
            header("Location: kategori.php");
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    // Fetch data
    $query = "SELECT * FROM tb_kategori";
    $result = mysqli_query($conn, $query);
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <style>
        .home-content {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-left: 250px;
            padding: 20px;
            max-width: calc(100% - 250px);
            box-sizing: border-box;
        }
        form {
            width: 100%;
            max-width: 600px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            text-align: left;
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        tbody tr:hover {
            background-color: #f9f9f9;
        }
        img {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <input type="checkbox" id="menu-toggle">
    <label for="menu-toggle" class="menu-icon">&#x22EE;</label>

    <div class="sidebar">
        <h2>PESAWAT</h2>
        <ul>
            <li><a href="index.php"><img src="asset/airport_16422929.png" alt="Dashboard" class="icon"> Dashboard</a></li>
            <li><a href="pembelian/pembelian.php"><img src="asset/credit-card_7532957.png" alt="Pembelian" class="icon"> Pembelian</a></li>
            <li><a href="penerbangan.php"><img src="asset/airplane_407124.png" alt="Semua Layan" class="icon"> Penerbangan</a></li>
            <li><a href=""><img src="asset/hotel_1821441.png" alt="Trakteer" class="icon"> Hotel</a></li>
        </ul>
    </div>

    <div class="home-content">
        <h1>Kategori</h1>

        <!-- Form -->
        <form method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="id_kategori" id="id_kategori" value="0">
            <label>Tipe Pesawat:</label><br>
            <input type="text" name="tipe_pesawat" id="tipe_pesawat" required><br>
            <label>Kapasitas Penumpang:</label><br>
            <input type="number" name="kapasitas_penumpang" id="kapasitas_penumpang" required><br>
            <label>Poto Pesawat:</label><br>
            <input type="file" name="poto" id="poto" accept="image/*"><br><br>
            <button type="submit" name="save">Simpan</button>
        </form>
        <hr>

        <!-- Table -->
        <table>
            <thead>
                <tr>
                    <th>ID Kategori</th>
                    <th>Tipe Pesawat</th>
                    <th>Kapasitas Penumpang</th>
                    <th>Poto</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $row['id_kategori'] ?></td>
                        <td><?= $row['tipe_pesawat'] ?></td>
                        <td><?= $row['kapasitas_penumpang'] ?></td>
                        <td>
                            <?php if (!empty($row['poto'])): ?>
                                <img src="<?= $row['poto'] ?>" alt="Poto Pesawat">
                            <?php else: ?>
                                Tidak ada poto
                            <?php endif; ?>
                        </td>
                        <td>
                            <button onclick="edit(<?= $row['id_kategori'] ?>, '<?= $row['tipe_pesawat'] ?>', <?= $row['kapasitas_penumpang'] ?>)">Edit</button>
                            <a href="?delete=<?= $row['id_kategori'] ?>" onclick="return confirm('Apakah Anda yakin?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script>
        function edit(id_kategori, tipe_pesawat, kapasitas_penumpang) {
            document.getElementById('id_kategori').value = id_kategori;
            document.getElementById('tipe_pesawat').value = tipe_pesawat;
            document.getElementById('kapasitas_penumpang').value = kapasitas_penumpang;
        }
    </script>
</body>
</html>
