<?php
session_start();

// Only admin can delete
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: /adhd_bridge/login.php");
    exit;
}

require_once __DIR__ . '/../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: service_users_list.php?error=invalid_request");
    exit;
}

$service_user_id = isset($_POST['service_user_id']) ? (int)$_POST['service_user_id'] : 0;

if ($service_user_id <= 0) {
    header("Location: service_users_list.php?error=invalid_user");
    exit;
}

// Check user exists
$check = $pdo->prepare("SELECT id FROM service_users WHERE id = ?");
$check->execute([$service_user_id]);

if (!$check->fetch()) {
    header("Location: service_users_list.php?error=not_found");
    exit;
}

// Delete moods first (FK safety if cascade not enabled)
$pdo->prepare("DELETE FROM mood_table WHERE service_user_id = ?")->execute([$service_user_id]);

// Delete patient
$pdo->prepare("DELETE FROM service_users WHERE id = ?")->execute([$service_user_id]);

// Redirect with success
header("Location: service_users_list.php?deleted=1");
exit;
