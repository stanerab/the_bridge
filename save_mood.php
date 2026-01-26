<?php
session_start();
require_once('connection.php');   // mysqli connection
require_once('header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_SESSION['user_id'])) {
        die("Unauthorised access.");
    }

    if (!isset($_POST['service_user_id'])) {
        die("No patient selected.");
    }

    $service_user_id = (int) $_POST['service_user_id'];   // Patient
    $worker_id       = (int) $_SESSION['user_id'];        // Logged-in staff
    $mood            = trim($_POST['mood']);
    $mood_value      = (int) $_POST['mood_value'];
    $note            = trim($_POST['note']);

    // Validate patient exists
    $check = $conn->prepare("SELECT id FROM service_users WHERE id = ?");
    $check->bind_param("i", $service_user_id);
    $check->execute();
    $check->store_result();

    if ($check->num_rows === 0) {
        die("Invalid service user.");
    }

    // Insert with full clinical audit trail
    $stmt = $conn->prepare("
        INSERT INTO mood_table 
        (service_user_id, worker_id, mood, mood_value, note, created_at, entry_date)
        VALUES (?, ?, ?, ?, ?, NOW(), NOW())
    ");

    $stmt->bind_param(
        "iisis",
        $service_user_id,
        $worker_id,
        $mood,
        $mood_value,
        $note
    );

    if (!$stmt->execute()) {
        die("Database error: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
}
?>
<div class="container text-center">
    <div class="row m-0 p-0 mt-0 mb-0">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="green"
                             class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M6.97 10.97l-2.47-2.47a.75.75 0 1 0-1.06 1.06l3 3a.75.75 0 0 0 1.08-.02l6-7a.75.75 0 0 0-1.08-1.04L6.97 10.97z" />
                        </svg>
                    </div>

                    <h2 class="fw-bold text-success mb-3">Mood Saved Successfully</h2>

                    <p class="text-muted mb-2"><strong>Patient ID:</strong> <?= $service_user_id ?></p>
                    <p class="text-muted mb-2"><strong>Entered by:</strong> <?= htmlspecialchars($_SESSION['name']) ?></p>
                    <h4 class="text-primary mb-2"><?= htmlspecialchars($mood) ?></h4>
                    <p class="text-muted fs-5"><?= nl2br(htmlspecialchars($note)) ?></p>

                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <!-- Back to Patient Dashboard -->
                        <a href="home.php?uid=<?= $service_user_id ?>" class="btn btn-primary px-4">
                            View Patient Dashboard
                        </a>

                        <!-- Back to Toolkit (same patient) -->
                        <a href="toolkit.php?uid=<?= $service_user_id ?>" class="btn btn-success px-4">
                            Enter Another Mood
                        </a>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>

<?php require_once('footer.php'); ?>
