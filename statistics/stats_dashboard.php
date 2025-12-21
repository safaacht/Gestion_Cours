<?php
include '../includes/connect_php.php';
include '../includes/header.php';

// total cours
$sql=mysqli_query($connect,"SELECT COUNT(id) AS COURSES_TOTAL FROM courses ");
$courses=mysqli_fetch_assoc($sql);

// total users
$rqt=mysqli_query($connect,"SELECT COUNT(id) AS USERS_TOTAL FROM users ");
$users=mysqli_fetch_assoc($rqt);

// Total des Inscriptions par cours
$requete=mysqli_query($connect,"SELECT COUNT(*) AS insciption_course FROM enrollment");
$total_inscription=mysqli_fetch_all($requete,MYSQLI_ASSOC);

// Cours le Plus Populaire
$populaire=mysqli_query($connect,"SELECT c.title, COUNT(e.id_user) AS inscription_course
FROM enrollment e
JOIN courses c ON e.id_course = c.id
GROUP BY e.id_course
ORDER BY inscription_course DESC
LIMIT 1");
$famouse_course=mysqli_fetch_assoc($populaire);

// Nombre Moyen de Sections par Cours
$moyenne=mysqli_query($connect,"SELECT AVG (courses_id) AS Moyenne FROM sections");
$averge=mysqli_fetch_assoc($moyenne);

// Tableau de Cours Ayant Plus de 5 Sections
$sections=mysqli_query($connect,"SELECT c.title, COUNT(s.id)
from sections s
JOIN courses c on s.courses_id= c.id
GROUP BY c.title
having COUNT(s.id)>5;");
$cours=mysqli_fetch_all($sections,MYSQLI_ASSOC);

// Tableau de Utilisateurs Inscrits cette Année
$inscription=mysqli_query($connect,"SELECT u.id,u.user_name,c.created_at 
FROM enrollment e 
JOIN users u ON e.id_user = u.id 
JOIN courses c ON e.id_course = c.id 
WHERE YEAR(c.created_at) = YEAR(CURDATE())");
$user=mysqli_fetch_assoc($inscription);

// Tableau de Cours Sans Inscription
$request=mysqli_query($connect,'SELECT c.id, c.title
FROM courses c
LEFT JOIN enrollment e ON e.id_course = c.id
WHERE e.id_course IS NULL;
 ');
$sans_inscription=mysqli_fetch_assoc($request);

// Tableau de Dernières Inscriptions
$sql1=mysqli_query($connect,"SELECT u.id AS user_id, u.user_name as name, u.email, c.title AS course_title, c.created_at AS inscription_date 
FROM enrollment e 
JOIN users u ON e.id_user = u.id 
JOIN courses c ON e.id_course = c.id
ORDER BY c.created_at DESC
LIMIT 1");
$last_inscription=mysqli_fetch_assoc($sql1);
?>
<div class="dashboard-container">
    <h2 style="margin-bottom: 20px; color: #1b0b43;">Platform Overview</h2>
    
    <div class="all_cards">
        <div class="card">
            <h1><i class="fas fa-book-open"></i> Total courses</h1>
            <p><?= $courses["COURSES_TOTAL"] ?></p>
        </div>

        <div class="card">
            <h1><i class="fas fa-users"></i> Total users</h1>
            <p><?= $users["USERS_TOTAL"] ?></p>
        </div>

        <div class="card">
            <h1><i class="fas fa-file-signature"></i> Total Inscriptions</h1>
            <p><?= count($total_inscription) ?></p>
            <span class="label-detail">Across all platform</span>
        </div>

        <div class="card">
            <h1><i class="fas fa-star"></i> Most Popular</h1>
            <p><?= htmlspecialchars($famouse_course["title"]) ?></p>
            <span class="label-detail"><?= $famouse_course['inscription_course'] ?> Active Students</span>
        </div>

        <div class="card">
            <h1><i class="fas fa-layer-group"></i> Avg Sections/Course</h1>
            <p><?= number_format($averge["Moyenne"], 1) ?></p>
        </div>

        <div class="card">
            <h1><i class="fas fa-list-ol"></i> Large Courses (>5 Sec)</h1>
            <div style="font-size: 0.85rem; color: #555; max-height: 80px; overflow-y: auto;">
                <?php if(empty($cours)): ?>
                    <p>No large courses found</p>
                <?php else: ?>
                    <ul style="list-style: none; padding: 0;">
                        <?php foreach($cours as $item): ?>
                            <li>• <?= htmlspecialchars($item['title']) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>

        <div class="card">
            <h1><i class="fas fa-user-plus"></i> Joined This Year</h1>
            <div style="font-size: 0.85rem; color: #555; max-height: 80px; overflow-y: auto;">
                <?php 
                // Re-running the query to fetch ALL users for this display
                $all_users_rqt = mysqli_query($connect, "SELECT u.user_name FROM enrollment e JOIN users u ON e.id_user = u.id JOIN courses c ON e.id_course = c.id WHERE YEAR(c.created_at) = YEAR(CURDATE())");
                $all_users = mysqli_fetch_all($all_users_rqt, MYSQLI_ASSOC);
                
                if(empty($all_users)): ?>
                    <p>None yet</p>
                <?php else: 
                    $names = array_column($all_users, 'user_name');
                    echo implode(', ', array_map('htmlspecialchars', $names)); 
                endif; ?>
            </div>
        </div>

        <div class="card">
            <h1><i class="fas fa-exclamation-circle"></i> Empty Course</h1>
            <p style="color: #e74c3c;"><?= htmlspecialchars($sans_inscription["title"] ?? 'None') ?></p>
            <span class="label-detail" style="color: #e74c3c;">Needs attention</span>
        </div>

        <div class="card">
            <h1><i class="fas fa-clock"></i> Last Activity</h1>
            <p><?= htmlspecialchars($last_inscription["name"]) ?></p>
            <span class="label-detail">In: <?= htmlspecialchars($last_inscription["course_title"]) ?></span>
        </div>
    </div>
</div>