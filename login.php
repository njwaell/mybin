<?php
session_start();
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Cek username
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Simpan data user ke session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['nama'] = $user['nama'];

            header("Location: dashboard.php");
            exit;
        } else {
            echo "<script>alert('Password salah!'); window.location.href='login.php';</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan!'); window.location.href='login.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f8fa;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 50px;
        }
        form {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            width: 320px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            width: 100%;
            padding: 8px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        a {
            color: #007bff;
            text-decoration: none;
            display: block;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<h2>Login Akun</h2>
<form method="POST" action="">
    <label>Username:</label><br>
    <input type="text" name="username" required><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br>

    <input type="submit" value="Login">
</form>

<a href="register.php">Belum punya akun? Daftar di sini</a>

</body>
</html>
