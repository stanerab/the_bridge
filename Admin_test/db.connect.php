<?php
// Load environment variables (env_loader is one level up at project root)
require_once __DIR__ . '/../env_loader.php';
loadEnv(__DIR__ . '/../.env');

// Pick credentials based on environment
$env = $_ENV['APP_ENV'] ?? 'local';

if ($env === 'local') {
    $servername = $_ENV['DB_LOCAL_HOST'];
    $username   = $_ENV['DB_LOCAL_USER'];
    $password   = $_ENV['DB_LOCAL_PASS'];
    $dbname     = $_ENV['DB_LOCAL_NAME'];
} else {
    $servername = $_ENV['DB_PROD_HOST'];
    $username   = $_ENV['DB_PROD_USER'];
    $password   = $_ENV['DB_PROD_PASS'];
    $dbname     = $_ENV['DB_PROD_NAME'];
}

$charset = "utf8mb4";
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