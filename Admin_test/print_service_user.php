<?php
session_start();

// Allowed roles
$allowed_roles = ['support_worker','nurse','clinician','ward_manager', 'admin'];
if (!in_array($_SESSION['role'], $allowed_roles)) {
    header("Location: ../login.php");
    exit;
}

require_once '../includes/db.php';

// Get patient ID
$service_user_id = (int)$_GET['id'];

// Fetch patient info
$stmt = $pdo->prepare("
    SELECT service_users.*, wards.ward_name
    FROM service_users
    LEFT JOIN wards ON service_users.ward_id = wards.id
    WHERE service_users.id = ?
");
$stmt->execute([$service_user_id]);
$patient = $stmt->fetch();

if (!$patient) {
    die("Patient not found.");
}

// Fetch mood history
$moodStmt = $pdo->prepare("
    SELECT mood_table.*, users.name AS staff_name, users.role AS staff_role
    FROM mood_table
    LEFT JOIN users ON mood_table.worker_id = users.id
    WHERE mood_table.service_user_id = ?
    ORDER BY mood_table.entry_date DESC
");
$moodStmt->execute([$service_user_id]);
$moodHistory = $moodStmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Printable Patient Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>
    /* Print style */
    @media print {
        .no-print {
            display: none !important;
        }
        body {
            margin: 20px;
        }
        h2, h4 {
            margin-top: 0;
        }
    }

    body {
        background: white;
    }
</style>
</head>

<body class="container py-4">

<!-- PRINT BUTTON -->
<div class="no-print mb-3">
    <button onclick="window.print()" class="btn btn-primary">Print Page</button>
    <a href="view_service_user.php?id=<?= $service_user_id ?>" class="btn btn-secondary">Back</a>
</div>

<h2>Patient Profile</h2>
<hr>

<h4>Patient Information</h4>

<table class="table table-bordered">
    <tr>
        <th>Name</th>
        <td><?= htmlspecialchars($patient['name']) ?></td>
    </tr>
    <tr>
        <th>Date of Birth</th>
        <td><?= htmlspecialchars($patient['dob']) ?></td>
    </tr>
    <tr>
        <th>Gender</th>
        <td><?= htmlspecialchars($patient['gender']) ?></td>
    </tr>
    <tr>
        <th>Ward</th>
        <td><?= htmlspecialchars($patient['ward_name']) ?></td>
    </tr>
</table>

<hr>

<h4>Mood Entries</h4>

<?php if (count($moodHistory) === 0): ?>
    <p>No mood entries available.</p>
<?php else: ?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Date</th>
            <th>Mood Score</th>
            <th>Note</th>
            <th>Entered By</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($moodHistory as $m): ?>
        <tr>
            <td><?= $m['entry_date'] ?></td>
            <td><?= $m['mood_value'] ?></td>
            <td><?= nl2br(htmlspecialchars($m['note'])) ?></td>
            <td><?= htmlspecialchars($m['staff_name']) ?> (<?= $m['staff_role'] ?>)</td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>

<hr>

<h4>Mood Chart</h4>
<div class="no-print">
    <canvas id="moodChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
    },
});
</script>

</body>
</html>
