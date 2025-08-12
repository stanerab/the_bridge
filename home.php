<?php include("includes/header.php"); ?>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container">
        <div class="row">
            <!-- Main content -->
            <div class="col-lg-9">
                <div class="bg-white p-4 shadow-sm rounded mb-4">
                    <h4>Welcome back, Jordan 👋</h4>
                    <p class="text-muted">Here's your quick communication dashboard — calm, clear prompts and visual
                        aids to help you express what's important.</p>
                </div>

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="bg-white p-3 shadow-sm rounded">
                            <h5>Ready-made Scripts</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>Need a break</strong><br>
                                    <small>"I need a short break to refocus. Can we pause for 10 minutes?"</small>
                                </li>
                                <li class="list-group-item">
                                    <strong>Feeling overwhelmed</strong><br>
                                    <small>"I'm feeling overwhelmed. Can we simplify this to the top 2 tasks?"</small>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-white p-3 shadow-sm rounded">
                            <h5>Visual Aids & Timers</h5>
                            <p class="text-muted">Quick tools to help you focus and communicate visually.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-3 mt-4 shadow-sm rounded">
                    <h5>Recent Conversations</h5>
                    <ul class="list-unstyled mb-0">
                        <li><strong>With Lucy</strong> — Shared how I felt about the project. <small
                                class="text-muted">2d ago</small></li>
                        <li><strong>With Dad</strong> — Asked for more structure at home. <small class="text-muted">5d
                                ago</small></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
<label class="switch">
    <input type="checkbox" id="themeToggle">
    <span class="slider"></span>
</label>

<script>
    const toggle = document.getElementById('themeToggle');
    const body = document.documentElement;

    // Set toggle state on load
    if (localStorage.getItem('theme') === 'dark') {
        body.classList.add('dark-mode');
        toggle.checked = true;
    }

    toggle.addEventListener('change', function () {
        body.classList.toggle('dark-mode');
        if (body.classList.contains('dark-mode')) {
            localStorage.setItem('theme', 'dark');
        } else {
            localStorage.setItem('theme', 'light');
        }
    });
</script>

<?php include("includes/footer.php"); ?>