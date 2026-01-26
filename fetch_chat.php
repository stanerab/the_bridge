<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Auto-switch DB depending on environment
if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $dbname = 'adhdbridge';
} else {
    $host = 'sql100.infinityfree.com';
    $user = 'if0_40168601';
    $pass = 'Stanley00';
    $dbname = 'if0_40168601_adhdbridge';
}

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    echo json_encode(["error" => $conn->connect_error]);
    exit;
}

// Get patient ID from request
$service_user_id = isset($_GET['uid']) ? (int)$_GET['uid'] : 0;

if ($service_user_id <= 0) {
    echo json_encode(["error" => "No patient selected"]);
    exit;
}

// Fetch only THIS patient's moods + staff name
$stmt = $conn->prepare("
    SELECT m.mood, m.note, m.created_at, u.name AS staff_name
    FROM mood_table m
    JOIN users u ON m.worker_id = u.id
    WHERE m.service_user_id = ?
    ORDER BY m.created_at ASC
");

$stmt->bind_param("i", $service_user_id);
$stmt->execute();
$result = $stmt->get_result();

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

header('Content-Type: application/json');
echo json_encode($messages);
exit;
