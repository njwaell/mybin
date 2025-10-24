<?php
session_start();
require '../connection.php';

// Cek autentikasi dan otorisasi admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Ambil semua pesanan, gabungkan (JOIN) dengan data nama user
$query = "SELECT p.id, u.nama, p.jenis_layanan, p.tanggal_jemput, p.status 
          FROM pesanan p
          JOIN users u ON p.user_id = u.id
          ORDER BY p.tanggal_pesan DESC";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Admin Dashboard - MyBin</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f0fdf4; margin: 0; color: #333; }
        .navbar { background-color: #14532d; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        .container { max-width: 1200px; margin: 40px auto; padding: 30px; background: white; border-radius: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px 15px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #dcfce7; }
        .action-btn { background-color:#16a34a; color:white; padding: 5px 10px; border-radius:5px; text-decoration:none; }
    </style>
</head>
<body>
<div class="navbar">
    <h1>Admin Dashboard</h1>
    <a href="logout.php">Logout</a>
</div>
<div class="container">
    <h2>Manajemen Pesanan Masuk</h2>
    <table>
        <thead>
            <tr>
                <th>ID Pesanan</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal Jemput</th>
                <th>Jenis Layanan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['nama']); ?></td>
                <td><?php echo date('d M Y', strtotime($row['tanggal_jemput'])); ?></td>
                <td><?php echo htmlspecialchars($row['jenis_layanan']); ?></td>
                <td><?php echo htmlspecialchars($row['status']); ?></td>
                <td>
                    <?php if ($row['status'] == 'Dijadwalkan'): ?>
                        <a href="update_pesanan.php?id=<?php echo $row['id']; ?>" class="action-btn">Selesaikan</a>
                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>