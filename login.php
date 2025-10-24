<?php
session_start();
require 'connection.php';
$error = '';
$success_message = '';

// Check for success message from registration
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']); // Unset the message so it doesn't show again
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $error = 'Username dan password wajib diisi!';
    } else {
        $stmt = $conn->prepare("SELECT id, username, password, nama, poin FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                // Store user data in session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['nama'] = $user['nama'];
                $_SESSION['poin'] = $user['poin'];

                header("Location: dashboard.php");
                exit;
            } else {
                $error = 'Password yang Anda masukkan salah!';
            }
        } else {
            $error = 'Username tidak ditemukan!';
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
    <title>Login - MyBin</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f0fdf4; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .container { background: white; padding: 30px 40px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); width: 350px; text-align: center; }
        h2 { color: #166534; margin-bottom: 25px; }
        .form-group { margin-bottom: 20px; text-align: left; }
        label { display: block; margin-bottom: 5px; color: #333; font-weight: 600; }
        input[type="text"], input[type="password"] { width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc; box-sizing: border-box; }
        input[type="submit"] { width: 100%; padding: 12px; background-color: #16a34a; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 16px; font-weight: bold; transition: background-color 0.3s; }
        input[type="submit"]:hover { background-color: #15803d; }
        .message { padding: 10px; margin-bottom: 20px; border-radius: 6px; color: white; }
        .error { background-color: #ef4444; }
        .success { background-color: #22c55e; }
        .register-link { margin-top: 20px; font-size: 14px; }
        .register-link a { color: #16a34a; text-decoration: none; font-weight: 600; }
    </style>
</head>
<body>

<div class="container">
    <h2>Selamat Datang Kembali!</h2>
    <?php if ($error): ?>
        <div class="message error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <?php if ($success_message): ?>
        <div class="message success"><?php echo htmlspecialchars($success_message); ?></div>
    <?php endif; ?>
    <form method="POST" action="login.php">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <input type="submit" value="Login">
    </form>
    <div class="register-link">
        Belum punya akun? <a href="register.php">Daftar di sini</a>
    </div>
</div>

</body>
</html>