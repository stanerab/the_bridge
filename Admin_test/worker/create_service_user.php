<?php
session_start();

// Only admin allowed
if ($_SESSION['role'] !== 'admin') {
   header("Location: /adhd_bridge/login.php");
    exit;
}
require_once __DIR__ . "/admin/includes/db.php";


// Load wards for dropdown
$wards = $pdo->query("SELECT * FROM wards")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
<title>Create Service User</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="container py-4">

<h2>Create Service User (Patient)</h2>

<form method="POST" action="save_service_user.php">

    <div class="mb-3">
        <label>Full Name</label>
        <input class="form-control" type="text" name="name" required>
    </div>

    <div class="mb-3">
        <label>Date of Birth</label>
        <input class="form-control" type="date" name="dob">
    </div>

    <div class="mb-3">
        <label>Gender</label>
        <select class="form-control" name="gender">
            <option value="">Select gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
            <option value="prefer_not">Prefer not to say</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Assign to Ward</label>
        <select class="form-control" name="ward_id" required>
            <option value="">Select ward</option>
            <?php foreach ($wards as $w): ?>
                <option value="<?= $w['id'] ?>"><?= $w['ward_name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <button class="btn btn-primary">Create Service User</button>

</form>

</body>
</html>
