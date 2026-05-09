<?php
session_start();

// 1. If already logged in, redirect to dashboard
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: home.php");
    exit();
}

// 2. Login Logic - Must be before HTML
if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $pass  = $_POST['password'];

    // Updated your check to match the hardcoded credentials
    if ($email == "admin@gmail.com" && $pass == "password") {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_email'] = $email;

        header("Location: home.php");
        exit();
    } else {
        // Changed this to 'error' to match your HTML check below
        header("Location: admin_login.php?error=1");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Portal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-soft: #f8fafc;
            --primary-blue: #1e40af;
            --text-main: #334155;
            --border-color: #e2e8f0;
        }

        body {
            background-color: var(--bg-soft);
            font-family: 'Inter', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-main);
            margin: 0;
        }

        .login-card {
            background: #ffffff;
            width: 100%;
            max-width: 420px;
            padding: 2.5rem;
            border-radius: 20px;
            border: 1px solid var(--border-color);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.04),
                0 8px 10px -6px rgba(0, 0, 0, 0.04);
        }

        .brand-icon {
            width: 56px;
            height: 56px;
            background: #eff6ff;
            color: var(--primary-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 1.75rem;
            margin: 0 auto 1.5rem;
        }

        .form-label {
            font-weight: 500;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            color: #475569;
        }

        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            background-color: #fcfcfd;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            background-color: #ffffff;
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 4px rgba(30, 64, 175, 0.08);
            outline: none;
        }

        .btn-login {
            background-color: var(--primary-blue);
            color: white;
            padding: 0.8rem;
            border-radius: 10px;
            font-weight: 600;
            width: 100%;
            border: none;
            margin-top: 1rem;
            transition: transform 0.1s ease, background-color 0.2s ease;
        }

        .btn-login:hover {
            background-color: #1e3a8a;
            transform: translateY(-1px);
        }

        .error-message {
            background-color: #fff1f2;
            color: #be123c;
            border: 1px solid #fecdd3;
            padding: 0.75rem;
            border-radius: 10px;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 1.5rem;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <div class="text-center">
            <div class="brand-icon">
                <i class="bi bi-building-fill"></i>
            </div>
            <h4 class="fw-bold mb-1">Welcome Back</h4>
            <p class="text-muted small mb-4">Please enter your credentials</p>
        </div>

        <!-- Error check matching the logic at top -->
        <?php if (isset($_GET['error'])): ?>
            <div class="error-message">
                <i class="bi bi-exclamation-circle-fill"></i>
                Invalid email or password.
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="admin@college.com" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>

            <!-- THE FIX: added name="login" -->
            <button type="submit" name="login" class="btn-login">
                Sign In
            </button>
        </form>
    </div>

</body>

</html>