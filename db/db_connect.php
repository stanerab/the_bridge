<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

$mysqli = new mysqli('localhost', 'root', '', 'login');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>