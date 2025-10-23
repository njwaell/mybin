<?php
$host = "localhost";
$user = "root"; // Adjust with your MySQL username
$pass = "";     // Fill in if you use a password
$dbname = "mybin";

// Enable error reporting for connection issues
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Create connection
try {
    $conn = new mysqli($host, $user, $pass, $dbname);
    // Set charset to avoid character encoding issues
    $conn->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {
    // A more user-friendly message for a production environment
    // For development, you can use: die("Connection failed: " . $e->getMessage());
    die("Error: Could not connect to the database. Please try again later.");
}
?>