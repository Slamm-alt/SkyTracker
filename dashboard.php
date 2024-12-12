<!DOCTYPE html>
<html lang="en">
<?php 
    session_start();
    if (!isset($_SESSION['username'])) {
        header('location:login.php');
        exit;
    }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">

    <style>
        /* Tambahan styling inline */
        .home-content {
            display: flex;
            flex-direction: column;
            align-items: flex-start; /* Menjauhkan dari kiri */
            margin-left: 250px; /* Menyesuaikan dengan lebar sidebar */
            padding: 20px; /* Memberi ruang agar tidak terlalu dekat */
        }

        #text {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px; /* Memberi jarak dengan jam digital */
        }

        #date {
            font-size: 18px;
            color: #555; /* Warna lebih soft untuk jam digital */
        }

        @media screen and (max-width: 768px) {
            .home-content {
                margin-left: 0; /* Atur ulang margin di layar kecil */
                padding: 10px;
                align-items: center; /* Pusatkan konten di layar kecil */
                text-align: center;
            }
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
            <li><a href="kategori.php"><img src="asset/bars_16369930.png" alt="kategori" class="icon"> Kategori</a></li>
            <li><a href="penerbangan.php"><img src="asset/airplane_407124.png" alt="Semua Layan" class="icon"> Penerbangan</a></li>
            <li><a href="trakteer/trakteer.php"><img src="asset/hotel_1821441.png" alt="Trakteer" class="icon"> Hotel</a></li>
        </ul>
    </div>

    <div class="home-content">
    <h2 id="text">
        Selamat datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!
    </h2>
    <h3 id="date"></h3>
    <a href="logout.php" class="logout-button">Logout</a> <!-- Tombol Logout -->

    <!-- Tambahkan Widget untuk Data -->
    <div class="widgets">
        <div class="widget">
            <h4>Total Pengguna</h4>
            <p>
                <?php 
                include('koneksi.php'); 
                $queryUser = $conn->query("SELECT COUNT(*) AS total_user FROM tb_user");
                $dataUser = $queryUser->fetch_assoc();
                echo $dataUser['total_user']; 
                ?>
                Pengguna
            </p>
        </div>
        <div class="widget">
            <h4>Total Pemesanan</h4>
            <p>
                <?php 
                $queryPemesanan = $conn->query("SELECT COUNT(*) AS total_pemesanan FROM tb_pemesanan");
                $dataPemesanan = $queryPemesanan->fetch_assoc();
                echo $dataPemesanan['total_pemesanan']; 
                ?>
                Pemesanan
            </p>
        </div>
    </div>
</div>

<style>
    .widgets {
        display: flex;
        gap: 20px;
        margin-top: 30px;
    }

    .widget {
        background-color: #f4f4f4;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        flex: 1;
        text-align: center;
    }

    .widget h4 {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .widget p {
        font-size: 24px;
        font-weight: bold;
        color: #333;
    }
</style>

<style>
    .logout-button {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 20px;
        font-size: 16px;
        background-color: #ff4d4d;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .logout-button:hover {
        background-color: #ff1a1a;
    }
</style>

    <script>
        function updateDateTime() {
            const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
            const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

            let now = new Date();
            let day = days[now.getDay()];
            let date = now.getDate();
            let month = months[now.getMonth()];
            let year = now.getFullYear();
            let hours = now.getHours();
            let minutes = now.getMinutes();
            let seconds = now.getSeconds();

            // Tambahkan angka nol jika nilai kurang dari 10
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            // Format waktu dan tanggal
            let formattedDate = `${day}, ${date} ${month} ${year}`;
            let formattedTime = `${hours}:${minutes}:${seconds}`;

            // Perbarui elemen HTML
            document.getElementById("date").innerText = `${formattedDate}, ${formattedTime}`;
        }

        // Jalankan fungsi setiap detik
        setInterval(updateDateTime, 1000);

        // Jalankan fungsi segera saat halaman dimuat
        updateDateTime();
    </script>

</body>
</html>
