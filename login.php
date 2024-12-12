<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesawatt - Login</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Style untuk notifikasi di headbar */
        .notification-bar {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 9999;
            text-align: center;
            padding: 15px;
            font-size: 16px;
            color: #fff;
        }
        .notification-success {
            background-color: green;
        }
        .notification-error {
            background-color: red;
        }

        /* Animasi untuk timbul perlahan */
        @keyframes fadeIn {
            0% { 
                opacity: 0;
                transform: translateY(-100%);
            }
            100% { 
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Menambahkan animasi */
        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }

        /* Style untuk form dan tombol */
        .form-container {
            text-align: center;
            margin-top: 50px;
        }
        .form-section {
            margin: 0 auto;
            max-width: 400px;
        }
        input[type="email"], input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 10px;
        }
        .btn:hover {
            background-color: #218838;
        }
        .create-account-btn {
            background-color: #007bff;
        }
        .create-account-btn:hover {
            background-color: #0056b3;
        }

        /* Style untuk body dan background */
        body {
            margin: 0;
            height: 100vh; /* Mengatur tinggi body menjadi sama dengan tinggi viewport */
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #E8E3E3; /* Light grey matching the image background */
            border: 20px solid #00BFFF; /* Warna biru di sekitar layar */
            box-sizing: border-box; /* Memastikan border biru berada di tepi layar */
            overflow: hidden; /* Menonaktifkan scrolling */
        }

        /* Style untuk form box agar menyerupai yang ada di gambar */
        .form-container {
            background-color: #A5A5A5; /* Grey color for the form box */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 20px;
            font-family: Arial, sans-serif;
            color: #000;
        }

        /* Menambahkan warna biru ke tombol login */
        .login-btn {
            background-color: #0056b3;
        }

        .login-btn:hover {
            background-color: #003d80;
        }
    </style>
    <script>
        function showNotification(message, isSuccess) {
            var notificationBar = document.getElementById('notification-bar');
            notificationBar.innerHTML = message;

            if (isSuccess) {
                notificationBar.className = 'notification-bar notification-success fade-in';
            } else {
                notificationBar.className = 'notification-bar notification-error fade-in';
            }

            notificationBar.style.display = 'block';

            // Sembunyikan notifikasi setelah 3 detik
            setTimeout(function() {
                notificationBar.style.display = 'none';
            }, 3000);
        }

        function validateForm(event) {
            event.preventDefault(); // Mencegah form langsung submit
            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value;

            // Cek apakah username dan password diisi
            if (username === "" || password === "") {
                // Tampilkan pesan error di headbar
                showNotification('&#10060; Username atau Password tidak boleh kosong!', false);
            } else if (!username.includes('@') || !username.includes('.')) {
                // Validasi tambahan untuk email yang valid
                showNotification('&#10060; Format email tidak valid!', false);
            } else {
                // Tampilkan pesan sukses di headbar
                showNotification('&#10003; Login berhasil!', true);

                // Redirect ke halaman dashboard setelah sedikit delay
                setTimeout(function() {
                    window.location.href = "dashboard.php";
                }, 1500);
            }
        }
    </script>
</head>
<body>

<!-- Headbar untuk notifikasi -->
<div id="notification-bar" class="notification-bar"></div>

<section class="form-section">
    <div class="form-container">
        <h2>Sudah Punya Akun</h2>

        <form action="login-proses.php" method="POST">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    
    <button type="submit" class="btn login-btn">Login</button>
</form>


        <!-- Tombol Buat Akun di bawah form login -->
        <a href="register.php" class="btn create-account-btn">Buat Akun</a>
    </div>
</section>

</body>
</html>
