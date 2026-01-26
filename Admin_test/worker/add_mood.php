<?php
session_start();

$allowed_roles = ['support_worker','nurse','clinician','ward_manager'];
if (!in_array($_SESSION['role'], $allowed_roles)) {
    header("Location: /adhd_bridge/login.php");
    exit;
}

require_once __DIR__ . "/admin/includes/db.php";


$serviceUserId = (int)$_GET['id'];

// Optional: check this worker created the patient
$stmt = $pdo->prepare("SELECT * FROM service_users WHERE id = ? AND created_by = ?");
$stmt->execute([$serviceUserId, $_SESSION['user_id']]);
$patient = $stmt->fetch();

// If worker tries to access someone else's patient:
if (!$patient && $_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    exit;
}

?>
<!DOCTYPE html>
<html>
<head><title>Add Mood</title></head>
<body>

<h2>Add Mood Entry for <?= htmlspecialchars($patient['name']) ?></h2>

<form method="POST" action="save_mood.php">
  <input type="hidden" name="service_user_id" value="<?= $serviceUserId ?>">

  <label>Mood (1–5)</label><br>
  <input type="number" name="mood_score" min="1" max="5" required><br><br>

  <label>Note:</label><br>
  <textarea name="note"></textarea><br><br>

  <button type="submit">Save Mood Entry</button>
</form>

</body>
</html>
