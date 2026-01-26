<?php
session_start();
require_once __DIR__ . '/../includes/db.php';



// Only admin can access this page
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
 header("Location: /adhd_bridge/login.php");
    exit;
}

// Fetch all wards for dropdown
$wards = $pdo->query("SELECT * FROM wards ORDER BY ward_name ASC")
             ->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Service User</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons (used by header) -->
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
                    <h4 class="mb-0">Create Service User</h4>
                    <small class="text-muted">
                        Add a new service user (patient) record
                    </small>
                </div>

                <!-- CARD BODY -->
                <div class="card-body">

                    <form method="POST" action="save_service_user.php">

                        <!-- Name -->
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="row">
                            <!-- DOB -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" name="dob" class="form-control">
                            </div>

                            <!-- Gender -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Gender</label>
                                <select name="gender" class="form-select">
                                    <option value="">Select gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                    <option value="prefer_not">Prefer not to say</option>
                                </select>
                            </div>
                        </div>

                        <!-- Ward -->
                        <div class="mb-3">
                            <label class="form-label">Assign to Ward</label>
                            <select name="ward_id" class="form-select" required>
                                <option value="">Select ward</option>
                                <?php foreach ($wards as $w): ?>
                                    <option value="<?= $w['id'] ?>">
                                        <?= htmlspecialchars($w['ward_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Created By (display only) -->
                        <div class="mb-3">
                            <label class="form-label">Created By</label>
                            <input type="text"
                                   class="form-control"
                                   value="<?= htmlspecialchars($_SESSION['name'] ?? $_SESSION['username'] ?? '') ?>"
                                   disabled>
                        </div>

                        <!-- Hidden creator ID -->
                        <input type="hidden" name="created_by" value="<?= $_SESSION['user_id'] ?>">

                        <!-- Submit -->
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary">
                                Create Service User
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
