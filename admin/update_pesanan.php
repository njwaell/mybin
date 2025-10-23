<?php
session_start();
require '../connection.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$order_id = $_GET['id'];
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $berat = $_POST['berat'];
    
    // Asumsi: 1 kg sampah organik = 10 poin
    $poin_didapat = $berat * 10;

    // Ambil user_id dari pesanan
    $stmt_get_user = $conn->prepare("SELECT user_id FROM pesanan WHERE id = ?");
    $stmt_get_user->bind_param("i", $order_id);
    $stmt_get_user->execute();
    $user_id = $stmt_get_user->get_result()->fetch_assoc()['user_id'];
    $stmt_get_user->close();

    // Gunakan transaksi untuk memastikan kedua query berhasil
    $conn->begin_transaction();
    try {
        // 1. Update status pesanan dan beratnya
        $stmt1 = $conn->prepare("UPDATE pesanan SET status = 'Selesai', berat_organik_kg = ? WHERE id = ?");
        $stmt1->bind_param("di", $berat, $order_id);
        $stmt1->execute();
        $stmt1->close();

        // 2. Tambahkan poin ke user
        $stmt2 = $conn->prepare("UPDATE users SET poin = poin + ? WHERE id = ?");
        $stmt2->bind_param("ii", $poin_didapat, $user_id);
        $stmt2->execute();
        $stmt2->close();

        $conn->commit();
        $message = "Pesanan berhasil diselesaikan! Poin telah ditambahkan. Anda akan diarahkan kembali.";
        header("refresh:3;url=index.php");

    } catch (mysqli_sql_exception $exception) {
        $conn->rollback();
        $message = "Gagal memperbarui pesanan. Terjadi kesalahan.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Pesanan</title>
     </head>
<body>
    <div class="container" style="max-width:500px; margin: 50px auto; padding: 20px; background:white; border-radius: 8px;">
        <h2>Selesaikan Pesanan #<?php echo htmlspecialchars($order_id); ?></h2>
        <?php if ($message): ?>
            <p><?php echo $message; ?></p>
        <?php else: ?>
            <form method="POST" action="update_pesanan.php?id=<?php echo htmlspecialchars($order_id); ?>">
                <label for="berat">Masukkan Berat Sampah Organik (kg):</label><br>
                <input type="number" step="0.01" name="berat" required><br><br>
                <input type="submit" value="Selesaikan & Beri Poin">
            </form>
        <?php endif; ?>
    </div>
</body>
</html>