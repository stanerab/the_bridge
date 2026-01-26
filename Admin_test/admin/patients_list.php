<?php
require_once __DIR__ . '/../includes/admin_auth.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/header.php';

$patients = $pdo->prepare("SELECT id, name, email, created_at, created_by FROM users WHERE role = 'patient' ORDER BY created_at DESC");
$patients->execute();
$rows = $patients->fetchAll();
?>

<div class="container py-4">
  <h3>All Patients</h3>

  <?php if (isset($_GET['created'])): ?>
    <div class="alert alert-success">New patient created.</div>
  <?php endif; ?>

  <table class="table table-striped">
    <thead>
      <tr><th>#</th><th>Name</th><th>Email</th><th>Created at</th><th>Actions</th></tr>
    </thead>
    <tbody>
      <?php foreach ($rows as $r): ?>
        <tr>
          <td><?= (int)$r['id'] ?></td>
          <td><?= htmlspecialchars($r['name']) ?></td>
          <td><?= htmlspecialchars($r['email']) ?></td>
          <td><?= htmlspecialchars($r['created_at']) ?></td>
          <td>
            <a class="btn btn-sm btn-primary" href="view_patient.php?id=<?= (int)$r['id'] ?>">View</a>
          </td>
        </tr>
      <?php endforeach; ?>
      <?php if (empty($rows)): ?>
        <tr><td colspan="5">No patients yet.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>


        
<?php include("../includes/footer.php"); ?>