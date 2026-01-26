<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../includes/admin_auth.php';
require_once __DIR__ . '/../includes/db.php';



// CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(16));
}
$csrf = $_SESSION['csrf_token'];

// Load wards for dropdown
$wardsStmt = $pdo->query("SELECT id, ward_name FROM wards ORDER BY ward_name ASC");
$wards = $wardsStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-lg-7 col-xl-6">

      <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom">
          <h4 class="mb-0"><i class="bi bi-person-plus me-2"></i>Create Service User</h4>
          <small class="text-muted">Add a new patient and assign them to a ward.</small>
        </div>

        <div class="card-body p-4">

          <form method="POST" action="save_patient.php">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">

            <div class="mb-3">
              <label class="form-label fw-semibold">Full Name</label>
              <input class="form-control" type="text" name="name" required maxlength="255" autocomplete="off">
            </div>

            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label fw-semibold">Date of Birth</label>
                <input class="form-control" type="date" name="dob">
              </div>

              <div class="col-md-6">
                <label class="form-label fw-semibold">Gender</label>
                <select class="form-select" name="gender">
                  <option value="" selected>Prefer not to say</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                  <option value="other">Other</option>
                  <option value="prefer_not">Prefer not to say</option>
                </select>
              </div>
            </div>

            <div class="mt-3">
              <label class="form-label fw-semibold">Assigned Ward</label>
              <select class="form-select" name="ward_id" required>
                <option value="" selected disabled>Select ward</option>
                <?php foreach ($wards as $w): ?>
                  <option value="<?= (int)$w['id'] ?>">
                    <?= htmlspecialchars($w['ward_name']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
              <div class="form-text">You can change ward later from “Edit Service User”.</div>
            </div>

            <div class="d-flex justify-content-between mt-4">
              <a href="service_users_list.php" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Back
              </a>
              <button class="btn btn-success" type="submit">
                <i class="bi bi-check2-circle"></i> Create Service User
              </button>
            </div>
          </form>

        </div>
      </div>

    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
