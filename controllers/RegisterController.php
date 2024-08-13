<?php

// Memulai sesi PHP untuk menyimpan informasi pengguna yang dapat diakses di berbagai halaman selama sesi aktif
session_start();

// Menyertakan file UserModel.php yang berisi definisi class UserModel untuk berinteraksi dengan database
require_once '../models/UserModel.php';

// Memeriksa apakah permintaan yang masuk adalah metode POST (formulir pendaftaran dikirimkan)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data yang dikirim dari formulir pendaftaran
    $name = $_POST['name']; // Nama pengguna
    $gender = $_POST['gender']; // Jenis kelamin pengguna
    $date_of_birth = $_POST['date_of_birth']; // Tanggal lahir pengguna
    $email = $_POST['email']; // Email pengguna
    $phone_number = $_POST['phone_number']; // Nomor telepon pengguna
    $password = $_POST['password']; // Password pengguna
    $confirm_password = $_POST['confirm_password']; // Konfirmasi password

    // Memeriksa apakah password dan konfirmasi password sesuai
    if ($password != $confirm_password) {
        // Jika password dan konfirmasi password tidak cocok, tampilkan pesan kesalahan dan hentikan skrip
        echo "Konfirmasi password tidak sesuai";
        exit; // Menghentikan eksekusi skrip jika konfirmasi password tidak sesuai
    }

    // Membuat instance dari UserModel untuk berinteraksi dengan database
    $userModel = new UserModel();

    // Mendaftarkan pengguna baru ke database dengan memanggil metode register()
    $userModel->register($name, $gender, $date_of_birth, $email, $phone_number, $password);

    // Login otomatis setelah pendaftaran berhasil dan menyimpan ID pengguna ke sesi
    $_SESSION['id'] = $userModel->login($email)['id'];

    // Menutup koneksi ke database melalui metode closeConnection() di UserModel
    $userModel->closeConnection();

    // Redirect ke halaman home.php setelah pendaftaran dan login berhasil
    header("Location: ../views/home.php");
    exit(); // Menghentikan eksekusi skrip setelah redirect
}
