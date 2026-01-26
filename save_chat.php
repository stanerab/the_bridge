<?php
include("db_connect.php");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["error" => "Invalid request"]);
    exit;
}

$note = trim($_POST['note'] ?? '');
$mood = strtolower(trim($_POST['mood'] ?? ''));

// Allowed moods
$allowedMoods = ['happy', 'okay', 'neutral', 'sad', 'angry'];

if ($note === '') {
    echo json_encode(["error" => "Empty note"]);
    exit;
}

if (!in_array($mood, $allowedMoods)) {
    echo json_encode(["error" => "Invalid or missing mood"]);
    exit;
}

$stmt = $conn->prepare("
    INSERT INTO mood_table (mood, note, created_at)
    VALUES (?, ?, NOW())
");

$stmt->bind_param("ss", $mood, $note);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["error" => $stmt->error]);
}

$stmt->close();
