<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: /adhd_bridge/login.php");
    exit;
}

require_once __DIR__ . '/../includes/db.php';



$name = $_POST['name'];
$dob = $_POST['dob'] ?: null;
$gender = $_POST['gender'] ?: null;
$ward_id = $_POST['ward_id'];
$created_by = $_POST['created_by'];  // <-- pick up the hidden field

$stmt = $pdo->prepare("
    INSERT INTO service_users (name, dob, gender, ward_id, created_by)
    VALUES (?, ?, ?, ?, ?)
");

$stmt->execute([
    $name,
    $dob,
    $gender,
    $ward_id,
    $created_by
]);

header("Location: service_users_list.php?success=1");
exit;
