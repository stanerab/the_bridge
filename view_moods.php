<?php
session_start();
include("db_connect.php");

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM moods WHERE user_id = $user_id ORDER BY mood_date DESC");
?>

<div class="container mt-5">
    <h2>Your Mood History</h2>
    <ul class="list-group">
        <?php while ($row = $result->fetch_assoc()): ?>
            <li class="list-group-item">
                <strong><?= htmlspecialchars($row['mood']) ?></strong>
                <small class="text-muted">(<?= $row['mood_date'] ?>)</small>
                <br>
                <?= nl2br(htmlspecialchars($row['note'])) ?>
            </li>
        <?php endwhile; ?>
    </ul>
</div>