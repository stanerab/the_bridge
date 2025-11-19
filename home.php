<?php include("header.php"); ?>

<!-- Bootstrap + Font Awesome + Chart.js -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    body {
        background-color: #f8f9fa;
        overflow-x: hidden;
    }

    /* Purple Welcome Section */
    .welcome-section {
        background: linear-gradient(135deg, #6f42c1 0%, #8b5cf6 100%);
        color: white;
        border-radius: 16px;
        padding: 2.5rem 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(111, 66, 193, 0.15);
    }

    /* Fixed Today's Focus badge - visible in light mode */
    .focus-badge {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        font-weight: 500;
    }

    /* Professional Chart Styling */
    .chart-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        border: none;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .chart-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .chart-container {
        min-height: 320px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }

    .chart-container canvas {
        width: 100% !important;
        max-width: 100%;
        height: 280px !important;
    }

    /* Professional Tabs with Purple Theme */
    .nav-tabs-custom {
        border-bottom: 2px solid rgba(0, 0, 0, 0.05);
        margin-bottom: 1.5rem;
    }

    .nav-tabs-custom .nav-link {
        border: none;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        color: #6c757d;
        border-radius: 8px 8px 0 0;
        margin-right: 0.5rem;
        transition: all 0.3s ease;
    }

    .nav-tabs-custom .nav-link.active {
        background: #6f42c1;
        color: white;
        box-shadow: 0 -2px 10px rgba(111, 66, 193, 0.2);
    }

    .nav-tabs-custom .nav-link:hover:not(.active) {
        background: rgba(111, 66, 193, 0.05);
        color: #6f42c1;
    }

    /* Purple accent for icons */
    .text-primary {
        color: #6f42c1 !important;
    }

    /* Original styles preserved */
    .bg-white {
        background-color: white !important;
    }

    .shadow-sm {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
    }

    .rounded {
        border-radius: 0.375rem !important;
    }

    .list-group-item {
        border: 1px solid rgba(0, 0, 0, 0.125);
    }

    /* Dark mode support */
    @media (prefers-color-scheme: dark) {
        .chart-card {
            background: #1e1e1e;
        }

        .nav-tabs-custom {
            border-bottom: 2px solid rgba(255, 255, 255, 0.05);
        }

        .focus-badge {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    }
</style>

<body class="bg-light">
    <div class="container mt-3">

        <!-- Purple Welcome Section -->
        <div class="welcome-section">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-6 fw-bold mb-2">Welcome back, Jordan 👋</h1>
                    <p class="lead mb-0 opacity-90">Track your moods, gain insights, and communicate with clarity.</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="d-inline-block focus-badge px-3 py-2 rounded-pill">
                        <small class="fw-medium">Today's Focus: Emotional Awareness</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- LEFT COLUMN - Original Content -->
            <div class="col-lg-4">
                <div class="bg-white p-3 shadow-sm rounded mb-3">
                    <h5><i class="fa-solid fa-comment-dots text-primary"></i> Ready-made Scripts</h5>
                    <ul class="list-group list-group-flush small">
                        <li class="list-group-item"><strong>Need a break</strong><br><small>"I need a short break to
                                refocus. Can we pause for 10 minutes?"</small></li>
                        <li class="list-group-item"><strong>Feeling overwhelmed</strong><br><small>"I'm feeling
                                overwhelmed. Can we simplify this to the top 2 tasks?"</small></li>
                    </ul>
                </div>
                <div class="bg-white p-3 shadow-sm rounded mb-3">
                    <h5><i class="fa-solid fa-clock text-success"></i> Visual Aids & Timers</h5>
                    <p class="text-muted small">Use visual countdowns and structured timers to stay focused.</p>
                </div>
                <div class="bg-white p-3 shadow-sm rounded">
                    <h5><i class="fa-solid fa-user-group text-info"></i> Recent Conversations</h5>
                    <ul class="list-unstyled mb-0 small">
                        <li><strong>With Lucy</strong> — Shared how I felt about the project. <small
                                class="text-muted">2d ago</small></li>
                        <li><strong>With Dad</strong> — Asked for more structure at home. <small class="text-muted">5d
                                ago</small></li>
                    </ul>
                </div>
            </div>

            <!-- RIGHT COLUMN - Professional Charts -->
            <div class="col-lg-8">
                <?php
                include_once('connection.php');
                $mysqli = $conn;

                if ($mysqli->connect_error) {
                    die("Connection failed: " . $mysqli->connect_error);
                }

                // Mood Colors
                $moodColors = [
                    'Angry' => '#dc3545',
                    'Sad' => '#0d6efd',
                    'Neutral' => '#6c757d',
                    'Okay' => '#0dcaf0',
                    'Happy' => '#198754'
                ];

                // Average Mood (last 7 days)
                $avgMoodQuery = $mysqli->query("
                    SELECT entry_date, AVG(
                        CASE mood
                            WHEN 'Angry' THEN 1
                            WHEN 'Sad' THEN 2
                            WHEN 'Neutral' THEN 3
                            WHEN 'Okay' THEN 4
                            WHEN 'Happy' THEN 5
                        END
                    ) AS avg_mood
                    FROM mood_table
                    WHERE entry_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
                    GROUP BY entry_date
                    ORDER BY entry_date
                ");

                $avgMoodLabels = $avgMoodData = [];
                while ($r = $avgMoodQuery->fetch_assoc()) {
                    $avgMoodLabels[] = date('M j', strtotime($r['entry_date']));
                    $avgMoodData[] = round($r['avg_mood'], 2);
                }

                // Mood Distribution (Donut Chart, last 7 days)
                $moodDistQuery = $mysqli->query("
                    SELECT mood, COUNT(*) AS count
                    FROM mood_table
                    WHERE entry_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
                    GROUP BY mood
                ");

                $moodDistLabels = $moodDistData = $moodDistColors = [];
                while ($r = $moodDistQuery->fetch_assoc()) {
                    $moodDistLabels[] = $r['mood'];
                    $moodDistData[] = $r['count'];
                    $moodDistColors[] = $moodColors[$r['mood']];
                }

                // Average Mood by Weekday
                $weekDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

                $dayPatternQuery = $mysqli->query("
                    SELECT DAYNAME(entry_date) AS day, AVG(
                        CASE mood
                            WHEN 'Angry' THEN 1
                            WHEN 'Sad' THEN 2
                            WHEN 'Neutral' THEN 3
                            WHEN 'Okay' THEN 4
                            WHEN 'Happy' THEN 5
                        END
                    ) AS avg_mood
                    FROM mood_table
                    GROUP BY DAYNAME(entry_date)
                ");

                $dbDayData = [];
                while ($r = $dayPatternQuery->fetch_assoc()) {
                    $dbDayData[$r['day']] = round($r['avg_mood'], 2);
                }

                $dayLabels = $dayData = $dayColors = [];
                foreach ($weekDays as $day) {
                    $dayLabels[] = substr($day, 0, 3);
                    $dayData[] = isset($dbDayData[$day]) ? $dbDayData[$day] : null;

                    $freqQuery = $mysqli->query("
                        SELECT mood, COUNT(*) AS count
                        FROM mood_table
                        WHERE DAYNAME(entry_date) = '$day'
                        GROUP BY mood
                        ORDER BY count DESC
                        LIMIT 1
                    ");
                    $freq = $freqQuery->fetch_assoc();
                    $dayColors[] = $freq ? $moodColors[$freq['mood']] : '#6f42c1';
                }
                ?>

                <!-- Professional Chart Tabs -->
                <ul class="nav nav-tabs-custom" id="chartTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="avgMood-tab" data-bs-toggle="tab" data-bs-target="#avgMood"
                            type="button" role="tab">
                            <i class="fa-solid fa-line-chart"></i> Average Mood
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="distMood-tab" data-bs-toggle="tab" data-bs-target="#distMood"
                            type="button" role="tab">
                            <i class="fa-solid fa-pie-chart"></i> Mood Distribution
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="byDay-tab" data-bs-toggle="tab" data-bs-target="#byDay"
                            type="button" role="tab">
                            <i class="fa-solid fa-bar-chart"></i> By Day
                        </button>
                    </li>
                </ul>

                <div class="tab-content">
                    <!-- Average Mood Tab -->
                    <div class="tab-pane fade show active" id="avgMood" role="tabpanel">
                        <div class="chart-card">
                            <h6 class="text-muted mb-3"><i class="fa-solid fa-line-chart text-success"></i> Average Mood
                                (Last 7 Days)</h6>
                            <div class="chart-container">
                                <canvas id="avgMoodChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Mood Distribution Tab -->
                    <div class="tab-pane fade" id="distMood" role="tabpanel">
                        <div class="chart-card">
                            <h6 class="text-muted mb-3"><i class="fa-solid fa-pie-chart text-primary"></i> Mood
                                Distribution</h6>
                            <div class="chart-container">
                                <canvas id="moodDistChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- By Day Tab -->
                    <div class="tab-pane fade" id="byDay" role="tabpanel">
                        <div class="chart-card">
                            <h6 class="text-muted mb-3"><i class="fa-solid fa-bar-chart text-warning"></i> Average Mood
                                by Day</h6>
                            <div class="chart-container">
                                <canvas id="dayPatternChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Line Chart - Average Mood Trends
        new Chart(document.getElementById('avgMoodChart'), {
            type: 'line',
            data: {
                labels: <?php echo json_encode($avgMoodLabels); ?>,
                datasets: [{
                    label: 'Average Mood',
                    data: <?php echo json_encode($avgMoodData); ?>,
                    borderColor: '#198754',
                    backgroundColor: 'rgba(25,135,84,0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#198754',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        min: 1,
                        max: 5,
                        ticks: {
                            callback: function (value) {
                                const moods = ['', 'Angry', 'Sad', 'Neutral', 'Okay', 'Happy'];
                                return moods[value] || value;
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                const moods = ['', 'Angry', 'Sad', 'Neutral', 'Okay', 'Happy'];
                                return `Mood: ${moods[Math.round(context.raw)]} (${context.raw})`;
                            }
                        }
                    }
                }
            }
        });

        // Donut Chart - Mood Distribution
        new Chart(document.getElementById('moodDistChart'), {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($moodDistLabels); ?>,
                datasets: [{
                    data: <?php echo json_encode($moodDistData); ?>,
                    backgroundColor: <?php echo json_encode($moodDistColors); ?>,
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true
                        }
                    }
                }
            }
        });

        // Bar Chart - Weekly Patterns
        new Chart(document.getElementById('dayPatternChart'), {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($dayLabels); ?>,
                datasets: [{
                    label: 'Average Mood',
                    data: <?php echo json_encode($dayData); ?>,
                    backgroundColor: <?php echo json_encode($dayColors); ?>,
                    borderWidth: 0,
                    borderRadius: 8,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        min: 1,
                        max: 5,
                        ticks: {
                            callback: function (value) {
                                const moods = ['', 'Angry', 'Sad', 'Neutral', 'Okay', 'Happy'];
                                return moods[value] || value;
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>

    <?php include("footer.php"); ?>