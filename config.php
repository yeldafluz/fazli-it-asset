<?php
// Ini adalah maklumat sambungan ke database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "it_sistem";

// Proses menyambung
$koneksi = mysqli_connect($host, $user, $pass, $db);

// Check jika sambungan gagal
if (!$koneksi) {
    die("Gagal sambung ke database: " . mysqli_connect_error());
}
?>