<?php
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $nama     = trim($_POST['nama']);

    // Cek apakah username sudah terdaftar
    $check = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $check->bind_param("s", $username);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Username sudah digunakan!'); window.location.href='register.php';</script>";
        exit;
    }

    // Insert data ke tabel
    $stmt = $conn->prepare("INSERT INTO users (username, password, nama) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $nama);

    if ($stmt->execute()) {
        echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location.href='login.php';</script>";
    } else {
        echo "Terjadi kesalahan: " . $stmt->error;
    }

    $stmt->close();
    $check->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Registrasi</title>
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
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h2>Registrasi Akun</h2>
<form method="POST" action="">
    <label>Username:</label><br>
    <input type="text" name="username" required><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br>

    <label>Nama Lengkap:</label><br>
    <input type="text" name="nama" required><br>

    <input type="submit" value="Daftar">
</form>

</body>
</html>
