<?php
// Sertakan file koneksi
require_once 'koneksi.php';

// Periksa apakah tabel 'users' ada
$checkTableQuery = "SHOW TABLES LIKE 'tb_user'";
$result = $conn->query($checkTableQuery);

if ($result->num_rows === 0) {
    die("Tabel 'users' tidak ditemukan di database! Pastikan tabel tersebut sudah dibuat.");
}

// Jika tabel ada, lanjutkan proses
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validasi data input
    if (empty($username) || empty($email) || empty($password)) {
        echo "Semua kolom wajib diisi!";
        exit;
    }

    // Proses input data
    $username = $conn->real_escape_string($username);
    $email = $conn->real_escape_string($email);
    $password = password_hash($password, PASSWORD_BCRYPT);

    // Query untuk memasukkan data ke tabel
    $sql = "INSERT INTO tb_user (username, email, password) VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Jika registrasi berhasil, arahkan ke halaman login
        header('Location: login.php');
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Tutup koneksi
$conn->close();
?>
