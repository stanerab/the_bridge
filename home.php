<?php include("includes/header.php"); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADHD Bridge - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <nav class="navbar navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="images/toolkit-logo.png" alt="Toolkit Logo" width="40" class="me-2">
                <span class="fw-bold">ADHD Bridge</span>
            </a>
            <span class="text-muted">Communication Toolkit</span>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="list-group shadow-sm">
                    <a href="#" class="list-group-item list-group-item-action active">Home</a>
                    <a href="#" class="list-group-item list-group-item-action">Conversations</a>
                    <a href="#" class="list-group-item list-group-item-action">Prompts & Scripts</a>
                    <a href="#" class="list-group-item list-group-item-action">Tools</a>
                </div>
                <div class="mt-4 p-3 bg-white shadow-sm rounded">
                    <h6>Quick Actions</h6>
                    <button class="btn btn-outline-primary btn-sm w-100 mb-2">Start Script</button>
                    <button class="btn btn-outline-success btn-sm w-100 mb-2">Mood Check</button>
                    <button class="btn btn-outline-warning btn-sm w-100 mb-2">Share</button>
                    <button class="btn btn-outline-danger btn-sm w-100">Emergency</button>
                </div>
            </div>

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
<?php include("includes/footer.php"); ?>