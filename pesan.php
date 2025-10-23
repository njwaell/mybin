<?php
session_start();
require 'connection.php';

// Cek apakah user sudah login, jika tidak, arahkan ke halaman login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$message = '';
$message_type = '';

// Proses form jika ada data yang dikirim (method POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $jenis_layanan = trim($_POST['jenis_layanan']);
    $tanggal_jemput = trim($_POST['tanggal_jemput']);
    $catatan = trim($_POST['catatan']);

    // Validasi sederhana
    if (empty($jenis_layanan) || empty($tanggal_jemput)) {
        $message = 'Jenis layanan dan tanggal penjemputan wajib diisi.';
        $message_type = 'error';
    } else {
        // Siapkan query untuk memasukkan data ke tabel pesanan
        $stmt = $conn->prepare("INSERT INTO pesanan (user_id, jenis_layanan, tanggal_jemput, catatan) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $user_id, $jenis_layanan, $tanggal_jemput, $catatan);

        if ($stmt->execute()) {
            $message = 'Penjemputan berhasil dijadwalkan! Anda akan diarahkan kembali ke dashboard.';
            $message_type = 'success';
            // Arahkan kembali ke dashboard setelah beberapa detik
            header("refresh:3;url=dashboard.php");
        } else {
            $message = 'Terjadi kesalahan. Silakan coba lagi.';
            $message_type = 'error';
        }
        $stmt->close();
    }
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Penjemputan - MyBin</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f0fdf4; margin: 0; color: #333; }
        .navbar { background-color: #166534; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        .navbar h1 { margin: 0; font-size: 24px; }
        .navbar a { color: white; text-decoration: none; font-weight: 600; }
        .container { max-width: 600px; margin: 40px auto; padding: 30px 40px; background: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); }
        h2 { text-align: center; color: #166534; margin-bottom: 25px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: 600; }
        input[type="date"], select, textarea { width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc; box-sizing: border-box; font-family: inherit; font-size: 16px; }
        textarea { resize: vertical; min-height: 100px; }
        input[type="submit"] { width: 100%; padding: 12px; background-color: #22c55e; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 16px; font-weight: bold; transition: background-color 0.3s; }
        input[type="submit"]:hover { background-color: #16a34a; }
        .message { padding: 12px; margin-bottom: 20px; border-radius: 6px; color: white; text-align: center; }
        .error { background-color: #ef4444; }
        .success { background-color: #22c55e; }
    </style>
</head>
<body>

<div class="navbar">
    <h1><a href="dashboard.php">MyBin</a></h1>
    <a href="logout.php">Logout</a>
</div>

<div class="container">
    <h2>Formulir Pemesanan Penjemputan</h2>

    <?php if ($message): ?>
        <div class="message <?php echo $message_type; ?>"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <form method="POST" action="pesan.php">
        <div class="form-group">
            <label for="jenis_layanan">Pilih Jenis Layanan:</label>
            <select id="jenis_layanan" name="jenis_layanan" required>
                <option value="">-- Pilih salah satu --</option>
                <option value="Hanya Organik">Hanya Sampah Organik</option>
                <option value="Organik & Anorganik">Sampah Organik & Anorganik</option>
            </select>
        </div>
        <div class="form-group">
            <label for="tanggal_jemput">Pilih Tanggal Penjemputan:</label>
            <input type="date" id="tanggal_jemput" name="tanggal_jemput" required min="<?php echo date('Y-m-d'); ?>">
        </div>
        <div class="form-group">
            <label for="catatan">Catatan (Opsional):</label>
            <textarea id="catatan" name="catatan" placeholder="Contoh: Titip di pos satpam"></textarea>
        </div>
        <input type="submit" value="Jadwalkan Penjemputan">
    </form>
</div>

</body>
</html>