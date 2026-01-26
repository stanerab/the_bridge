<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    die("Access denied");
}

require_once __DIR__ . '/../includes/db.php';

if (!isset($_POST['service_user_id'])) {
    die("Invalid request.");
}

$id = (int) $_POST['service_user_id'];

$stmt = $pdo->prepare("
    UPDATE service_users 
    SET status = 'archived', updated_by = ?, updated_at = NOW()
    WHERE id = ?
");
$stmt->execute([$_SESSION['user_id'], $id]);

header("Location: service_users_list.php?archived=1");
exit;
