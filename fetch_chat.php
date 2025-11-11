<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Auto-switch DB depending on environment
if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $dbname = 'adhdbridge';
    $table = 'mood_table';
} else {
    $host = 'sql100.infinityfree.com';
    $user = 'if0_40168601';
    $pass = 'Stanley00';
    $dbname = 'if0_40168601_adhdbridge';
    $table = 'mood_table';
}

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    echo json_encode(["error" => $conn->connect_error]);
    exit;
}

$sql = "SELECT mood, note, created_at FROM $table ORDER BY created_at ASC";
$result = $conn->query($sql);

$messages = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($messages);
exit;
