<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}
?>
<?php include("header.php"); ?>

<style>
  .text-purple {
    color: #6f42c1 !important;
  }

  .btn-purple {
    background-color: #6f42c1;
    border-color: #6f42c1;
    color: white;
  }

  .btn-purple:hover {
    background-color: #5a32a8;
    border-color: #5a32a8;
    color: white;
  }

  .btn-outline-purple {
    border-color: #6f42c1;
    color: #6f42c1;
  }

  .btn-outline-purple:hover {
    background-color: #6f42c1;
    border-color: #6f42c1;
    color: white;
  }

  .feature-highlights {
    display: flex;
    justify-content: center;
    gap: 2rem;
    margin-top: 3rem;
    padding-top: 2rem;
    border-top: 1px solid #dee2e6;
  }

  .feature-item {
    text-align: center;
  }

  .feature-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: rgba(111, 66, 193, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 0.5rem;
    font-size: 1.25rem;
    color: #6f42c1;
  }

  .feature-text {
    font-size: 0.9rem;
    color: #6f42c1;
    font-weight: 500;
  }

  @media (max-width: 768px) {
    .feature-highlights {
      flex-direction: column;
      gap: 1rem;
    }
  }
</style>

<section class="text-center py-5 bg-light min-vh-100 d-flex flex-column justify-content-center">
  <div class="container">
    <h1 class="display-5 fw-bold mb-3">Welcome to <span class="text-purple">ADHD Bridge</span></h1>
    <p class="lead text-muted mb-4">Please choose how you'd like to continue:</p>

    <div class="d-grid gap-4 col-10 col-md-6 mx-auto">
      <a href="home.php" class="btn btn-purple btn-lg rounded-pill shadow-sm">
        👤 I am an adult with ADHD
      </a>
      <a href="home.php" class="btn btn-outline-purple btn-lg rounded-pill shadow-sm">
        👪 I am a Family Member
      </a>
    </div>

    <!-- Feature Highlights -->
    <div class="feature-highlights">
      <div class="feature-item">
        <div class="feature-icon">
          <i class="bi bi-heart-pulse"></i>
        </div>
        <div class="feature-text">Emotional Support</div>
      </div>

      <div class="feature-item">
        <div class="feature-icon">
          <i class="bi bi-chat-dots"></i>
        </div>
        <div class="feature-text">Better Communication</div>
      </div>

      <div class="feature-item">
        <div class="feature-icon">
          <i class="bi bi-graph-up"></i>
        </div>
        <div class="feature-text">Progress Tracking</div>
      </div>
    </div>
  </div>
</section>

