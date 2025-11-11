<?php
include("connection.php"); // live or localhost connection

$sql = "SELECT id, mood, note, created_at FROM mood_table ORDER BY created_at ASC";
$result = $conn->query($sql);

$messages = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($messages);
exit;
?>