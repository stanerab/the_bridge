<?php
require 'includes/db.php';
$name = 'Dr Admin';
$email = 'admin@example.com';
$pass = 'changeThis123';
$hash = password_hash($pass, PASSWORD_DEFAULT);

$insert = $pdo->prepare("
    INSERT INTO users (username, email, password, role)
    VALUES (?, ?, ?, 'admin')
");
$insert->execute([$username, $email, $hash]);


echo "Admin created.";
?>
