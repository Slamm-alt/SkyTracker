<?php
// Konfigurasi database
$host = "localhost"; // Server database
$username = "root"; // Username database
$password = ""; // Password database
$database = "pesawat"; // Nama database Anda

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
