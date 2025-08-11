<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php"); // redirect logged-in users
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <h1> WELCOME BACK!</h1>
    <meta charset="UTF-8" />
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }

        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px #ccc;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background: #6f42c1;
            color: white;
            padding: 10px;
            border: none;
            width: 100%;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <h2>Login</h2>

        <?php if (isset($_GET['error'])): ?>
            <p class="error"><?= htmlspecialchars($_GET['error']) ?></p>
        <?php endif; ?>

        <form action="login_process.php" method="POST">
            <label for="username">Username or Email</label>
            <input type="text" id="username" name="username_email" required />

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required />

            <button type="submit">Login</button>
        </form>
    </div>

</body>

</html>