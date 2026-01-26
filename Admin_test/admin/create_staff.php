<?php
session_start();
require_once __DIR__ . '/../includes/db.php';



// Only admin can access
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: /adhd_bridge/login.php");
    exit;
}

// Fetch wards for dropdown
$wards = $pdo->query("SELECT * FROM wards ORDER BY ward_name ASC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Staff Account</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons (for header icons) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

<?php include("../includes/header.php"); ?>

<!-- PAGE CONTENT -->
<div class="container py-4">

    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">

            <div class="card shadow-sm">

                <!-- CARD HEADER -->
                <div class="card-header bg-white border-bottom">
                    <h4 class="mb-0">Create Staff Account</h4>
                    <small class="text-muted">Add a new staff member to the system</small>
                </div>

                <!-- CARD BODY -->
                <div class="card-body">

                    <form method="POST" action="save_staff.php">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Full Name</label>
                                <input class="form-control" type="text" name="name" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input class="form-control" type="email" name="email" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Username</label>
                                <input class="form-control" type="text" name="username" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Password</label>
                                <input class="form-control" type="password" name="password" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Role</label>
                                <select class="form-select" name="role" required>
                                    <option value="">Select role</option>
                                    <option value="support_worker">Support Worker</option>
                                    <option value="nurse">Nurse</option>
                                    <option value="clinician">Clinician</option>
                                    <option value="ward_manager">Ward Manager</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Assign to Ward</label>
                                <select class="form-select" name="ward_id" required>
                                    <option value="">Select ward</option>
                                    <?php foreach ($wards as $w): ?>
                                        <option value="<?= $w['id'] ?>">
                                            <?= htmlspecialchars($w['ward_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button class="btn btn-primary">
                                Create Staff
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
