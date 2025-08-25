<?php
require_once('./includes/header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $mood = isset($_POST['mood']) ? trim($_POST['mood']) : '';
    $note = isset($_POST['note']) ? trim($_POST['note']) : '';

    // Debug: Show posted form data
    print $mood;
    print '<br><br>';
    print $note;

    print '<br><br><Br>';

    $sql = mysqli_query($conn, "INSERT INTO mood_table (mood, note) VALUES('$mood', '$note')");

    if ($sql) {
        echo "Mood saved successfully!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>

<div class="container text-center">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-5">
            <div class="mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="green"
                    class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                    <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M6.97 10.97l-2.47-2.47a.75.75 0 1 0-1.06 1.06l3 3a.75.75 0 0 0 1.08-.02l6-7a.75.75 0 0 0-1.08-1.04L6.97 10.97z" />
                </svg>
            </div>
            <h2 class="fw-bold text-success">Mood Saved Successfully!</h2>
            <p class="text-muted mb-4">Your entry has been recorded. You can go back and add another or view your moods.
            </p>
            <a href="index.php" class="btn btn-success px-4">Go Back</a>
        </div>
    </div>
</div>

<?php require_once('./includes/footer.php'); ?>