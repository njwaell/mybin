<?php
// Mulai session untuk mengaksesnya
session_start();

// Hapus semua variabel session
session_unset();

// Hancurkan session
session_destroy();

// Arahkan kembali ke halaman login admin
header("Location: login.php");
exit;
?>