<?php
session_start();
require_once __DIR__ . '/../includes/db.php';



if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
   header("Location: /adhd_bridge/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {

    $userId = (int) $_POST['user_id'];

    // Prevent admin deleting themselves
    if ($userId === $_SESSION['user_id']) {
        header("Location: staff_list.php?error=self_delete");
        exit;
    }

    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$userId]);

}

header("Location: staff_list.php");
exit;
