<?php
session_start();
require '../connection.php'; // Perhatikan path ke connection.php
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT id, username, password, nama, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        // Verifikasi password DAN cek apakah rolenya 'admin'
        if (password_verify($password, $user['password']) && $user['role'] === 'admin') {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['role'] = $user['role'];
            header("Location: index.php"); // Arahkan ke dashboard admin
            exit;
        }
    }
    $error = 'Login gagal. Pastikan username, password, dan hak akses benar.';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Admin Login - MyBin</title>
    <link rel="stylesheet" href="../styles.css"> <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f0fdf4; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .container { background: white; padding: 30px 40px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); width: 350px; text-align: center; }
        h2 { color: #166534; }
        /* (Gunakan styling yang sama seperti login user) */
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Login MyBin</h2>
        <?php if ($error): ?>
            <p style="color:red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <label>Username:</label><br>
            <input type="text" name="username" required><br><br>
            <label>Password:</label><br>
            <input type="password" name="password" required><br><br>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>