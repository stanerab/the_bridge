<?php
if (session_status() === PHP_SESSION_NONE) {

}

$currentPatientId = $_SESSION['current_patient_id'] ?? null;
?>

<div id="footer-spacer"></div>

<footer id="mainFooter"
        class="fixed-bottom bg-white border-top d-flex justify-content-around py-2 animated-footer">

  <!-- Worker Home -->
  <a href="/the_bridge/Admin_test/worker/dashboard.php" class="text-muted text-center">
    <i class="bi bi-house"></i><br>Home
  </a>

  <!-- Patient Dashboard -->
  <?php if ($currentPatientId): ?>
    <a href="home.php?uid=<?= $currentPatientId ?>" class="text-muted text-center">
        <i class="bi bi-graph-up"></i><br>Dashboard
    </a>
  <?php else: ?>
    <span class="text-muted text-center">
        <i class="bi bi-graph-up"></i><br>Dashboard
    </span>
  <?php endif; ?>

  <!-- Mood Toolkit -->
  <?php if ($currentPatientId): ?>
    <a href="toolkit.php?uid=<?= $currentPatientId ?>" class="text-muted text-center">
        <i class="bi bi-emoji-smile"></i><br>Mood
    </a>
  <?php else: ?>
    <span class="text-muted text-center">
        <i class="bi bi-emoji-smile"></i><br>Mood
    </span>
  <?php endif; ?>

  <!-- Notes / Chat -->
  <?php if ($currentPatientId): ?>
    <a href="chat.php?uid=<?= $currentPatientId ?>" class="text-muted text-center">
        <i class="bi bi-chat-dots"></i><br>Notes
    </a>
  <?php else: ?>
    <span class="text-muted text-center">
        <i class="bi bi-chat-dots"></i><br>Notes
    </span>
  <?php endif; ?>

  <!-- Menu -->
  <a href="menu.php" class="text-muted text-center">
      <i class="bi bi-list"></i><br>Menu
  </a>

  <style>
/* Space so content never hides under fixed footer */
#footer-spacer {
    height: 80px;
}

/* Mobile optimisation */
@media (max-width: 576px) {
    #footer-spacer {
        height: 95px;   /* extra space for touch area */
    }

    #mainFooter a,
    #mainFooter span {
        font-size: 0.75rem;
    }

    #mainFooter i {
        font-size: 1.3rem;
    }
}

/* Tablet */
@media (min-width: 577px) and (max-width: 991px) {
    #footer-spacer {
        height: 85px;
    }
}

/* Desktop */
@media (min-width: 992px) {
    #footer-spacer {
        height: 75px;
    }
}
</style>


</footer>
