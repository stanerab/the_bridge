<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>ADHD Bridge — Register</title>

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&family=Lexend:wght@300;400;600&display=swap"
        rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* =========================
       COLOR PALETTE (CSS VARS)
       ========================= */
        :root {
            --bg-1: #6F42C1;
            --bg-2: #8E44AD;
            --accent: #FFD974;
            --muted: rgba(255, 255, 255, 0.14);
            --card-bg: rgba(255, 255, 255, 0.12);
            --text-on-dark: #ffffff;
            --surface: #ffffff;
            --surface-text: #222222;
            --success: #2bb673;
            --shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
            --radius-lg: 20px;
        }

        /* Dark / Light theme variables */
        .theme-light {
            --page-bg: linear-gradient(-45deg, var(--bg-1), var(--bg-2), #9b59b6, #5a32a3);
            --hero-text: var(--text-on-dark);
            --card-surface: var(--card-bg);
            --section-bg: var(--surface);
            --section-text: var(--surface-text);
            --feature-bg: rgba(255, 255, 255, 0.95);
            --feature-border: rgba(0, 0, 0, 0.1);
        }

        .theme-dark {
            --page-bg: linear-gradient(180deg, #24123b, #2f154b);
            --hero-text: #fff;
            --card-surface: rgba(255, 255, 255, 0.06);
            --section-bg: #120617;
            --section-text: #ddd;
            --feature-bg: rgba(30, 30, 30, 0.95);
            --feature-border: rgba(255, 255, 255, 0.1);
        }

        html,
        body {
            height: 100%;
        }

        body {
            margin: 0;
            font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: var(--page-bg);
            background-size: 400% 400%;
            animation: gradientFlow 14s ease infinite;
            color: var(--hero-text);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
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

        /* NAV */
        .navbar {
            background: transparent;
            padding: .75rem 1rem;
        }

        .brand {
            font-weight: 800;
            letter-spacing: .2px;
        }

        /* REGISTER CONTAINER */
        .register-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .register-glass {
            width: 100%;
            max-width: 480px;
            background: var(--card-surface);
            backdrop-filter: blur(16px) saturate(140%);
            border-radius: var(--radius-lg);
            padding: 2.5rem;
            box-shadow: var(--shadow);
        }

        .register-title {
            font-size: 1.8rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            text-align: center;
        }

        .register-subtitle {
            text-align: center;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        /* FORM STYLES */
        .form-floating {
            margin-bottom: 1.25rem;
        }

        .form-floating>.form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: var(--hero-text);
            border-radius: 12px;
        }

        .form-floating>.form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: var(--accent);
            box-shadow: 0 0 0 0.2rem rgba(255, 217, 116, 0.25);
            color: var(--hero-text);
        }

        .form-floating>label {
            color: rgba(255, 255, 255, 0.7);
            padding: 1rem 0.75rem;
        }

        .form-floating>.form-control:focus~label,
        .form-floating>.form-control:not(:placeholder-shown)~label {
            color: var(--accent);
            transform: scale(0.85) translateY(-0.9rem) translateX(0.15rem);
        }

        /* CHECKBOX */
        .form-check {
            margin-bottom: 1.5rem;
        }

        .form-check-input {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .form-check-input:checked {
            background-color: var(--accent);
            border-color: var(--accent);
        }

        .form-check-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        /* BUTTONS */
        .btn-register {
            background: linear-gradient(90deg, #ffffff, #f3e8ff);
            color: #4b2b93;
            font-weight: 700;
            border: none;
            border-radius: 12px;
            padding: 0.75rem 2rem;
            width: 100%;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .btn-login {
            color: var(--hero-text);
            text-decoration: none;
            text-align: center;
            display: block;
            opacity: 0.9;
            transition: opacity 0.3s ease;
        }

        .btn-login:hover {
            opacity: 1;
            color: var(--accent);
        }

        /* DIVIDER */
        .divider {
            text-align: center;
            margin: 1.5rem 0;
            position: relative;
        }

        .divider::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: rgba(255, 255, 255, 0.2);
        }

        .divider span {
            background: var(--card-surface);
            padding: 0 1rem;
            position: relative;
            z-index: 1;
            font-size: 0.9rem;
            opacity: 0.7;
        }

        /* SOCIAL LOGIN */
        .social-login {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .btn-social {
            flex: 1;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: var(--hero-text);
            border-radius: 12px;
            padding: 0.75rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .btn-social:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-1px);
        }

        /* Accessibility helpers */
        .lexend {
            font-family: 'Lexend', Inter, sans-serif;
        }

        .focus-mode * {
            transition: none !important;
        }

        :focus {
            outline: 3px dashed var(--accent);
            outline-offset: 3px;
            border-radius: 8px;
        }

        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.001ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.001ms !important;
                scroll-behavior: auto !important;
            }
        }

        /* Responsive */
        @media (max-width: 576px) {
            .register-glass {
                padding: 2rem 1.5rem;
            }

            .social-login {
                flex-direction: column;
            }
        }
    </style>
</head>

<body class="theme-light" id="pageBody">

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
                    <a class="btn btn-sm btn-outline-light" href="login.php">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <section class="register-container container my-5">
        <div class="register-glass p-4 border rounded shadow">
            <h1 class="register-title">Create Your Account</h1>
            <p class="register-subtitle">Start your journey to better communication</p>

            <form id="registerForm" method="POST" action="register_process.php">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                        required>
                    <label for="username">Username</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password"
                        required minlength="8">
                    <label for="password">Password</label>
                    <div class="form-text">Must be at least 8 characters</div>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                        placeholder="Confirm Password" required>
                    <label for="confirmPassword">Confirm Password</label>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                    <label class="form-check-label" for="terms">
                        I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                    </label>
                </div>

                <button type="submit" class="btn btn-primary w-100">Create Account</button>
                <p class="mt-3 text-center">Already have an account? <a href="login.php">Sign in</a></p>
            </form>
        </div>
    </section>

    <!-- SCRIPTS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        /* ---------------------------
           DARK/LIGHT THEME TOGGLE
        --------------------------- */
        const body = document.getElementById('pageBody');
        const themeBtn = document.getElementById('themeToggle');
        const storedTheme = localStorage.getItem('bridge-theme') || 'light';

        function applyTheme(t) {
            if (t === 'dark') {
                body.classList.remove('theme-light');
                body.classList.add('theme-dark');
                themeBtn.textContent = 'Light';
                themeBtn.setAttribute('aria-pressed', 'true');
            } else {
                body.classList.remove('theme-dark');
                body.classList.add('theme-light');
                themeBtn.textContent = 'Dark';
                themeBtn.setAttribute('aria-pressed', 'false');
            }
            localStorage.setItem('bridge-theme', t);
        }

        applyTheme(storedTheme);
        themeBtn.addEventListener('click', () => {
            const newTheme = body.classList.contains('theme-dark') ? 'light' : 'dark';
            applyTheme(newTheme);
        });

        /* ---------------------------
           FORM VALIDATION
        --------------------------- */
        const registerForm = document.getElementById('registerForm');
        registerForm.addEventListener('submit', function (e) {
            const password = document.getElementById('password').value.trim();
            const confirmPassword = document.getElementById('confirmPassword').value.trim();
            const terms = document.getElementById('terms').checked;

            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match.');
                return;
            }
            if (!terms) {
                e.preventDefault();
                alert('Please agree to the Terms and Privacy Policy.');
                return;
            }
            // Form submits normally if validation passes
        });
    </script>

</body>

</html>