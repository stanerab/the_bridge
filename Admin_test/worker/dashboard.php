<?php
session_start();
include(__DIR__ . "/../includes/worker_header.php");

$allowed_roles = ['support_worker','nurse','clinician','ward_manager'];

if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], $allowed_roles)) {
    header("Location: /the_bridge/login.php");
    exit;
}
require_once __DIR__ . '/../db.connect.php';



// Get staff ward
$ward_id = $_SESSION['ward_id'];
$staffName = $_SESSION['name'] ?? $_SESSION['username'];
$staffRole = $_SESSION['role'];

// Get all service users in this ward
$stmt = $pdo->prepare("
    SELECT service_users.id,
           service_users.name,
           service_users.dob,
           service_users.gender,
           service_users.ward_id,
           wards.ward_name
    FROM service_users
    LEFT JOIN wards ON service_users.ward_id = wards.id
    WHERE service_users.ward_id = ?
    ORDER BY service_users.name ASC
");
$stmt->execute([$ward_id]);
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get ward name
$wardName = $patients[0]['ward_name'] ?? 'Unknown';

// Count total patients
$patientCount = count($patients);

// Get recent mood entries for this ward (last 24 hours)
$recentMoodsStmt = $pdo->prepare("
    SELECT COUNT(*) as recent_count 
    FROM mood_table mt
    JOIN service_users su ON mt.service_user_id = su.id
    WHERE su.ward_id = ? 
    AND mt.created_at >= DATE_SUB(NOW(), INTERVAL 1 DAY)
");
$recentMoodsStmt->execute([$ward_id]);
$recentMoods = $recentMoodsStmt->fetch(PDO::FETCH_ASSOC);
$recentMoodCount = $recentMoods['recent_count'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard | The Bridge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #2ecc71;
            --light-bg: #f8f9fa;
            --card-shadow: 0 4px 6px rgba(0,0,0,0.1);
            --hover-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }
        
        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar-custom {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .welcome-section {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--card-shadow);
        }
        
        .stat-card {
            border: none;
            border-radius: 10px;
            transition: transform 0.3s, box-shadow 0.3s;
            border-left: 4px solid;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-shadow);
        }
        
        .stat-card.patients {
            border-left-color: #3498db;
        }
        
        .stat-card.recent {
            border-left-color: #2ecc71;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .stat-icon {
            font-size: 2rem;
            opacity: 0.8;
        }
        
        .patient-table {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
        }
        
        .patient-table thead {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }
        
        .patient-table th {
            border: none;
            font-weight: 500;
            padding: 1rem;
        }
        
        .patient-table td {
            padding: 1rem;
            vertical-align: middle;
        }
        
        .patient-table tbody tr {
            transition: background-color 0.2s;
        }
        
        .patient-table tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.05);
        }
        
        .action-btn {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .role-badge {
            background: linear-gradient(135deg, #6f42c1, #8b5cf6);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        .ward-badge {
            background: linear-gradient(135deg, #e74c3c, #ff6b6b);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        .empty-state {
            padding: 3rem;
            text-align: center;
            color: #6c757d;
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }
        
        .quick-actions {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: var(--card-shadow);
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Welcome Section -->
        <div class="welcome-section">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-6 fw-bold mb-2">
                        Welcome back, <?= htmlspecialchars($staffName) ?> 👋
                    </h1>
                  <p class="lead mb-0">
    You are assigned to <strong><?= htmlspecialchars($wardName) ?></strong> 
</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <span class="ward-badge">
                        <i class="bi bi-house-door me-1"></i>
                        <?= htmlspecialchars($wardName) ?> Ward
                    </span>
                </div>
            </div>
        </div>

        <!-- Quick Statistics -->
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="card stat-card patients h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="stat-label">Service Users</p>
                                <h2 class="stat-number"><?= htmlspecialchars($patientCount) ?></h2>
                                <p class="text-muted mb-0">In your ward</p>
                            </div>
                            <div class="stat-icon text-primary">
                                <i class="bi bi-people-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card stat-card recent h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="stat-label">Recent Mood Entries</p>
                                <h2 class="stat-number"><?= htmlspecialchars($recentMoodCount) ?></h2>
                                <p class="text-muted mb-0">Last 24 hours</p>
                            </div>
                            <div class="stat-icon text-success">
                                <i class="bi bi-emoji-smile"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php if (false): ?>
<!-- Quick Actions -->
<div class="quick-actions">
    <h5 class="mb-3">
        <i class="bi bi-lightning me-2"></i>Quick Actions
    </h5>

    <div class="row g-3">

        <!-- Add Mood Entry -->
        <div class="col-md-3">
            <a href="/adhd_bridge/toolkit.php"
               class="btn btn-primary action-btn w-100">
                <i class="bi bi-plus-circle me-2"></i>
                Add Mood Entry
            </a>
        </div>

        <!-- View Reports -->
        <div class="col-md-3">
            <a href="/adhd_bridge/home.php"
               class="btn btn-primary action-btn w-100">
                <i class="bi bi-plus-circle me-2"></i>
                View Reports
            </a>
        </div>

        <!-- View Notes -->
          <div class="col-md-3">
            <a href="/adhd_bridge/chat.php"
               class="btn btn-primary action-btn w-100">
                <i class="bi bi-plus-circle me-2"></i>
                View Notes
            </a>
        </div>

        <!-- My Profile -->
        <div class="col-md-3">
            <a href="profile.php" class="btn btn-secondary action-btn w-100">
                <i class="bi bi-person-circle me-2"></i>
                My Profile
            </a>
        </div>

    </div> 
</div>
<?php endif; ?>

        <!-- Service Users Table -->
        <div class="card border-0 shadow">
            <div class="card-body p-0">
                <div class="d-flex justify-content-between align-items-center p-4 border-bottom">
                    <h5 class="mb-0">
                        <i class="bi bi-people me-2"></i>Service Users in Your Ward
                    </h5>
                    <span class="badge bg-primary">
                        <?= htmlspecialchars($patientCount) ?> Active service users<?= $patientCount != 1 ? 's' : '' ?>
                    </span>
                </div>
                
                <?php if (empty($patients)): ?>
                    <div class="empty-state">
                        <i class="bi bi-people text-muted"></i>
                        <h5>No Service Users Found</h5>
                        <p>No service users are currently assigned to your ward.</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table patient-table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Date of Birth</th>
                                    <th>Gender</th>
                                    <th>Ward</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($patients as $patient): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                                <i class="bi bi-person text-primary"></i>
                                            </div>
                                            <div>
                                                <strong><?= htmlspecialchars($patient['name']) ?></strong>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?php
                                        $dob = new DateTime($patient['dob']);
                                        $today = new DateTime();
                                        $age = $today->diff($dob)->y;
                                        ?>
                                        <?= htmlspecialchars($patient['dob']) ?>
                                        <small class="text-muted d-block">(<?= $age ?> years)</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-info bg-opacity-10 text-info">
                                            <?= htmlspecialchars($patient['gender']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                            <?= htmlspecialchars($patient['ward_name']) ?>
                                        </span>
                                    </td>
                                 <td class="text-end">
    <div class="d-flex justify-content-end gap-2">

        <!-- Go to Patient Mood Dashboard -->
        <a href="/the_bridge/home.php?uid=<?= $patient['id'] ?>" 
           class="btn btn-primary btn-sm action-btn">
            <i class="bi bi-speedometer2 me-1"></i>Dashboard
        </a>

        <!-- Open Toolkit for this Patient -->
        <a href="/the_bridge/toolkit.php?uid=<?= $patient['id'] ?>" 
           class="btn btn-success btn-sm action-btn">
            <i class="bi bi-emoji-smile me-1"></i>Enter Mood
        </a>

        <!-- Notes (future expansion) -->
        <a href="/the_bridge/chat.php?uid=<?= $patient['id'] ?>" 
           class="btn btn-outline-secondary btn-sm action-btn">
            <i class="bi bi-journal-text me-1"></i>Notes
        </a>

    </div>
</td>

                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            // Add row hover effect
            const rows = document.querySelectorAll('.patient-table tbody tr');
            rows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.cursor = 'pointer';
                });
            });
            
            // Auto-refresh dashboard every 10 minutes
            setTimeout(() => {
                window.location.reload();
            }, 600000);
        });
    </script>
</body>
</html>
<?php include("../includes/footer.php"); ?>