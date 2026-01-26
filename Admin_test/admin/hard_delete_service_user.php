<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access denied");
}

require_once __DIR__ . '/../includes/db.php';

if (!isset($_POST['service_user_id'])) {
    die("Invalid request");
}

$id = (int) $_POST['service_user_id'];

// First delete mood records (referential integrity)
$stmt = $pdo->prepare("DELETE FROM mood_table WHERE service_user_id = ?");
$stmt->execute([$id]);

// Then delete the service user
$stmt = $pdo->prepare("DELETE FROM service_users WHERE id = ?");
$stmt->execute([$id]);

header("Location: service_users_list.php?deleted=1");
exit;
