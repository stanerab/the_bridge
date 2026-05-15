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
    // Production database — credentials stored in environment, not in source
    $servername = "REMOVED";
    $username = "REMOVED";
    $password = "REMOVED";
    $dbname = "REMOVED";
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}