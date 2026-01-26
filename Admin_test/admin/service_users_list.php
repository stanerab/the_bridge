<?php
session_start();
require_once __DIR__ . '/../includes/db.php';

// Admin-only access
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: /adhd_bridge/login.php");
    exit;
}

// Active patients
$activeStmt = $pdo->query("
    SELECT 
        su.*, 
        w.ward_name, 
        u.name AS created_by_name
    FROM service_users su
    LEFT JOIN wards w ON su.ward_id = w.id
    LEFT JOIN users u ON su.created_by = u.id
    WHERE su.status = 'active'
    ORDER BY su.name ASC
");
$activePatients = $activeStmt->fetchAll(PDO::FETCH_ASSOC);

// Archived patients
$archivedStmt = $pdo->query("
    SELECT 
        su.*, 
        w.ward_name, 
        u.name AS created_by_name
    FROM service_users su
    LEFT JOIN wards w ON su.ward_id = w.id
    LEFT JOIN users u ON su.created_by = u.id
    WHERE su.status = 'archived'
    ORDER BY su.name ASC
");
$archivedPatients = $archivedStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Service Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
    
<?php include(__DIR__ . "/../includes/admin_header.php");?>

<div class="container py-4">

    <!-- ACTIVE PATIENTS -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white border-bottom">
            <h4 class="mb-0"><i class="bi bi-people"></i> Active Service Users</h4>
            <small class="text-muted">Currently admitted patients</small>
        </div>

        <div class="card-body p-0">
            <?php if (empty($activePatients)): ?>
                <div class="p-4 text-center text-muted">No active service users.</div>
            <?php else: ?>
            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>DOB</th>
                            <th>Gender</th>
                            <th>Ward</th>
                            <th>Created By</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($activePatients as $p): ?>
                        <tr>
                            <td><?= htmlspecialchars($p['name']) ?></td>
                            <td><?= htmlspecialchars($p['dob']) ?></td>
                            <td><?= htmlspecialchars($p['gender']) ?></td>
                            <td><?= htmlspecialchars($p['ward_name'] ?? '—') ?></td>
                            <td><?= htmlspecialchars($p['created_by_name'] ?? '—') ?></td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    <a href="edit_service_user.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <a href="export_patient_moods.php?uid=<?= $p['id'] ?>" class="btn btn-sm btn-outline-success">
                                        <i class="bi bi-download"></i>
                                    </a>

                                    <form method="POST" action="archive_service_user.php" class="d-inline"
                                          onsubmit="return confirm('Archive this service user? They can be restored later.');">
                                        <input type="hidden" name="service_user_id" value="<?= $p['id'] ?>">
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-archive"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </div>
    </div>

   <!-- ARCHIVED PATIENTS -->
<div class="card shadow-sm">
    <div class="card-header bg-warning-subtle border-bottom">
        <h4 class="mb-0"><i class="bi bi-archive"></i> Archived Service Users</h4>
        <small class="text-muted">Soft-deleted patients (can be restored or permanently removed)</small>
    </div>

    <div class="card-body p-0">
        <?php if (empty($archivedPatients)): ?>
            <div class="p-4 text-center text-muted">No archived service users.</div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Ward</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($archivedPatients as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['name']) ?></td>
                        <td><?= htmlspecialchars($p['ward_name'] ?? '—') ?></td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                <!-- Restore -->
                                <form method="POST" action="restore_service_user.php"
                                      onsubmit="return confirm('Restore this service user?');">
                                    <input type="hidden" name="service_user_id" value="<?= $p['id'] ?>">
                                    <button class="btn btn-sm btn-outline-success">
                                        <i class="bi bi-arrow-counterclockwise"></i>
                                    </button>
                                </form>

                                <!-- HARD DELETE (Permanent) -->
                                <form method="POST" action="hard_delete_service_user.php"
                                      onsubmit="return confirm('⚠ Permanently delete this service user and ALL their data? This cannot be undone.');">
                                    <input type="hidden" name="service_user_id" value="<?= $p['id'] ?>">
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include("../includes/footer.php"); ?>