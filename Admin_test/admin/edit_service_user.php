<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    die("Access denied");
}

require_once __DIR__ . '/../includes/db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid service user.");
}

$id = (int) $_GET['id'];

// Load patient with audit info
$stmt = $pdo->prepare("
    SELECT su.*,
           u1.name AS created_by_name,
           u2.name AS updated_by_name
    FROM service_users su
    LEFT JOIN users u1 ON su.created_by = u1.id
    LEFT JOIN users u2 ON su.updated_by = u2.id
    WHERE su.id = ?
");
$stmt->execute([$id]);
$patient = $stmt->fetch();

if (!$patient) {
    die("Service user not found.");
}

// Load wards
$wards = $pdo->query("SELECT * FROM wards ORDER BY ward_name")->fetchAll(PDO::FETCH_ASSOC);
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-person-badge me-2"></i>Edit Service User
                    </h4>
                    <small>Clinical record management & ward assignment</small>
                </div>

                <div class="card-body p-4">

                    <form method="POST" action="update_service_user.php">
                        <input type="hidden" name="id" value="<?= $patient['id'] ?>">

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Full Name</label>
                                <input type="text" name="name" class="form-control"
                                       value="<?= htmlspecialchars($patient['name']) ?>" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Date of Birth</label>
                                <input type="date" name="dob" class="form-control"
                                       value="<?= $patient['dob'] ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Gender</label>
                                <select name="gender" class="form-select">
                                    <option value="male" <?= $patient['gender']=='male'?'selected':'' ?>>Male</option>
                                    <option value="female" <?= $patient['gender']=='female'?'selected':'' ?>>Female</option>
                                    <option value="other" <?= $patient['gender']=='other'?'selected':'' ?>>Other</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Assigned Ward</label>
                                <select name="ward_id" class="form-select">
                                    <?php foreach ($wards as $w): ?>
                                        <option value="<?= $w['id'] ?>"
                                            <?= $w['id']==$patient['ward_id']?'selected':'' ?>>
                                            <?= htmlspecialchars($w['ward_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                               <div class="mb-4">
                            <label class="form-label fw-semibold">Patient Status</label>
                            <select name="status" class="form-select">
                                <option value="active" <?= $patient['status']=='active'?'selected':'' ?>>Active</option>
                                <option value="discharged" <?= $patient['status']=='discharged'?'selected':'' ?>>Discharged</option>
                                <option value="archived" <?= $patient['status']=='archived'?'selected':'' ?>>Archived</option>
                            </select>
                        </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="service_users_list.php" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Back
                            </a>

                            <button class="btn btn-primary">
                                <i class="bi bi-save"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- AUDIT TRAIL -->
            <div class="card mt-4 border-0 shadow-sm">
                <div class="card-header bg-light">
                    <strong><i class="bi bi-shield-check me-2"></i>Clinical Audit Trail</strong>
                </div>
                <div class="card-body small">

                    <div class="row mb-2">
                        <div class="col-5 text-muted">Created By</div>
                        <div class="col-7 fw-semibold">
                            <?= htmlspecialchars($patient['created_by_name'] ?? 'System') ?>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-5 text-muted">Created On</div>
                        <div class="col-7">
                            <?= $patient['created_at'] ?? '—' ?>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-5 text-muted">Last Updated By</div>
                        <div class="col-7 fw-semibold">
                            <?= htmlspecialchars($patient['updated_by_name'] ?? 'Not modified') ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-5 text-muted">Last Updated On</div>
                        <div class="col-7">
                            <?= $patient['updated_at'] ?? '—' ?>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<?php include("../includes/footer.php"); ?>