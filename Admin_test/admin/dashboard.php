<?php
session_start();
include(__DIR__ . "/../includes/admin_header.php");

// Enhanced security checks
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
   header("Location: /adhd_bridge/login.php");
    exit;
}
require_once __DIR__ . '/../includes/db.php';




// Fetch all dashboard data
try {
    // Staff count - users with role not 'admin'
    $staffCount = $pdo->query("SELECT COUNT(*) FROM users WHERE role != 'admin'")->fetchColumn();
    
    // Service users count
    $patientCount = $pdo->query("SELECT COUNT(*) FROM service_users")->fetchColumn();
    
    // Mood entries count
    $moodCount = $pdo->query("SELECT COUNT(*) FROM mood_table")->fetchColumn();
    
    // Ward count
    $wardCount = $pdo->query("SELECT COUNT(*) FROM wards")->fetchColumn();
    
    // FIXED: Recent mood entries (last 7 days)
    // Uses mood_value + entry_date
    $recentMoods = $pdo->query("
        SELECT mood_value AS mood, COUNT(*) AS count
        FROM mood_table
        WHERE entry_date >= DATE_SUB(NOW(), INTERVAL 7 DAY)
        GROUP BY mood_value
        ORDER BY count DESC
        LIMIT 5
    ")->fetchAll(PDO::FETCH_ASSOC);

    // FIXED: Recent activity
    $recentActivity = $pdo->query("
        (
            SELECT 'staff' AS type, name, created_at AS date
            FROM users
            WHERE role != 'admin'
            ORDER BY created_at DESC
            LIMIT 3
        )
        UNION ALL
        (
            SELECT 'service_user' AS type, name, created_at AS date
            FROM service_users
            ORDER BY created_at DESC
            LIMIT 3
        )
        ORDER BY date DESC
        LIMIT 5
    ")->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    error_log('Dashboard query error: ' . $e->getMessage());
    $error = "Unable to load dashboard data. Please try again later.";
}


// Get admin name for personalization
$adminName = $_SESSION['username'] ?? 'Administrator';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | The Bridge</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
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
        
        .navbar-brand {
            font-weight: 600;
            color: var(--primary-color) !important;
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
        
        .stat-card.staff {
            border-left-color: #3498db;
        }
        
        .stat-card.patients {
            border-left-color: #2ecc71;
        }
        
        .stat-card.moods {
            border-left-color: #9b59b6;
        }
        
        .stat-card.wards {
            border-left-color: #e74c3c;
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
        
        .action-btn {
            padding: 12px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .action-btn:hover {
            transform: translateY(-2px);
        }
        
        .recent-activity {
            max-height: 300px;
            overflow-y: auto;
        }
        
        .activity-item {
            border-left: 3px solid;
            padding-left: 15px;
            margin-bottom: 10px;
        }
        
        .activity-staff {
            border-left-color: #3498db;
        }
        
        .activity-service-user {
            border-left-color: #2ecc71;
        }
        
        .dashboard-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 30px;
        }
        
        .welcome-text {
            font-size: 1.2rem;
            opacity: 0.9;
        }
        
        .quick-actions {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: var(--card-shadow);
        }
        
        .section-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--light-bg);
        }
    </style>
</head>
<body>
   

    <div class="container">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-6 mb-2">Admin Dashboard</h1>
                    <p class="welcome-text">Monitor and manage your care facility efficiently</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <span class="badge bg-light text-dark p-2">
                        <i class="bi bi-calendar-check me-1"></i>
                        <?= date('F j, Y') ?>
                    </span>
                </div>
            </div>
        </div>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($error) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Statistics Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="card stat-card staff h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="stat-label">Staff Members</p>
                                <h2 class="stat-number"><?= htmlspecialchars($staffCount) ?></h2>
                            </div>
                            <div class="stat-icon text-primary">
                                <i class="bi bi-people-fill"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="staff_list.php" class="text-primary text-decoration-none small">
                                View all staff <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card stat-card patients h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="stat-label">Service Users</p>
                                <h2 class="stat-number"><?= htmlspecialchars($patientCount) ?></h2>
                            </div>
                            <div class="stat-icon text-success">
                                <i class="bi bi-person-heart"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="service_users_list.php" class="text-success text-decoration-none small">
                                View all users <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card stat-card moods h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="stat-label">Mood Entries</p>
                                <h2 class="stat-number"><?= htmlspecialchars($moodCount) ?></h2>
                            </div>
                            <div class="stat-icon text-purple">
                                <i class="bi bi-emoji-smile"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <?php if (!empty($recentMoods)): ?>
                                <span class="badge bg-info">
                                    <i class="bi bi-graph-up me-1"></i>
                                    <?= count($recentMoods) ?> recent moods
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card stat-card wards h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p class="stat-label">Wards</p>
                                <h2 class="stat-number"><?= htmlspecialchars($wardCount) ?></h2>
                            </div>
                            <div class="stat-icon text-danger">
                                <i class="bi bi-house-door"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <span class="text-muted small">Active facilities</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Quick Actions -->
            <div class="col-lg-8">
                <div class="quick-actions">
                    <h4 class="section-title">
                        <i class="bi bi-lightning me-2"></i>Quick Actions
                    </h4>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <a href="create_staff.php" class="btn btn-primary action-btn w-100">
                                <i class="bi bi-person-plus me-2"></i>Create Staff
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="staff_list.php" class="btn btn-outline-primary action-btn w-100">
                                <i class="bi bi-people me-2"></i>Manage Staff
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="create_service_user.php" class="btn btn-success action-btn w-100">
                                <i class="bi bi-person-plus me-2"></i>Create Service User
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="service_users_list.php" class="btn btn-outline-success action-btn w-100">
                                <i class="bi bi-list-check me-2"></i>Manage Service Users
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="export_mood_data.php" class="btn btn-warning action-btn w-100">
                                <i class="bi bi-download me-2"></i>Export Mood Data
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="reports.php" class="btn btn-info action-btn w-100">
                                <i class="bi bi-graph-up me-2"></i>View Reports
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Recent Mood Trends -->
                <?php if (!empty($recentMoods)): ?>
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-activity me-2"></i>Recent Mood Trends (Last 7 Days)
                        </h5>
                        <div class="row mt-3">
                            <?php foreach ($recentMoods as $mood): ?>
                                <div class="col-md-4 mb-3">
                                    <div class="d-flex align-items-center p-2 bg-light rounded">
                                        <span class="badge bg-secondary me-2" style="font-size: 1.2rem">
                                            <?= htmlspecialchars($mood['count']) ?>
                                        </span>
                                        <span class="text-muted"><?= htmlspecialchars(ucfirst($mood['mood'])) ?></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Recent Activity -->
            <div class="col-lg-4">
                <?php if (!empty($recentActivity)): ?>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-clock-history me-2"></i>Recent Activity
                        </h5>
                        <div class="recent-activity mt-3">
                            <?php foreach ($recentActivity as $activity): ?>
                                <div class="activity-item <?= $activity['type'] === 'staff' ? 'activity-staff' : 'activity-service-user' ?>">
                                    <small class="text-muted">
                                        <?= date('M j, g:i a', strtotime($activity['date'])) ?>
                                    </small>
                                    <p class="mb-1">
                                        <?php if ($activity['type'] === 'staff'): ?>
                                            <i class="bi bi-person me-1"></i>
                                        <?php else: ?>
                                            <i class="bi bi-person-heart me-1"></i>
                                        <?php endif; ?>
                                        <?= htmlspecialchars($activity['name']) ?>
                                    </p>
                                    <small class="text-muted">
                                        <?= $activity['type'] === 'staff' ? 'Staff member added' : 'Service user added' ?>
                                    </small>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- System Status -->
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="bi bi-shield-check me-2"></i>System Status
                        </h5>
                        <div class="mt-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Database</span>
                                <span class="badge bg-success">Connected</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Last Backup</span>
                                <span class="text-muted"><?= date('M j, Y') ?></span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>System Version</span>
                                <span class="text-muted">v2.1.0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php include("../includes/footer.php"); ?>