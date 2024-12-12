<!DOCTYPE html>
<html lang="id">
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<pre>";
    print_r($_POST); // Melihat data yang dikirim
    echo "</pre>";
    exit; // Hentikan eksekusi sementara untuk debugging
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesawat - Daftar</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Style untuk form */
        input[type="text"], input[type="email"], input[type="password"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* Style untuk pesan kesalahan pada input yang tidak valid */
        input:invalid {
            border: 2px solid red;
        }

        input:invalid:focus {
            outline: none;
            box-shadow: 0 0 5px red;
        }

        /* Pesan pop-up error kecil */
        .error-message {
            display: none;
            color: red;
            font-size: 12px;
            margin-bottom: 10px;
        }

        .show-error {
            display: block;
        }

        /* Style untuk pesan sukses */
        .success-message {
            display: none;
            color: green;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .show-success {
            display: block;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-align: center;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #218838;
        }

        /* Tombol untuk clear form */
        .clear-btn {
            background-color: #dc3545;
            margin-top: 20px;
        }

        .clear-btn:hover {
            background-color: #c82333;
        }

    </style>
</head>
<body>

<section class="form-section">
    <div class="form-container">
        <h2>Daftar Sekarang</h2>

        <!-- Form pendaftaran -->
        <form id="registration-form" action="register-proses.php" method="post" onsubmit="return validateForm();">
    <input type="text" id="username" name="username" placeholder="Username" required>
    <span id="username-error" class="error-message">Username tidak boleh kosong!</span>

    <input type="email" id="email" name="email" placeholder="Email" required title="Email harus dalam format yang benar, misal: name@example.com">
    <span id="email-error" class="error-message">Format email tidak valid!</span>

    <input type="password" id="password" name="password" placeholder="Password" required minlength="6" title="Password minimal harus 6 karakter">
    <span id="password-error" class="error-message">Password harus minimal 6 karakter!</span>

    <button type="submit" class="btn daftar-btn">Daftar</button>
</form>

        <!-- Pesan sukses -->
        <div id="success-message" class="success-message">Pendaftaran berhasil! Mengarahkan ke halaman login...</div>

        <a href="login.php" class="btn">Sudah Punya Akun? Login</a>

        <!-- Tombol Clear Form -->
        <button class="btn clear-btn" onclick="clearForm()">Clear Form</button>
    </div>
</section>

<script>
    // Fungsi untuk set Cookie
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    // Fungsi untuk clear data yang sedang diisi di form
    function clearForm() {
        // Akses elemen form berdasarkan ID
        var form = document.getElementById('registration-form');
        // Mengosongkan semua input di form
        form.reset();
    }

    function validateForm() {
    var username = document.getElementById('username');
    var email = document.getElementById('email');
    var password = document.getElementById('password');
    var isValid = true;

    // Reset pesan error
    document.getElementById('username-error').classList.remove('show-error');
    document.getElementById('email-error').classList.remove('show-error');
    document.getElementById('password-error').classList.remove('show-error');
    document.getElementById('success-message').classList.remove('show-success');

    // Validasi Username
    if (username.value === "") {
        document.getElementById('username-error').classList.add('show-error');
        isValid = false;
    }

    // Validasi Email
    if (!email.checkValidity()) {
        document.getElementById('email-error').classList.add('show-error');
        isValid = false;
    }

    // Validasi Password
    if (password.value.length < 6) {
        document.getElementById('password-error').classList.add('show-error');
        isValid = false;
    }

    // Jika valid, tampilkan pesan sukses
    if (isValid) {
        document.getElementById('success-message').classList.add('show-success');
        return true; // Lanjutkan submit form ke server
    }

    return false; // Hentikan submit jika tidak valid
}

        // Jika form valid, tampilkan pesan sukses dan redirect
        if (isValid) {
            document.getElementById('success-message').classList.add('show-success');
            
            // Set cookie untuk username dan email
            setCookie("username", username.value, 7);  // Cookie berlaku 7 hari
            setCookie("email", email.value, 7);

            // Redirect ke halaman login setelah 2 detik
            setTimeout(function() {
                window.location.href = "login.php";
            }, 2000);

            return false; // Mencegah submit form agar tidak reload halaman langsung
        }

        return isValid;
    }
</script>

</body>
</html>
