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
<html>
<head>
    <title>Login - ADHD Bridge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="height:100vh;">
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="text-center mb-3">The Bridge Login</h3>

                <?php if ($error): ?>
                <div class="alert alert-danger"><?= $error ?></div>
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

                    <button class="btn btn-primary w-100" type="submit">Login</button>

                </form>

            </div>
        </div>
    </div>
</div>

</body>
</html>
