<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch the latest user data (optional, but good for real-time points)
require 'connection.php';
$stmt = $conn->prepare("SELECT nama, username, poin FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$_SESSION['nama'] = $user['nama'];
$_SESSION['username'] = $user['username'];
$_SESSION['poin'] = $user['poin'];
$stmt->close();
$conn->close();

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - MyBin</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f0fdf4; margin: 0; color: #333; }
        .navbar { background-color: #166534; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        .navbar h1 { margin: 0; font-size: 24px; }
        .navbar a { color: white; background-color: #dc2626; padding: 8px 15px; text-decoration: none; border-radius: 6px; font-weight: 600; transition: background-color 0.3s; }
        .navbar a:hover { background-color: #b91c1c; }
        .main-container { max-width: 900px; margin: 40px auto; padding: 20px; }
        .header-card { background-color: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); text-align: center; margin-bottom: 30px; }
        .header-card h2 { margin: 0 0 10px 0; color: #15803d; }
        .points-display { background-color: #dcfce7; color: #166534; padding: 15px; border-radius: 8px; font-size: 20px; font-weight: bold; display: inline-block; }
        .features-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; }
        .feature-card { background-color: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); text-align: center; }
        .feature-card h3 { margin-top: 0; color: #16a34a; }
        .feature-card p { font-size: 14px; color: #555; line-height: 1.5; }
        .feature-card .btn { display: inline-block; margin-top: 15px; padding: 10px 20px; background-color: #22c55e; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; transition: background-color 0.3s; }
        .feature-card .btn:hover { background-color: #16a34a; }
    </style>
</head>
<body>

<div class="navbar">
    <h1>MyBin</h1>
    <a href="logout.php">Logout</a>
</div>

<div class="main-container">
    <div class="header-card">
        <h2>Selamat Datang, <?php echo htmlspecialchars($_SESSION['nama']); ?>! 👋</h2>
        <p>Kelola sampah organik Anda dan dapatkan imbalan.</p>
        <div class="points-display">
            Poin MyBin Anda: <?php echo htmlspecialchars($_SESSION['poin']); ?> Poin
        </div>
    </div>

    <div class="features-grid">
        <div class="feature-card">
            <h3>Pesan Penjemputan</h3>
            [cite_start]<p>Jadwalkan penjemputan untuk sampah organik dan anorganik Anda dengan mudah. [cite: 7]</p>
            <a href="pesan.php"" class="btn">Buat Pesanan Baru</a>
        </div>
        <div class="feature-card">
            <h3>Riwayat & Notifikasi</h3>
            [cite_start]<p>Lihat riwayat pesanan Anda dan poin yang telah Anda peroleh dari setiap setoran. [cite: 10]</p>
            <a href="riwayat.php" class="btn">Lihat Riwayat</a>
        </div>
        <div class="feature-card">
            <h3>Tukar Poin & Reward</h3>
            [cite_start]<p>Tukarkan Poin MyBin Anda dengan diskon, voucher, atau saldo e-wallet. [cite: 13, 14, 15, 16]</p>
            <a href="#" class="btn">Tukarkan Poin</a>
        </div>
        <div class="feature-card">
            <h3>Marketplace Pupuk</h3>
            [cite_start]<p>Beli "Pupuk Organik MyBin" hasil olahan sampah organik langsung dari platform kami. [cite: 12]</p>
            <a href="#" class="btn">Kunjungi Marketplace</a>
        </div>
        <div class="feature-card">
            <h3>Pusat Edukasi</h3>
            [cite_start]<p>Pelajari cara memilah sampah organik dengan benar melalui video tutorial dan panduan. [cite: 17]</p>
            <a href="#" class="btn">Mulai Belajar</a>
        </div>
    </div>
</div>

</body>
</html>