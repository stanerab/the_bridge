<?php
include("db_connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['note'])) {
    $note = trim($_POST['note']);
    $mood = 'Neutral';

    if (!empty($note)) {
        $stmt = $conn->prepare("INSERT INTO chat_messages (mood, note, created_at) VALUES (?, ?, NOW())");
        $stmt->bind_param("ss", $mood, $note);
        if ($stmt->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["error" => "Database error."]);
        }
        $stmt->close();
    } else {
        echo json_encode(["error" => "Empty note."]);
    }
} else {
    echo json_encode(["error" => "Invalid request."]);
}
?>