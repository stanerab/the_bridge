<?php
// Database connection settings
$servername = "localhost";
$username   = "root";        // XAMPP default
$password   = "";            // XAMPP default (empty password)
$dbname     = "adhdbridge";  // your database name
$charset    = "utf8mb4";

// Create DSN string
$dsn = "mysql:host=$servername;dbname=$dbname;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
