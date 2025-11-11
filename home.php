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

    .chart-card {
        min-height: 340px;
        max-height: 420px;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        padding: 10px;
    }

    .chart-card canvas {
        width: 100% !important;
        max-width: 580px;
        height: 260px !important;
        display: block;
        margin: 0 auto;
    }

    #distMood .chart-card {
        min-height: 360px;
        max-height: 400px;
        justify-content: center;
    }

    #distMood canvas {
        width: 90% !important;
        max-width: 340px !important;
        max-height: 340px !important;
        height: auto !important;
        aspect-ratio: 1/1;
        display: block;
        margin: 0 auto;
    }
</style>

<body class="bg-light">
    <div class="container mt-3">

        <!-- Header -->
        <div class="bg-white p-4 shadow-sm rounded mb-4 text-center">
            <h4>Welcome back, Jordan 👋</h4>
            <p class="text-muted">Track your moods, gain insights, and communicate with clarity.</p>
        </div>

        <div class="row g-4">
            <!-- LEFT COLUMN -->
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

            <!-- RIGHT COLUMN -->
            <div class="col-lg-8">
                <?php
                include_once('connection.php'); // $conn comes from connection.php
                $mysqli = $conn; // Optional: keep using $mysqli for existing queries
                
                if ($mysqli->connect_error) {
                    die("Connection failed: " . $mysqli->connect_error);
                }

                // -------------------------------
                // 1️⃣ Mood Colors
                // -------------------------------
                $moodColors = [
                    'Angry' => '#dc3545',
                    'Sad' => '#0d6efd',
                    'Neutral' => '#6c757d',
                    'Okay' => '#0dcaf0',
                    'Happy' => '#198754'
                ];

                // -------------------------------
                // 2️⃣ Average Mood (last 7 days)
                // -------------------------------
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
                    $avgMoodLabels[] = $r['entry_date'];
                    $avgMoodData[] = round($r['avg_mood'], 2);
                }

                // -------------------------------
                // 3️⃣ Mood Distribution (Donut Chart, last 7 days)
                // -------------------------------
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

                // -------------------------------
                // 4️⃣ Average Mood by Weekday (Mon → Sun)
                // -------------------------------
                $weekDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

                // Average mood per weekday
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
                    $dayLabels[] = $day;
                    $dayData[] = isset($dbDayData[$day]) ? $dbDayData[$day] : null;

                    // Most frequent mood per day
                    $freqQuery = $mysqli->query("
            SELECT mood, COUNT(*) AS count
            FROM mood_table
            WHERE DAYNAME(entry_date) = '$day'
            GROUP BY mood
            ORDER BY count DESC
            LIMIT 1
        ");
                    $freq = $freqQuery->fetch_assoc();
                    $dayColors[] = $freq ? $moodColors[$freq['mood']] : '#0d6efd';
                }
                ?>


                <!-- Tabs -->
                <ul class="nav nav-tabs" id="chartTabs" role="tablist">
                    <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab"
                            data-bs-target="#avgMood">📈 Average Mood</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#distMood">🎨
                            Mood Distribution</button></li>
                    <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#byDay">📅 By
                            Day</button></li>
                </ul>

                <div class="tab-content mt-3">
                    <div class="tab-pane fade show active" id="avgMood">
                        <div class="card chart-card shadow-sm p-3">
                            <h6 class="text-muted"><i class="fa-solid fa-line-chart text-success"></i> Average Mood
                                (Last 7 Days)</h6>
                            <canvas id="avgMoodChart"></canvas>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="distMood">
                        <div class="card chart-card shadow-sm p-3">
                            <h6 class="text-muted"><i class="fa-solid fa-pie-chart text-primary"></i> Mood
                                Distribution
                            </h6>
                            <canvas id="moodDistChart"></canvas>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="byDay">
                        <div class="card chart-card shadow-sm p-3">
                            <h6 class="text-muted"><i class="fa-solid fa-bar-chart text-warning"></i> Average Mood
                                by
                                Day</h6>
                            <canvas id="dayPatternChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Line Chart
        new Chart(document.getElementById('avgMoodChart'), {
            type: 'line',
            data: {
                labels: <?php echo json_encode($avgMoodLabels); ?>,
                datasets: [{
                    label: 'Average Mood',
                    data: <?php echo json_encode($avgMoodData); ?>,
                    borderColor: '#198754',
                    backgroundColor: 'rgba(25,135,84,0.2)',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, scales: { y: { min: 1, max: 5 } } }
        });

        // Donut Chart
        new Chart(document.getElementById('moodDistChart'), {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($moodDistLabels); ?>,
                datasets: [{
                    data: <?php echo json_encode($moodDistData); ?>,
                    backgroundColor: <?php echo json_encode($moodDistColors); ?>
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });

        // Bar Chart
        new Chart(document.getElementById('dayPatternChart'), {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($dayLabels); ?>,
                datasets: [{
                    label: 'Average Mood',
                    data: <?php echo json_encode($dayData); ?>,
                    backgroundColor: <?php echo json_encode($dayColors); ?>
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, scales: { y: { min: 1, max: 5 } } }
        });
    </script>

    <?php include("footer.php"); ?>