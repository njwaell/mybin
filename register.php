<?php
require 'connection.php';
$message = '';
$message_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $nama     = trim($_POST['nama']);

    // Simple server-side validation
    if (empty($username) || empty($password) || empty($nama)) {
        $message = 'Semua field wajib diisi!';
        $message_type = 'error';
    } else {
        // Check if username is already registered
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $message = 'Username sudah digunakan, silakan pilih yang lain.';
            $message_type = 'error';
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user data
            $insert_stmt = $conn->prepare("INSERT INTO users (username, password, nama) VALUES (?, ?, ?)");
            $insert_stmt->bind_param("sss", $username, $hashed_password, $nama);

            if ($insert_stmt->execute()) {
                // Use session flash message for success after redirect
                session_start();
                $_SESSION['success_message'] = 'Registrasi berhasil! Silakan login.';
                header("Location: login.php");
                exit;
            } else {
                $message = "Terjadi kesalahan: " . $insert_stmt->error;
                $message_type = 'error';
            }
            $insert_stmt->close();
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
    <title>Daftar Akun - MyBin</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f0fdf4; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .container { background: white; padding: 30px 40px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); width: 350px; text-align: center; }
        h2 { color: #166534; margin-bottom: 25px; }
        .form-group { margin-bottom: 20px; text-align: left; }
        label { display: block; margin-bottom: 5px; color: #333; font-weight: 600; }
        input[type="text"], input[type="password"] { width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc; box-sizing: border-box; }
        input[type="submit"] { width: 100%; padding: 12px; background-color: #22c55e; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 16px; font-weight: bold; transition: background-color 0.3s; }
        input[type="submit"]:hover { background-color: #16a34a; }
        .message { padding: 10px; margin-bottom: 20px; border-radius: 6px; color: white; }
        .error { background-color: #ef4444; }
        .success { background-color: #22c55e; }
        .login-link { margin-top: 20px; font-size: 14px; }
        .login-link a { color: #16a34a; text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>

<div class="container">
    <h2>Buat Akun MyBin</h2>
    <?php if ($message): ?>
        <div class="message <?php echo $message_type; ?>"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    <form method="POST" action="register.php">
        <div class="form-group">
            <label for="nama">Nama Lengkap:</label>
            <input type="text" id="nama" name="nama" required>
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <input type="submit" value="Daftar">
    </form>
    <div class="login-link">
        Sudah punya akun? <a href="login.php">Masuk di sini</a>
    </div>
</div>

</body>
</html>