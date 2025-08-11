<?php
session_start();
require_once "db_connect.php"; // Your DB connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username_email = $_POST['username_email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!$username_email || !$password) {
        header("Location: login.php?error=" . urlencode("Please fill in all fields."));
        exit;
    }

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, username, email, password_hash FROM users WHERE username = ? OR email = ? LIMIT 1");
    $stmt->bind_param("ss", $username_email, $username_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        // Verify password
        if (password_verify($password, $user['password_hash'])) {
            // Password correct, set session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            header("Location: dashboard.php"); // Redirect after login
            exit;
        } else {
            header("Location: login.php?error=" . urlencode("Incorrect password."));
            exit;
        }
    } else {
        header("Location: login.php?error=" . urlencode("User not found."));
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}
