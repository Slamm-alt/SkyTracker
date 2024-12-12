// Menangani form submit
document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Mencegah form disubmit secara default
    
    // Ambil nilai input email dan password
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    // Cek apakah form sudah diisi
    if (email && password) {
        showSnackbar('Login successful!');
    } else {
        showSnackbar('Please fill in all fields!');
    }
});

// Fungsi untuk menampilkan snackbar
function showSnackbar(message) {
    const snackbar = document.getElementById('snackbar');
    snackbar.textContent = message;
    snackbar.className = 'show'; // Menampilkan snackbar

    // Setelah 3 detik, sembunyikan snackbar
    setTimeout(function() {
        snackbar.className = snackbar.className.replace('show', ''); 
    }, 3000); // 3000ms = 3 detik
}
