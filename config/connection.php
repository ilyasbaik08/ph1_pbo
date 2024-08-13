<!-- Ini adalah tag pembuka yang digunakan untuk menandai dimulainya kode PHP.  -->
<?php
//  Fungsi openConnection() untuk membuka koneksi ke database MySQL
function openConnection()
{
    $hostname = "localhost";  // Nama server database, biasanya "localhost"
    $username = "root"; // Nama pengguna untuk login ke database
    $password = ""; // Kata sandi pengguna untuk login ke database
    $database = "php_login_system"; // Nama database yang akan diakses

    // Membuat koneksi ke database menggunakan objek mysqli
    $conn = new mysqli($hostname, $username, $password, $database);

    // Memeriksa apakah koneksi berhasil atau gagal
    if ($conn->connect_error) {
        // Jika koneksi gagal, tampilkan pesan error dan hentikan eksekusi skrip
        die("Connection failed: " . $conn->connect_error);
    }
    // Jika koneksi berhasil, kembalikan objek koneksi
    return $conn;
}
