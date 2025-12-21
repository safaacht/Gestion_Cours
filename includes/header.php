<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini LMS - Gestion des Cours</title>
    <link rel="stylesheet" href="../assets/style.css">
    <!-- <script src="script.js" defer></script> -->
</head>
<body>
<header class="main-header">
    <a href="../courses/courses_list.php" class="nav-brand">LMS</a>

    <nav>
        <ul class="nav-menu">
            <li><a href="../courses/courses_list.php" class="nav-link">Cours</a></li>
            <li><a href="../courses/add_course.php" class="nav-link">Ajouter</a></li>
            <li><a href="../inscription/my_courses.php" class="nav-link">Mes Cours</a></li>
            <li><a href="../statistics/stats_dashboard.php" class="nav-link">Dashboard</a></li>
        </ul>
    </nav>

    <div class="nav-user-section">
        <?php if(isset($_SESSION['user_id'])): ?>
            <span class="user-email">
                <i class="fas fa-user-circle"></i> <?=$_SESSION['email']?>
            </span>
            <form action="../Authentification/logout.php" style="margin:0;">
                <button name="logout" type="submit" class="btn-logout">Log out</button>
            </form>
        <?php else: ?>
            <a href="../Authentification/register.php" class="nav-link">Sign up</a>
            <a href="../Authentification/login.php" class="nav-link" style="font-weight:bold;">Log in</a>
        <?php endif; ?>
    </div>
    
</header>