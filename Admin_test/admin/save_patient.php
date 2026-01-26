<?php
require_once __DIR__ . '/../includes/admin_auth.php';
require_once __DIR__ . '/../includes/db.php';


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: create_patient.php');
    exit;
}

// CSRF check
if (empty($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die('Invalid CSRF token');
}

// sanitize
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($name === '' || $email === '' || $password === '') {
    die('All fields are required.');
}

// check email uniqueness
$stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);
if ($stmt->fetch()) {
    die('Email already exists. Choose another.');
}

$hash = password_hash($password, PASSWORD_DEFAULT);

$insert = $pdo->prepare("INSERT INTO users (name, email, password, role, created_by) VALUES (?, ?, ?, 'patient', ?)");
$insert->execute([$name, $email, $hash, $_SESSION['user_id']]);

// Optionally: send email to patient with temp password (not included here)

header('Location: patients_list.php?created=1');
exit;
