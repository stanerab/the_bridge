<?php
session_start();

// Allowed staff roles
$allowed_roles = ['support_worker','nurse','clinician','ward_manager'];
if (!in_array($_SESSION['role'], $allowed_roles)) {
    header("Location: /adhd_bridge/login.php");
    exit;
}

require_once __DIR__ . "/admin/includes/db.php";


// Get patient ID
$service_user_id = (int)$_GET['id'];

// Get worker’s ward
$staff_ward = $_SESSION['ward_id'];

// Verify patient belongs to the same ward
$stmt = $pdo->prepare("
    SELECT service_users.*, wards.ward_name 
    FROM service_users
    LEFT JOIN wards ON service_users.ward_id = wards.id
    WHERE service_users.id = ?
");
$stmt->execute([$service_user_id]);
$patient = $stmt->fetch();

// Block access if patient is from a different ward
if (!$patient || $patient['ward_id'] != $staff_ward) {
    echo "Access denied. This user is not in your ward.";
    exit;
}

// Get mood history
$moodStmt = $pdo->prepare("
    SELECT * FROM mood_table
    WHERE service_user_id = ?
    ORDER BY entry_date DESC
");
$moodStmt->execute([$service_user_id]);
$moodHistory = $moodStmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
<title>Service User Details</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="container py-4">

<h2><?= htmlspecialchars($patient['name']) ?></h2>
<p><strong>DOB:</strong> <?= htmlspecialchars($patient['dob']) ?></p>
<p><strong>Gender:</strong> <?= htmlspecialchars($patient['gender']) ?></p>
<p><strong>Ward:</strong> <?= htmlspecialchars($patient['ward_name']) ?></p>

<div class="mb-3">
    <a href="print_service_user.php?id=<?= $service_user_id ?>" 
       class="btn btn-secondary" target="_blank">
        Print Patient Profile
    </a>
</div>

<hr>

<h4>Add Mood Entry</h4>

<form method="POST" action="save_mood.php">
    <input type="hidden" name="service_user_id" value="<?= $service_user_id ?>">

    <div class="mb-3">
        <label>Mood Score (1-5)</label>
        <input type="number" name="mood_score" class="form-control" min="1" max="5" required>
    </div>

    <div class="mb-3">
        <label>Note (optional)</label>
        <textarea name="note" class="form-control"></textarea>
    </div>

    <button class="btn btn-primary">Save Mood</button>
</form>

<hr>

<h4>Mood History</h4>

<?php if (count($moodHistory) === 0): ?>
    <p>No mood entries yet.</p>
<?php else: ?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Date</th>
            <th>Mood Score</th>
            <th>Note</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($moodHistory as $m): ?>
        <tr>
            <td><?= $m['entry_date'] ?></td>
            <td><?= $m['mood_value'] ?></td>
            <td><?= htmlspecialchars($m['note']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>

<hr>

<h4>Mood Graph</h4>
<canvas id="moodChart"></canvas>

<script>
const labels = [
    <?php foreach ($moodHistory as $m): ?>
        "<?= $m['entry_date'] ?>",
    <?php endforeach; ?>
];

const data = [
    <?php foreach ($moodHistory as $m): ?>
        <?= $m['mood_value'] ?>,
    <?php endforeach; ?>
];

const ctx = document.getElementById('moodChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: labels.reverse(),
        datasets: [{
            label: 'Mood Score Over Time',
            data: data.reverse(),
            borderWidth: 2
        }]
    }
});
</script>

</body>
</html>
