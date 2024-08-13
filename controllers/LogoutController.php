<?php
// Mengakhiri sesi saat ini dan menghapus semua data sesi
session_destroy();
// Menghapus semua variabel sesi yang tersimpan
session_unset();
// Mengarahkan pengguna kembali ke halaman login.php
header("Location: ../views/login.php");
// Menghentikan eksekusi skrip setelah redirect
exit;
