<?php
session_start();

// Only admin can access
if ($_SESSION['role'] !== 'admin') {
    header("Location: /adhd_bridge/login.php");
    exit;
}
require_once __DIR__ . '/../includes/db.php';



$name = $_POST['name'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role = $_POST['role'];
$ward_id = $_POST['ward_id'];

$stmt = $pdo->prepare("
    INSERT INTO users (name, email, username, password, role, ward_id, created_by)
    VALUES (?, ?, ?, ?, ?, ?, ?)
");

$stmt->execute([
    $name,
    $email,
    $username,
    $password,
    $role,
    $ward_id,
    $_SESSION['user_id']   // admin who created staff
]);

header("Location: staff_list.php?success=1");
exit;
?>
