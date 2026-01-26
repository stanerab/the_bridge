<?php
session_start();

$allowed_roles = ['support_worker','nurse','clinician','ward_manager'];
if (!in_array($_SESSION['role'], $allowed_roles)) {
    header("Location: /adhd_bridge/login.php");
    exit;
}

require_once __DIR__ . "/admin/includes/db.php";


$service_user_id = $_POST['service_user_id'];
$mood_score = $_POST['mood_score'];
$note = $_POST['note'];

$stmt = $pdo->prepare("
    INSERT INTO mood_table (service_user_id, mood, note, entry_date)
    VALUES (?, ?, ?, NOW())
");
$stmt->execute([
    $service_user_id,
    $mood_score,
    $note
]);

// 🔥 FIXED REDIRECT (must include uid)
header("Location: /adhd_bridge/home.php?uid=" . $service_user_id);
exit;
