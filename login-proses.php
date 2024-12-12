<?php
// Sertakan file koneksi
require_once 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Periksa apakah input 'email' dan 'password' ada
    if (!isset($_POST['email']) || !isset($_POST['password'])) {
        echo "Formulir tidak valid. Pastikan semua kolom terisi dengan benar!";
        exit;
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validasi input
    if (empty($email) || empty($password)) {
        echo "Email dan password wajib diisi!";
        exit;
    }

    // Bersihkan input
    $email = $conn->real_escape_string($email);

    // Query untuk mencari pengguna berdasarkan email
    $sql = "SELECT * FROM tb_user WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Ambil data pengguna
        $user = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Login berhasil, set session atau cookie jika diperlukan
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Arahkan ke halaman utama setelah login
            header('Location: dashboard.php');
            exit;
        } else {
            echo "Password salah!";
        }
    } else {
        echo "Pengguna dengan email tersebut tidak ditemukan!";
    }
} else {
    echo "Metode request tidak valid.";
}

// Tutup koneksi
$conn->close();
?>
