<?php
session_start();
require_once __DIR__ . '/../includes/db.php';



// Admin-only access
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: /adhd_bridge/login.php");
    exit;
}

// Fetch staff
$stmt = $pdo->query("
    SELECT users.*, wards.ward_name
    FROM users
    LEFT JOIN wards ON users.ward_id = wards.id
");
$staff = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Management</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons (IMPORTANT for your header icons) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light">

<?php include(__DIR__ . "/../includes/admin_header.php");?>


<!-- PAGE CONTENT CONTAINER -->
<div class="container py-4">

    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h4 class="mb-0">👥 Staff Accounts</h4>
            <small class="text-muted">Manage and delete staff accounts</small>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Ward</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th class="text-center" style="width:120px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php foreach ($staff as $s): ?>
<tr>
    <td><?= htmlspecialchars($s['name'] ?? '') ?></td>
    <td>
        <span class="badge <?= ($s['role'] ?? '') === 'admin' ? 'bg-danger' : 'bg-secondary' ?>">
            <?= htmlspecialchars($s['role'] ?? '') ?>
        </span>
    </td>
    <td><?= htmlspecialchars($s['ward_name'] ?? '—') ?></td>
    <td><?= htmlspecialchars($s['username'] ?? '') ?></td>
    <td><?= htmlspecialchars($s['email'] ?? '') ?></td>
    <td class="text-center">
        <?php if (($s['id'] ?? 0) != ($_SESSION['user_id'] ?? 0)): ?>
            <form method="POST"
                  action="delete_staff.php"
                  class="d-inline"
                  onsubmit="return confirm('Are you sure you want to delete this staff account?');">
                <input type="hidden" name="user_id" value="<?= $s['id'] ?>">
                <button class="btn btn-sm btn-outline-danger">
                    Delete
                </button>
            </form>
        <?php else: ?>
            <span class="text-muted small">You</span>
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include("../includes/footer.php"); ?>