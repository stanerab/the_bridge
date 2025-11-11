<?php include("header.php"); ?>
<div class="container py-4">
  <div class="col-md-8 mx-auto">
    <h1 class="display-5 fw-bold mb-4 text-primary">Menu</h1>

    <div class="card shadow-sm border-0">
      <div class="card-body p-4">
        <ul class="list-group list-group-flush">
          <li class="list-group-item border-0 py-3">
            <a href="about.php" class="text-decoration-none fs-5 d-flex align-items-center">
              <i class="bi bi-info-circle me-3"></i> About
            </a>
          </li>
          <li class="list-group-item border-0 py-3">
            <a href="contact.php" class="text-decoration-none fs-5 d-flex align-items-center">
              <i class="bi bi-envelope me-3"></i> Contact Us
            </a>
          </li>
          <li class="list-group-item border-0 py-3">
            <a href="logout.php" class="text-decoration-none fs-5 d-flex align-items-center">
              <i class="bi bi-box-arrow-right me-3"></i> Log Out
            </a>
          </li>
        </ul>

        <button id="fontToggle" class="btn btn-outline-primary w-100 py-2 mt-3">
          <i class="bi bi-fonts me-2"></i> Click To Change Font Size
        </button>

      </div>
    </div>
  </div>
</div>

<script src="./js/font-resizer.js?v=<?php echo time(); ?>"></script>




<?php include("footer.php"); ?>