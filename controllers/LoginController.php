<?php
// Memulai sesi. Ini harus dilakukan sebelum output apapun dikirimkan ke browser.
session_start();

// Mengimpor file UserModel.php yang berisi definisi kelas UserModel.
require_once '../models/UserModel.php';

// Mengecek apakah permintaan yang diterima adalah metode POST (biasanya berarti form dikirimkan).
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data email dan password dari form yang dikirimkan menggunakan metode POST.
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Membuat instance baru dari UserModel untuk mengakses metode login.
    $userModel = new UserModel();

    // Mengambil data pengguna berdasarkan email dari UserModel.
    $user = $userModel->login($email);

    // Memeriksa apakah pengguna ditemukan berdasarkan email.
    if ($user) {
        // Memverifikasi apakah password yang dimasukkan sesuai dengan password yang tersimpan di database.
        if (password_verify($password, $user['password'])) {
            // Jika password benar, menyimpan id dan password pengguna di sesi.
            $_SESSION['id'] = $user['id'];
            $_SESSION['password'] = $user['password'];

            // Mengalihkan pengguna ke halaman home.php setelah login berhasil.
            header("Location: ../views/home.php");
            exit(); // Menghentikan eksekusi skrip lebih lanjut setelah pengalihan.
        } else {
            // Jika password salah, menyimpan pesan error ke dalam sesi dan mengalihkan kembali ke halaman login.php.
            $_SESSION['password_error'] = "Password yang Anda masukkan salah";
            header("Location: ../views/login.php");
            exit(); // Menghentikan eksekusi skrip lebih lanjut setelah pengalihan.
        }
    } else {
        // Jika email tidak terdaftar, kode ini seharusnya mengarahkan pengguna ke halaman login dengan pesan error.
        // Namun, saat ini, kode ini mengalihkan pengguna ke halaman home.php secara langsung tanpa memeriksa email.
        // $_SESSION['email_error'] = "Email tidak terdaftar";

        // $userModel->closeConnection(); // Menutup koneksi ke database jika diperlukan.

        header("Location: ../views/home.php");
        exit(); // Menghentikan eksekusi skrip lebih lanjut setelah pengalihan.
    }
}
