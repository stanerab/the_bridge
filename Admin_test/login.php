<?php
session_start();
require_once __DIR__ . '/includes/db.php';

// If user is already logged in, redirect based on role
if (isset($_SESSION['role'])) {

    if ($_SESSION['role'] === 'admin') {
        header("Location: admin/dashboard.php");
        exit;
    }

    $staff_roles = ['support_worker', 'nurse', 'clinician', 'ward_manager'];
    if (in_array($_SESSION['role'], $staff_roles)) {
        header("Location: worker/dashboard.php");
        exit;
    }
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Fetch the user by username OR email
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {

        // Assign session variables
        $_SESSION['user_id']  = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['name']     = $user['name'] ?: $user['username']; // fallback
        $_SESSION['role']     = $user['role'];
        $_SESSION['ward_id']  = $user['ward_id'];

        // Redirect based on role
        if ($user['role'] === 'admin') {
            header("Location: admin/dashboard.php");
            exit;
        }

        if (in_array($user['role'], ['support_worker','nurse','clinician','ward_manager'])) {
            header("Location: worker/dashboard.php");
            exit;
        }

        // Unknown role
        $error = "Your account role is not recognised.";

    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - The Bridge</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            background: linear-gradient(135deg, #6f42c1, #0dcaf0);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-card {
            border: none;
            border-radius: 20px;
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.96);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            animation: floatUp 0.8s ease;
        }

        @keyframes floatUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .brand-title {
            font-weight: 700;
            color: #6f42c1;
        }

        .form-control {
            border-radius: 12px;
        }

        .btn-login {
            background: #6f42c1;
            border: none;
            border-radius: 12px;
            transition: 0.3s ease;
        }
/* Demo credentials box */
.demo-box {
    border: 1px dashed var(--input-border);
    border-radius: 10px;
    padding: 14px;
    background: rgba(111, 66, 193, 0.05);
}

.theme-dark .demo-box {
    background: rgba(255, 217, 116, 0.06);
    border-color: rgba(255, 217, 116, 0.3);
}

.demo-header {
    font-size: 0.85rem;
    font-weight: 600;
    color: #6f42c1;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.theme-dark .demo-header {
    color: var(--accent);
}

.demo-creds {
    font-size: 0.85rem;
    color: var(--card-text);
    opacity: 0.85;
    font-family: 'SFMono-Regular', Consolas, monospace;
    line-height: 1.6;
}
        .btn-login:hover {
            background: #5a32a3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .subtitle {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .logo-wrapper {
            animation: subtlePulse 3s infinite ease-in-out;
        }

        @keyframes subtlePulse {
            0%,100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
    </style>
</head>

<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">

            <div class="card login-card p-4">

                <!-- Logo + Brand -->
                <div class="text-center mb-4 logo-wrapper">

                    <!-- Your SVG Logo -->
                    <svg viewBox="0 0 100 100" width="70" height="70" role="img" aria-hidden="true">
                        <defs>
                            <linearGradient id="g1" x1="0" x2="1">
                                <stop offset="0" stop-color="#FFD974" />
                                <stop offset="1" stop-color="#FFB4A2" />
                            </linearGradient>
                        </defs>
                        <circle cx="50" cy="50" r="50" fill="url(#g1)" />
                        <path d="M36 60c8-18 28-18 34-6"
                              stroke="#6F42C1"
                              stroke-width="6"
                              stroke-linecap="round"
                              fill="none" />
                    </svg>

                    <h3 class="brand-title mt-3">The Bridge</h3>
                    <div class="subtitle">Clinical Mood & Communication System</div>
                </div>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <form method="POST">

                    <div class="mb-3">
                        <label class="form-label">Username or Email</label>
                        <input class="form-control" type="text" name="username" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input class="form-control" type="password" name="password" required>
                    </div>

                    <button class="btn btn-login w-100 text-white" type="submit">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Secure Login
                    </button>

                </form>
<!-- Demo Credentials -->
<div class="demo-box mt-3">
    <div class="demo-header">
        <i class="bi bi-stars"></i> Use the below demo details to login
    </div>
    <div class="demo-creds">
        <div><strong>Email:</strong> admin@example.com</div>
        <div><strong>Password:</strong> changeThis123</div>
    </div>
</div>
                <div class="text-center mt-3">
                    <small class="text-muted">
                        Secure clinical access • Encrypted session
                    </small>
                </div>

            </div>

        </div>
    </div>
</div>

</body>
</html>
