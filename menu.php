<?php
session_start();
include("header.php");

// Store selected patient globally
if (isset($_GET['uid']) && is_numeric($_GET['uid'])) {
    $_SESSION['current_patient_id'] = (int) $_GET['uid'];
}

// Get active patient
$service_user_id = $_SESSION['current_patient_id'] ?? null;

if (!$service_user_id) {
    echo "<div class='alert alert-danger'>No patient selected. Please return to dashboard.</div>";
    exit;
}
?>

<style>
  .menu-container {
    max-width: 800px;
    margin: 0 auto;
  }

  .menu-header {
    border-bottom: 3px solid #0d6efd;
    padding-bottom: 1rem;
    margin-bottom: 2rem;
  }

  .menu-card {
    border-radius: 12px;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
    border: none;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .menu-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
  }

  .menu-item {
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
  }

  .menu-item:last-child {
    border-bottom: none;
  }

  .menu-item:hover {
    background-color: rgba(13, 110, 253, 0.03);
    padding-left: 2rem;
  }

  .menu-link {
    color: #212529;
    font-weight: 500;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    width: 100%;
    text-decoration: none;
    transition: color 0.2s ease;
  }

  .menu-link:hover {
    color: #0d6efd;
  }

  .menu-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    background: rgba(13, 110, 253, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    color: #0d6efd;
    font-size: 1.2rem;
    transition: all 0.2s ease;
  }

  .menu-item:hover .menu-icon {
    background: rgba(13, 110, 253, 0.15);
    transform: scale(1.05);
  }

  .logout-item .menu-link {
    color: #dc3545;
  }

  .logout-item .menu-icon {
    background: rgba(220, 53, 69, 0.1);
    color: #dc3545;
  }

  .logout-item:hover .menu-link {
    color: #c82333;
  }

  .logout-item:hover .menu-icon {
    background: rgba(220, 53, 69, 0.15);
  }

  .accessibility-toggle {
    border-radius: 8px;
    border: 1px solid #dee2e6;
    padding: 0.75rem 1.25rem;
    font-weight: 500;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 1.5rem;
  }

  .accessibility-toggle:hover {
    background-color: #f8f9fa;
    border-color: #0d6efd;
  }

  .accessibility-icon {
    margin-right: 0.75rem;
    font-size: 1.1rem;
  }

  /* Dark mode support */
  @media (prefers-color-scheme: dark) {
    .menu-card {
      background-color: #1e1e1e;
      box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
    }

    .menu-link {
      color: #e9ecef;
    }

    .menu-item {
      border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .menu-item:hover {
      background-color: rgba(13, 110, 253, 0.08);
    }

    .accessibility-toggle {
      background-color: #2d2d2d;
      border-color: #444;
      color: #e9ecef;
    }

    .accessibility-toggle:hover {
      background-color: #363636;
      border-color: #0d6efd;
    }
  }

  /* Responsive adjustments */
  @media (max-width: 768px) {
    .menu-item {
      padding: 1rem 1.25rem;
    }

    .menu-item:hover {
      padding-left: 1.5rem;
    }

    .menu-icon {
      width: 36px;
      height: 36px;
      margin-right: 0.75rem;
    }
  }
</style>

<div class="container py-5">
  <div class="menu-container">
    <!-- Header Section -->
    <div class="menu-header text-center">
      <h1 class="display-5 fw-bold text-dark mb-2">Menu</h1>
      <p class="text-muted">Navigate through the application</p>
    </div>

    <!-- Menu Card -->
    <div class="menu-card">
      <div class="card-body p-0">
        <!-- About Link -->
        <div class="menu-item">
          <a href="about.php" class="menu-link">
            <div class="menu-icon">
              <i class="bi bi-info-circle"></i>
            </div>
            <span>About The Bridge</span>
          </a>
        </div>

        <!-- Contact Link -->
        <div class="menu-item">
          <a href="contact.php" class="menu-link">
            <div class="menu-icon">
              <i class="bi bi-envelope"></i>
            </div>
            <span>Contact Us</span>
          </a>
        </div>

        <!-- Divider -->
        <div class="border-top my-2"></div>

        <!-- Logout Link -->
        <div class="menu-item logout-item">
          <a href="logout.php" class="menu-link">
            <div class="menu-icon">
              <i class="bi bi-box-arrow-right"></i>
            </div>
            <span>Log Out</span>
          </a>
        </div>
      </div>
    </div>

    <!-- Accessibility Toggle -->
    <button id="fontToggle" class="btn accessibility-toggle w-100">
      <i class="bi bi-fonts accessibility-icon"></i>
      <span>Change Font Size</span>
    </button>
  </div>
</div>

<script src="./js/font-resizer.js?v=<?php echo time(); ?>"></script>

<?php include("footer.php"); ?>