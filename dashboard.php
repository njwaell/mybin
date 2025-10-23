<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Pengguna</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            text-align: center;
            padding-top: 60px;
        }
        .container {
            background: white;
            width: 400px;
            margin: auto;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        a {
            text-decoration: none;
            color: white;
            background-color: #dc3545;
            padding: 8px 15px;
            border-radius: 5px;
        }
        a:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Selamat Datang, <?php echo htmlspecialchars($_SESSION['nama']); ?> 👋</h2>
    <p>Username kamu: <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></p>
    <p><a href="logout.php">Logout</a></p>
</div>
</body>
</html>
