<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: choose_role.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ADHD Bridge</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        /* =========================
           COLOR PALETTE (CSS VARS)
           ========================= */
        :root {
            --bg-1: #6F42C1;
            --bg-2: #8E44AD;
            --accent: #FFD974;
            --text-on-dark: #ffffff;
            --surface: #ffffff;
            --surface-text: #222222;
        }

        /* Dark / Light theme variables */
        .theme-light {
            --page-bg: linear-gradient(-45deg, var(--bg-1), var(--bg-2), #9b59b6, #5a32a3);
            --hero-text: var(--text-on-dark);
            --card-bg: #ffffff;
            --card-text: #222222;
            --input-bg: #ffffff;
            --input-text: #222222;
            --input-border: #dee2e6;
        }

        .theme-dark {
            --page-bg: linear-gradient(180deg, #24123b, #2f154b);
            --hero-text: #fff;
            --card-bg: #1a1a1a;
            --card-text: #ffffff;
            --input-bg: #2d2d2d;
            --input-text: #ffffff;
            --input-border: #444444;
        }

        /* NAV */
        .navbar {
            background: transparent;
            padding: .75rem 1rem;
        }

        .brand {
            font-weight: 800;
            letter-spacing: .2px;
            color: var(--hero-text);
        }

        /* Animated Gradient Background */
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: var(--page-bg);
            background-size: 400% 400%;
            animation: gradientFlow 15s ease infinite;
            margin: 0;
            padding: 0;
            color: var(--hero-text);
            transition: background .35s ease, color .2s ease;
        }

        @keyframes gradientFlow {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* Login Container */
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        /* Login Card */
        .login-card {
            background: var(--card-bg);
            color: var(--card-text);
            border-radius: 12px;
            padding: 30px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            transition: background .35s ease, color .2s ease;
        }

        .login-card h2 {
            font-weight: 700;
            margin-bottom: 10px;
            color: var(--card-text);
        }

        .login-card p {
            color: var(--card-text);
            opacity: 0.8;
            margin-bottom: 25px;
        }

        .form-control {
            background: var(--input-bg);
            color: var(--input-text);
            border: 1px solid var(--input-border);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: var(--input-bg);
            color: var(--input-text);
            border-color: #6f42c1;
            box-shadow: 0 0 5px rgba(111, 66, 193, 0.3);
        }

        .input-group-text {
            background: var(--input-bg);
            color: var(--input-text);
            border: 1px solid var(--input-border);
            border-right: none;
        }

        .form-control::placeholder {
            color: var(--input-text);
            opacity: 0.7;
        }

        .btn-login {
            background: #6f42c1;
            color: white;
            border: none;
            transition: background 0.3s;
        }

        .btn-login:hover {
            background: #5a32a3;
            color: white;
        }

        .btn-light {
            background: rgba(255, 255, 255, 0.9);
            color: #222;
            border: none;
        }

        .btn-outline-light {
            background: transparent;
            color: var(--hero-text);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .btn-outline-light:hover {
            background: rgba(255, 255, 255, 0.1);
            color: var(--hero-text);
        }

        .error {
            color: #ff6b6b;
            margin-bottom: 15px;
        }

        .text-decoration-none {
            color: #6f42c1;
        }

        .theme-dark .text-decoration-none {
            color: var(--accent);
        }

        .form-check-label {
            color: var(--card-text);
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 20px;
            }
        }
    </style>
</head>

<body class="theme-light">
    <!-- NAV -->
    <nav class="navbar">
        <div class="container">
            <div class="d-flex align-items-center w-100 justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <div style="width:44px; height:44px; display:grid; place-items:center;">
                        <svg viewBox="0 0 100 100" width="36" height="36" role="img" aria-hidden="true">
                            <defs>
                                <linearGradient id="g1" x1="0" x2="1">
                                    <stop offset="0" stop-color="#FFD974" />
                                    <stop offset="1" stop-color="#FFB4A2" />
                                </linearGradient>
                            </defs>
                            <circle cx="50" cy="50" r="44" fill="url(#g1)" />
                            <path d="M36 60c8-18 28-18 34-6" stroke="#6F42C1" stroke-width="6" stroke-linecap="round"
                                fill="none" />
                        </svg>
                    </div>
                    <div class="brand">ADHD Bridge</div>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-sm btn-light" id="themeToggle" aria-pressed="false"
                        title="Toggle theme">Dark</button>
                    <a class="btn btn-sm btn-outline-light" href="register.php">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- LOGIN FORM -->
    <div class="login-container">
        <div class="login-card">
            <div class="text-center mb-4">
                <h2>Welcome back!</h2>
                <p>Access your ADHD Bridge account</p>
            </div>

            <?php if (isset($_GET['error'])): ?>
                <div class="error text-center"><?= htmlspecialchars($_GET['error']) ?></div>
            <?php endif; ?>

            <form action="login_process.php" method="POST">
                <!-- Username / Email -->
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        <input type="text" name="username_email" class="form-control" placeholder="Username or Email"
                            required>
                    </div>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="d-flex justify-content-between mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>
                    <a href="forgot_password.php" class="text-decoration-none">Forgot Password?</a>
                </div>

                <button type="submit" class="btn btn-login w-100">Login</button>
            </form>

            <p class="text-center mt-3">
                Don't have an account? <a href="register.php" class="text-decoration-none">Register</a>
            </p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Theme Toggle Functionality
        const body = document.body;
        const themeBtn = document.getElementById('themeToggle');

        // Get stored theme or default to light
        const storedTheme = localStorage.getItem('bridge-theme') || 'light';

        function applyTheme(t) {
            if (t === 'dark') {
                body.classList.remove('theme-light');
                body.classList.add('theme-dark');
                themeBtn.textContent = 'Light';
                themeBtn.setAttribute('aria-pressed', 'true');
                themeBtn.classList.remove('btn-light');
                themeBtn.classList.add('btn-warning');
            } else {
                body.classList.remove('theme-dark');
                body.classList.add('theme-light');
                themeBtn.textContent = 'Dark';
                themeBtn.setAttribute('aria-pressed', 'false');
                themeBtn.classList.remove('btn-warning');
                themeBtn.classList.add('btn-light');
            }
            localStorage.setItem('bridge-theme', t);
        }

        // Apply stored theme on page load
        applyTheme(storedTheme);

        // Toggle theme on button click
        themeBtn.addEventListener('click', () => {
            const newTheme = body.classList.contains('theme-dark') ? 'light' : 'dark';
            applyTheme(newTheme);
        });
    </script>
</body>

</html>