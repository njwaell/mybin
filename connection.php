<?php
$host = "localhost";
$user = "root"; // sesuaikan dengan username MySQL kamu
$pass = "";     // isi jika pakai password
$dbname = "mybin";

// Membuat koneksi
$conn = new mysqli($host, $user, $pass, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
    