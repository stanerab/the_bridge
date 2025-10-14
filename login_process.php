<?php
session_start();
require_once "db_connect.php"; // your DB connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username_email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($username) || empty($password)) {
        header("Location: login.php?error=" . urlencode("Please fill in all fields."));
        exit;
    }

    // Fetch user from database
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        // Verify hashed password
        if (password_verify($password, $user['password'])) {
            // Correct password: store session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Redirect to choose_role.php
            header("Location: choose_role.php");
            exit;
        } else {
            // Password incorrect
            header("Location: login.php?error=" . urlencode("Incorrect password."));
            exit;
        }
    } else {
        // User not found
        header("Location: login.php?error=" . urlencode("User not found."));
        exit;
    }
} else {
    // Invalid request method
    header("Location: login.php");
    exit;
}
?>