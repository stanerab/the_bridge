<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Load environment variables
require_once __DIR__ . '/env_loader.php';
loadEnv(__DIR__ . '/.env');

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

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}