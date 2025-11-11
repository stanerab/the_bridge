<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Detect if running locally
if ($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_ADDR'] == '127.0.0.1') {
    // Local XAMPP database
    $servername = "localhost";
    $username = "root";
    $password = ""; // default XAMPP password
    $dbname = "adhdbridge"; // your local database name
} else {
    // InfinityFree remote database
    $servername = "sql100.infinityfree.com";
    $username = "if0_40168601";
    $password = "Stanleyson00";
    $dbname = "if0_40168601_adhdbridge";
}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>