<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$mysqli = new mysqli('localhost', 'root', '', 'login');

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
echo "Database connected successfully!<br>";

// Debug: Show posted form data
echo '<pre>';
print_r($_POST);
echo '</pre>';

// Get form data
$user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
$mood = isset($_POST['mood']) ? trim($_POST['mood']) : '';

// Check for empty fields
if ($user_id <= 0 || empty($mood)) {
    die("User ID and mood cannot be empty.");
}

// Prepare and execute insert query
$stmt = $mysqli->prepare("INSERT INTO mood_table (user_id, mood) VALUES (?, ?)");
$stmt->bind_param("is", $user_id, $mood);

if ($stmt->execute()) {
    echo "Mood saved successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$mysqli->close();
?>