<?php
require_once __DIR__ . '/../includes/admin_auth.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/header.php';

$patientId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($patientId <= 0) { echo "<div class='container py-4'>Invalid patient ID.</div>"; exit; }

// fetch patient
$stmt = $pdo->prepare("SELECT id, name, email FROM users WHERE id = ? AND role = 'patient'");
$stmt->execute([$patientId]);
$patient = $stmt->fetch();
if (!$patient) { echo "<div class='container py-4'>Patient not found.</div>"; exit; }

// fetch chats
$chatStmt = $pdo->prepare("SELECT sender, message, created_at FROM chats WHERE patient_id = ? ORDER BY created_at ASC");
$chatStmt->execute([$patientId]);
$chats = $chatStmt->fetchAll();

// fetch moods
$moodStmt = $pdo->prepare("SELECT mood_score, note, created_at FROM moods WHERE patient_id = ? ORDER BY created_at ASC");
$moodStmt->execute([$patientId]);
$moods = $moodStmt->fetchAll();

?>

<div class="container py-4">
  <h3>Patient: <?= htmlspecialchars($patient['name']) ?> (<?= htmlspecialchars($patient['email']) ?>)</h3>

  <div class="row mt-3">
    <div class="col-md-6">
      <h5>Chats</h5>
      <div class="list-group">
        <?php foreach ($chats as $c): ?>
          <div class="list-group-item">
            <small class="text-muted"><?= htmlspecialchars($c['created_at']) ?> — <?= htmlspecialchars($c['sender']) ?></small>
            <p class="mb-0"><?= nl2br(htmlspecialchars($c['message'])) ?></p>
          </div>
        <?php endforeach; ?>
        <?php if (empty($chats)): ?>
          <div class="list-group-item">No chats yet.</div>
        <?php endif; ?>
      </div>
    </div>

    <div class="col-md-6">
      <h5>Mood History</h5>
      <canvas id="moodChart" height="200"></canvas>
      <ul class="list-group mt-3">
        <?php foreach ($moods as $m): ?>
          <li class="list-group-item">
            <strong><?= (int)$m['mood_score'] ?>/5</strong> — <?= htmlspecialchars($m['created_at']) ?>
            <?php if (!empty($m['note'])): ?>
              <div><?= nl2br(htmlspecialchars($m['note'])) ?></div>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
        <?php if (empty($moods)): ?>
          <li class="list-group-item">No mood entries yet.</li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</div>

<script>
const moodData = <?= json_encode(array_map(function($m){ return ['label'=>$m['created_at'],'score'=> (int)$m['mood_score']]; }, $moods)); ?>;

const labels = moodData.map(d => d.label);
const data = moodData.map(d => d.score);

const ctx = document.getElementById('moodChart').getContext('2d');
new Chart(ctx, {
  type: 'line',
  data: {
    labels: labels,
    datasets: [{
      label: 'Mood (1-5)',
      data: data,
      fill: false,
      tension: 0.2
    }]
  },
  options: {
    scales: {
      y: { min: 0, max: 5, ticks: { stepSize: 1 } }
    }
  }
});
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
