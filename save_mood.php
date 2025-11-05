<?php
require_once('header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mood = isset($_POST['mood']) ? trim($_POST['mood']) : '';
    $note = isset($_POST['note']) ? trim($_POST['note']) : '';

    // Insert mood + note + both timestamps
    $sql = mysqli_query($conn, "
        INSERT INTO mood_table (mood, note, created_at, entry_date)
        VALUES ('$mood', '$note', NOW(), NOW())
    ");

    if ($sql) {
        // Mood saved successfully
        // (You can redirect or show a message here if you want)
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>

<div class="container text-center">
    <div class="row text-decoration-none m-0 p-0 mt-0 mb-0">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    <div class="mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="green"
                            class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M6.97 10.97l-2.47-2.47a.75.75 0 1 0-1.06 1.06l3 3a.75.75 0 0 0 1.08-.02l6-7a.75.75 0 0 0-1.08-1.04L6.97 10.97z" />
                        </svg>
                    </div>
                    <h2 class="fw-bold text-success mb-3">Mood Saved Successfully!</h2>
                    <h3 class="text-muted mb-2"><?= htmlspecialchars($mood) ?></h3>
                    <p class="text-muted mb-4 fs-5"><?= htmlspecialchars($note) ?></p>
                    <a href="toolkit.php" class="btn btn-success px-4">Go Back</a>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>

<?php require_once('footer.php'); ?>