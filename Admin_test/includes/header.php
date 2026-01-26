<?php
if (session_status() === PHP_SESSION_NONE) session_start();

$role = $_SESSION['role'] ?? null;
?>

  <style>
        .bridge-logo {
    height: 60px;
    transform: scale(2.2);
    transform-origin: left center;
}

    </style>
<?php if ($role === 'admin'): ?>


<!-- ================= ADMIN HEADER ================= -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm mb-4">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
            <img src="assets/logo.svg" class="bridge-logo" alt="The Bridge">
        </a>

        <div class="d-flex align-items-center">
            <span class="me-3 text-muted">
                Welcome, <?= htmlspecialchars($_SESSION['adminName'] ?? 'Admin') ?>
            </span>
            <a href="../logout.php" class="btn btn-outline-danger btn-sm">
                <i class="bi bi-box-arrow-right me-1"></i>Logout
            </a>
        </div>

    </div>
</nav>

<?php else: ?>

<!-- ================= WORKER HEADER ================= -->
<nav class="navbar navbar-expand-lg navbar-custom navbar-dark">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
          <img src="../assets/logo.svg" class="bridge-logo" alt="The Bridge">
        </a>

        <div class="d-flex align-items-center">

            <div class="me-3 text-white text-end">
                <div class="small">Logged in as</div>
                <div class="fw-medium"><?= htmlspecialchars($_SESSION['name']) ?></div>
            </div>

            <span class="role-badge me-3">
                <?= htmlspecialchars(ucfirst(str_replace('_', ' ', $_SESSION['role']))) ?>
            </span>

            <a href="../logout.php" class="btn btn-light btn-sm">
                <i class="bi bi-box-arrow-right me-1"></i>Logout
            </a>

        </div>
    </div>
</nav>

<?php endif; ?>
