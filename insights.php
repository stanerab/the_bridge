<?php 
include("header.php");

$mysqli = new mysqli("localhost", "root", "", "adhdbridge");

// 1. Try to get today's insight
$result = $mysqli->query("
    SELECT *
    FROM insights
    WHERE DATE(created_at) = CURDATE()
    ORDER BY created_at DESC
    LIMIT 1
");
$todayInsight = $result ? $result->fetch_assoc() : null;

// 2. If none exists for today, fallback to the latest insight
if (!$todayInsight) {
    $fallback = $mysqli->query("
        SELECT *
        FROM insights
        ORDER BY created_at DESC
        LIMIT 1
    ");
    $todayInsight = $fallback ? $fallback->fetch_assoc() : null;
}

// 3. Count all insights for stats
$countQuery = $mysqli->query("SELECT COUNT(*) AS total FROM insights");
$countRow = $countQuery ? $countQuery->fetch_assoc() : ['total' => 0];
$totalInsights = $countRow['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Daily Insights | ADHD Bridge</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSS / Fonts / Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #e0e7ff;
            --success: #10b981;
            --warning: #f59e0b;
            --background: #f8fafc;
            --surface: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border: #e2e8f0;
            --transition-slow: 0.4s ease;
            --transition-fast: 0.2s ease;
            --focus-ring: 3px solid rgba(67, 97, 238, 0.3);
        }
        
        /* ADHD-Friendly Base Styles */
        body {
            background: var(--background);
            font-family: 'Inter', 'Segoe UI', sans-serif;
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
            padding-bottom: 50px;
        }
        body.focus-mode {
            --surface: #fefce8;
            --background: #fefce8;
        }
        
        /* Stats Cards */
        .stats-container {
            margin-top: 30px;
            margin-bottom: 40px;
        }
        
        .stat-card {
            background: var(--surface);
            border-radius: 12px;
            padding: 20px;
            border: 1px solid var(--border);
            transition: all var(--transition-fast);
            margin-bottom: 15px;
        }
        
        .stat-card:hover {
            border-color: var(--primary);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.1);
            transform: translateY(-2px);
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin-bottom: 10px;
        }
        
        .stat-number {
            font-size: 1.8rem;
            font-weight: 700;
        }
        
        /* Insight Cards */
        .insights-container {
            margin-bottom: 40px;
        }
        
        .insight-card {
            background: var(--surface);
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 20px;
            border: 1px solid var(--border);
            border-left: 4px solid var(--primary);
            transition: all var(--transition-fast);
        }
        
        .insight-card:focus-within {
            outline: var(--focus-ring);
        }
        
        .insight-card:hover {
            border-color: var(--primary);
            box-shadow: 0 6px 16px rgba(0,0,0,0.08);
            transform: translateY(-2px);
        }
        
        .insight-content {
            font-size: 1rem;
            line-height: 1.7;
            color: var(--text-primary);
            margin-bottom: 16px;
            position: relative;
            padding-left: 24px;
        }
        
        .insight-content::before {
            content: '💡';
            position: absolute;
            left: 0;
            top: 0;
        }
        
        .insight-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 16px;
            border-top: 1px solid var(--border);
        }
        
        .insight-date {
            font-size: 0.85rem;
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .insight-actions {
            display: flex;
            gap: 8px;
        }
        
        /* Action Buttons */
        .action-btn {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--primary-light);
            color: var(--primary);
            border: 1px solid var(--border);
            transition: all var(--transition-fast);
            cursor: pointer;
        }
        
        .action-btn:hover,
        .action-btn:focus {
            background: var(--primary);
            color: white;
            transform: scale(1.05);
            outline: none;
        }
        
        .action-btn.active {
            background: var(--primary);
            color: white;
        }
        
        /* Share Dropdown */
        .share-dropdown-menu {
            min-width: 220px;
            padding: 8px;
            border: 1px solid var(--border);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .share-dropdown-menu .dropdown-item {
            border-radius: 6px;
            padding: 10px 12px;
            margin: 2px 0;
            transition: all var(--transition-fast);
        }
        
        .share-dropdown-menu .dropdown-item:hover {
            background-color: var(--primary-light);
            color: var(--primary);
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            background: var(--surface);
            border-radius: 16px;
            border: 1px solid var(--border);
            margin-top: 40px;
        }
        
        .empty-icon {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.3;
            color: var(--text-secondary);
        }
        
        /* FAB */
        .fab {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 6px 20px rgba(67, 97, 238, 0.3);
            z-index: 1000;
            transition: all var(--transition-fast);
            text-decoration: none;
        }
        
        .fab:hover {
            transform: scale(1.1);
            box-shadow: 0 10px 25px rgba(67, 97, 238, 0.4);
            color: white;
        }
        
        /* Reduced Motion */
        .reduce-motion * {
            transition: none !important;
            animation: none !important;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .insight-card {
                padding: 18px;
            }
            
            .hero-title {
                font-size: 2rem;
            }
            
            .insight-footer {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
            
            .insight-actions {
                align-self: flex-end;
            }
        }
    </style>
</head>

<body>

    <!-- Hero Section -->
    <div class="container mt-4">
        <div class="hero-content text-center mb-5">
            <h1 class="hero-title mb-3" style="font-weight: 700; color: #2d3748;">
                <i class="fas fa-brain text-primary me-2"></i>Daily Insights
            </h1>
            <p class="hero-subtitle" style="color: #718096; max-width: 600px; margin: 0 auto;">
                Track your progress with clear, focused reflections. One insight at a time.
            </p>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="container stats-container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="stat-card text-center">
                    <div class="stat-icon" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white;">
                        <i class="fas fa-brain"></i>
                    </div>
                    <div class="stat-number">
                        <?= $totalInsights ?>
                    </div>
                    <p class="text-muted mb-0">Total Insights</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card text-center">
                    <div class="stat-icon" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white;">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="stat-number">
                        <?= $todayInsight ? 1 : 0 ?>
                    </div>
                    <p class="text-muted mb-0">Today's Insight</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card text-center">
                    <div class="stat-icon" style="background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%); color: white;">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-number">30d</div>
                    <p class="text-muted mb-0">Insight History</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Insights Container -->
    <div class="container insights-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 fw-bold text-dark">Your Daily Reflection</h2>
        </div>
        
       <?php if (!$todayInsight): ?>
    <!-- Empty State -->
    <div class="empty-state">
        <div class="empty-icon">
            <i class="fas fa-lightbulb"></i>
        </div>
        <h3 class="h4 mb-3">No Insights Yet</h3>
        <p class="text-muted mb-4">Start tracking your ADHD patterns to see insights appear here.</p>
        <a href="tracker.php" class="btn btn-primary px-4">
            <i class="fas fa-plus me-2"></i>Start Tracking
        </a>
    </div>
<?php else: ?>
    <div id="insightsList">
        <div class="insight-card" data-date="<?= $todayInsight['created_at']; ?>">
            <div class="insight-content">
                <?= htmlspecialchars($todayInsight['insight']); ?>
            </div>
            <div class="insight-footer">
                <div class="insight-date">
                    <i class="far fa-calendar"></i>
                    <?= date('F j, Y'); ?>   <!-- TODAY'S DATE -->
                    <span class="ms-2">•</span>
                    <i class="far fa-clock ms-2"></i>
                    <?= date('g:i A'); ?>   <!-- CURRENT TIME -->
                </div>

                <div class="insight-actions">
                    <button class="action-btn favorite-btn" data-id="<?= $todayInsight['id']; ?>" title="Save to favorites">
                        <i class="far fa-heart"></i>
                    </button>

                    <div class="dropdown share-dropdown">
                        <button class="action-btn share-btn"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                                title="Share this insight"
                                data-insight="<?= htmlspecialchars($todayInsight['insight']); ?>">
                            <i class="fas fa-share-alt"></i>
                        </button>

                        <ul class="dropdown-menu share-dropdown-menu">
                            <li><a class="dropdown-item share-option" href="#" data-method="clipboard"><i class="fas fa-copy me-2"></i> Copy to Clipboard</a></li>
                            <li><a class="dropdown-item share-option" href="#" data-method="twitter"><i class="fab fa-twitter me-2"></i> Share on Twitter</a></li>
                            <li><a class="dropdown-item share-option" href="#" data-method="facebook"><i class="fab fa-facebook me-2"></i> Share on Facebook</a></li>
                            <li><a class="dropdown-item share-option" href="#" data-method="whatsapp"><i class="fab fa-whatsapp me-2"></i> Share on WhatsApp</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item share-option" href="#" data-method="native"><i class="fas fa-share-square me-2"></i> Share via...</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
<?php endif; ?>

    </div>
    
    <!-- Floating Action Button -->
    <a href="add_insight.php" class="fab" title="Add New Insight">
        <i class="fas fa-plus"></i>
    </a>

    <!-- Share Success Modal -->
    <div class="modal fade" id="shareSuccessModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-4">
                    <div class="mb-3">
                        <i class="fas fa-check-circle text-success" style="font-size: 3rem;"></i>
                    </div>
                    <h5 class="modal-title mb-2">Insight Shared!</h5>
                    <p class="text-muted">Your insight has been copied to clipboard.</p>
                    <button type="button" class="btn btn-primary mt-2" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const body = document.body;
        const motionToggle = document.getElementById('reduceMotionToggle');
        const focusToggle  = document.getElementById('focusModeToggle');
        const textSizeBtn  = document.getElementById('textSizeBtn');

        // Reduce Motion
        const mediaQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
        if (mediaQuery.matches) {
            motionToggle.checked = true;
            body.classList.add('reduce-motion');
        }
        if (localStorage.getItem('reduceMotion') === 'true') {
            motionToggle.checked = true;
            body.classList.add('reduce-motion');
        }
        motionToggle.addEventListener('change', function() {
            body.classList.toggle('reduce-motion', this.checked);
            localStorage.setItem('reduceMotion', this.checked);
        });

        // Focus Mode
        if (localStorage.getItem('focusMode') === 'true') {
            focusToggle.checked = true;
            body.classList.add('focus-mode');
        }
        focusToggle.addEventListener('change', function() {
            body.classList.toggle('focus-mode', this.checked);
            localStorage.setItem('focusMode', this.checked);
        });

        // Text Size
        textSizeBtn.addEventListener('click', function() {
            body.classList.toggle('large-text');
            this.classList.toggle('btn-primary');
        });

        // Favorite Button
        document.querySelectorAll('.favorite-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const icon = this.querySelector('i');
                if (icon.classList.contains('far')) {
                    icon.classList.replace('far', 'fas');
                    this.classList.add('active');
                } else {
                    icon.classList.replace('fas', 'far');
                    this.classList.remove('active');
                }
            });
        });

        // Share functionality
        const shareSuccessModal = new bootstrap.Modal(document.getElementById('shareSuccessModal'));

        document.querySelectorAll('.share-option').forEach(option => {
            option.addEventListener('click', function(e) {
                e.preventDefault();
                const method = this.getAttribute('data-method');
                const shareBtn = this.closest('.share-dropdown').querySelector('.share-btn');
                const insight = shareBtn.getAttribute('data-insight');
                const shareText = `My ADHD Insight: "${insight}" - Tracked via ADHD Bridge`;
                const pageUrl = window.location.href;

                switch (method) {
                    case 'clipboard':
                        copyToClipboard(shareText, shareBtn);
                        break;
                    case 'twitter':
                        window.open(
                            `https://twitter.com/intent/tweet?text=${encodeURIComponent(shareText)}&url=${encodeURIComponent(pageUrl)}`,
                            '_blank','width=550,height=420'
                        );
                        break;
                    case 'facebook':
                        window.open(
                            `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(pageUrl)}`,
                            '_blank','width=550,height=420'
                        );
                        break;
                    case 'whatsapp':
                        window.open(
                            `https://wa.me/?text=${encodeURIComponent(shareText)}`,
                            '_blank'
                        );
                        break;
                    case 'native':
                        if (navigator.share) {
                            navigator.share({
                                title: 'My ADHD Insight',
                                text: shareText,
                                url: pageUrl
                            }).catch(() => copyToClipboard(shareText, shareBtn));
                        } else {
                            copyToClipboard(shareText, shareBtn);
                        }
                        break;
                }

                const dropdown = bootstrap.Dropdown.getInstance(shareBtn);
                if (dropdown) dropdown.hide();
            });
        });

        function copyToClipboard(text, button) {
            navigator.clipboard.writeText(text).then(() => {
                shareSuccessModal.show();
                const originalHTML = button.innerHTML;
                button.innerHTML = '<i class="fas fa-check"></i>';
                button.style.backgroundColor = '#10b981';
                button.style.color = '#fff';
                setTimeout(() => {
                    button.innerHTML = originalHTML;
                    button.style.backgroundColor = '';
                    button.style.color = '';
                }, 2000);
            }).catch(err => {
                console.error('Failed to copy: ', err);
                alert('Failed to copy to clipboard. Please try again.');
            });
        }
    });
    </script>
</body>
</html>

<?php include("footer.php"); ?>
