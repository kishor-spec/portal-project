<?php
session_start();

// Authentication Guard
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

$admin_email = $_SESSION['admin_email'] ?? 'Admin';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - College Portal</title>

    <!-- UI Dependencies -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-blue: #1e40af;
            --hover-blue: #dbeafe;
            --bg-light: #f8fafc;
            --sidebar-width: 260px;
        }

        body {
            background: var(--bg-light);
            font-family: 'Inter', sans-serif;
            color: #334155;
            min-height: 100vh;
        }

        /* Sidebar Navigation */
        .sidebar {
            background: #ffffff;
            border-right: 1px solid #e2e8f0;
            height: 100vh;
            position: fixed;
            width: var(--sidebar-width);
            z-index: 1000;
            display: flex;
            flex-direction: column;
        }

        .logo-section {
            padding: 2rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-section h4 {
            color: var(--primary-blue);
            font-weight: 700;
            margin: 0;
            font-size: 1.25rem;
        }

        .nav-link {
            color: #64748b;
            padding: 12px 16px;
            margin: 4px 16px;
            border-radius: 8px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.2s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            background: var(--hover-blue);
            color: var(--primary-blue);
        }

        /* Content Layout */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 2rem 3rem;
            width: calc(100% - var(--sidebar-width));
        }

        .top-bar {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 1.25rem 2rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
            margin-bottom: 2.5rem;
        }

        /* Dashboard Components */
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .stat-card {
            color: white;
        }

        .bg-news {
            background: linear-gradient(135deg, #3b82f6, #1e40af);
        }

        .bg-announcement {
            background: linear-gradient(135deg, #10b981, #047857);
        }

        .bg-pending {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }

        .badge-online {
            background: #ecfdf5;
            color: #059669;
            border: 1px solid #10b981;
            font-weight: 600;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo-section">
            <i class="bi bi-building-fill fs-3 text-primary"></i>
            <h4>College<br>Portal</h4>
        </div>


        <?php
        // Get the current filename (e.g., home.php)
        $current_page = basename($_SERVER['PHP_SELF']);
        ?>

        <nav class="nav flex-column flex-grow-1">
            <a href="home.php" class="nav-link <?= ($current_page == 'home.php') ? 'active' : '' ?>">
                <i class="bi bi-grid-1x2-fill"></i> Dashboard
            </a>
            <a href="add_news.php" class="nav-link <?= ($current_page == 'add_news.php') ? 'active' : '' ?>">
                <i class="bi bi-plus-square"></i> Add News
            </a>
            <a href="manage_news.php" class="nav-link <?= ($current_page == 'manage_news.php' || $current_page == 'view_news.php') ? 'active' : '' ?>">
                <i class="bi bi-collection-play"></i> Manage News
            </a>
            <a href="announcements.php" class="nav-link <?= ($current_page == 'announcements.php') ? 'active' : '' ?>">
                <i class="bi bi-megaphone"></i> Announcements
            </a>
        </nav>

        <div class="mt-auto border-top p-3">
            <a href="logout.php" class="nav-link text-danger m-0">
                <i class="bi bi-box-arrow-left"></i> Logout
            </a>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <main class="main-content">
        <header class="top-bar d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold text-dark mb-1">Welcome Back!</h3>
                <p class="text-muted mb-0 small">Administrator: <span class="text-primary fw-medium"><?= htmlspecialchars($admin_email) ?></span></p>
            </div>
            <span class="badge badge-online px-3 py-2 rounded-pill">
                <i class="bi bi-circle-fill me-1" style="font-size: 8px;"></i> Online
            </span>
        </header>