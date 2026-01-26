<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    die("Access denied");
}

require_once __DIR__ . '/../includes/db.php';

$id   = (int)$_POST['id'];
$name = $_POST['name'];
$dob  = $_POST['dob'];
$gender = $_POST['gender'];
$ward = (int)$_POST['ward_id'];

$stmt = $pdo->prepare("
    UPDATE service_users 
    SET name=?, dob=?, gender=?, ward_id=? 
    WHERE id=?
");
$stmt->execute([$name, $dob, $gender, $ward, $id]);

header("Location: service_users_list.php?updated=1");
exit;
