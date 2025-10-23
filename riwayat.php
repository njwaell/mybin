<?php
session_start();
require 'connection.php';

// Cek apakah user sudah login, jika tidak, arahkan ke halaman login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Ambil ID user dari session
$user_id = $_SESSION['user_id'];

// Ambil semua data pesanan untuk user yang sedang login, diurutkan dari yang terbaru
$stmt = $conn->prepare("SELECT jenis_layanan, tanggal_jemput, status, tanggal_pesan FROM pesanan WHERE user_id = ? ORDER BY tanggal_pesan DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Simpan hasilnya dalam sebuah array
$pesanan = [];
while ($row = $result->fetch_assoc()) {
    $pesanan[] = $row;
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - MyBin</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f0fdf4; margin: 0; color: #333; }
        .navbar { background-color: #166534; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        .navbar h1 { margin: 0; font-size: 24px; }
        .navbar a { color: white; text-decoration: none; font-weight: 600; }
        .container { max-width: 900px; margin: 40px auto; padding: 30px 40px; background: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
        h2 { text-align: center; color: #166534; margin-bottom: 25px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px 15px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #dcfce7; color: #166534; }
        tr:nth-child(even) { background-color: #f8fafc; }
        .status { padding: 5px 10px; border-radius: 15px; color: white; font-weight: bold; font-size: 12px; text-align: center; }
        .status-dijadwalkan { background-color: #f97316; } /* Orange */
        .status-selesai { background-color: #22c55e; } /* Green */
        .status-dibatalkan { background-color: #ef4444; } /* Red */
        .no-data { text-align: center; color: #777; padding: 40px 0; }
    </style>
</head>
<body>

<div class="navbar">
    <h1><a href="dashboard.php">MyBin</a></h1>
    <a href="logout.php">Logout</a>
</div>

<div class="container">
    <h2>Riwayat Pesanan Anda</h2>

    <?php if (count($pesanan) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Tanggal Pesan</th>
                    <th>Tanggal Jemput</th>
                    <th>Jenis Layanan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pesanan as $item): ?>
                    <tr>
                        <td><?php echo date('d M Y, H:i', strtotime($item['tanggal_pesan'])); ?></td>
                        <td><?php echo date('d M Y', strtotime($item['tanggal_jemput'])); ?></td>
                        <td><?php echo htmlspecialchars($item['jenis_layanan']); ?></td>
                        <td>
                            <?php 
                                $status_class = '';
                                if ($item['status'] == 'Dijadwalkan') {
                                    $status_class = 'status-dijadwalkan';
                                } elseif ($item['status'] == 'Selesai') {
                                    $status_class = 'status-selesai';
                                } elseif ($item['status'] == 'Dibatalkan') {
                                    $status_class = 'status-dibatalkan';
                                }
                            ?>
                            <span class="status <?php echo $status_class; ?>">
                                <?php echo htmlspecialchars($item['status']); ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-data">Anda belum memiliki riwayat pesanan.</p>
    <?php endif; ?>
</div>

</body>
</html>