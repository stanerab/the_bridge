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
        /* Animated Gradient Background */
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(-45deg, #6f42c1, #8e44ad, #9b59b6, #5a32a3);
            background-size: 400% 400%;
            animation: gradientFlow 15s ease infinite;
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

        /* Login Card */
        .login-card {
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .login-card h2 {
            font-weight: 700;
            margin-bottom: 10px;
        }

        .login-card p {
            color: #6c757d;
            margin-bottom: 25px;
        }

        .form-control:focus {
            border-color: #6f42c1;
            box-shadow: 0 0 5px rgba(111, 66, 193, 0.3);
        }

        .btn-login {
            background: #6f42c1;
            transition: background 0.3s;
        }

        .btn-login:hover {
            background: #5a32a3;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="text-center mb-4">
            <img src="images/ADHD_bridge_logo2.svg" alt="ADHD Bridge Logo" style="width: 80px;">
            <h2>Welcome Back!</h2>
            <p>Sign in to your account</p>
        </div>

        <?php if (isset($_GET['error'])): ?>
            <div class="error text-center"><?= htmlspecialchars($_GET['error']) ?></div>
        <?php endif; ?>

        <form action="login_process.php" method="POST">
            <!-- Username / Email -->
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-person-fill"></i></span>
                    <input type="text" name="username_email" class="form-control" placeholder="Username or Email"
                        required>
                </div>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-lock-fill"></i></span>
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
            Don't have an account? <a href="register.php" class="text-decoration-none">Sign Up</a>
        </p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>