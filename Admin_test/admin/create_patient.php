<?php
require_once __DIR__ . '/../includes/admin_auth.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/header.php';

// Simple CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(16));
}
$csrf = $_SESSION['csrf_token'];
?>

<div class="container py-4">
  <div class="row">
    <div class="col-md-6">
      <h3>Create Patient</h3>

      <form method="POST" action="save_patient.php" class="mt-3">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf) ?>">
        <div class="mb-3">
    <label class="form-label">Full Name</label>
    <input class="form-control" type="text" name="name" required>
</div>

<div class="mb-3">
    <label class="form-label">Date of Birth</label>
    <input class="form-control" type="date" name="dob" required>
</div>

<div class="mb-3">
    <label class="form-label">Gender</label>
    <select class="form-control" name="gender" required>
        <option value="">Select Gender</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Other</option>
        <option value="prefer_not">Prefer not to say</option>
    </select>
</div>

        

        <div class="mb-3">
          <label class="form-label">Email</label>
          <input class="form-control" name="email" type="email" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Temporary password</label>
          <input class="form-control" name="password" type="password" required>
          <div class="form-text">Patient should change password on first login.</div>
        </div>

        <button class="btn btn-success" type="submit">Create Patient</button>
      </form>

    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
