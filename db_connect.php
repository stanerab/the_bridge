<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Detect if running locally (supports IPv4, IPv6, and hostname)
$isLocal = (
    isset($_SERVER['HTTP_HOST']) &&
    (
        $_SERVER['HTTP_HOST'] === 'localhost' ||
        $_SERVER['HTTP_HOST'] === '127.0.0.1' ||
        $_SERVER['HTTP_HOST'] === '::1'
    )
);

if ($isLocal) {
    // Local XAMPP database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "adhdbridge";
} else {
    // InfinityFree database
    $servername = "sql100.infinityfree.com";
    $username = "if0_40168601";
    $password = "Stanley00";
    $dbname = "if0_40168601_adhdbridge";
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
