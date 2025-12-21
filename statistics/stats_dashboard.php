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
$requete=mysqli_query($connect,"SELECT COUNT(*) AS insciption_course FROM enrollment GROUP BY id_course ");
$total_inscription=mysqli_fetch_assoc($requete);

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
$cours=mysqli_fetch_assoc($sections);

// Tableau de Utilisateurs Inscrits cette Année
$inscription=mysqli_query($connect,"SELECT u.id,u.user_name,c.created_at 
FROM enrollment e 
JOIN users u ON e.id_user = u.id 
JOIN courses c ON e.id_course = c.id 
WHERE YEAR(e.created_at) = YEAR(CURDATE())");
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
ORDER BY e.created_at DESC
LIMIT 1");
$last_inscription=mysqli_fetch_assoc($sql1);
?>
<div class="all_cards">
    <!-- total cours -->
        <div class="card">
            <h1>Total courses:</h1>
           <p><?=$courses["COURSES_TOTAL"]?></p> 
        </div>
    <!-- total users -->
        <div class="card">
            <h1>Total users:</h1>
           <p><?=$users["USERS_TOTAL"]?></p> 
        </div>
    <!-- Total des Inscriptions par cours     -->
     <div class="card">
            <h1>Total Inscriptions By Course:</h1>
           <p><?=$total_inscription["insciption_course"]?></p> 
        </div>
        <!-- Cours le Plus Populaire -->
         <div class="card">
            <h1>Famouse Course:</h1>
           <p><?=$famouse_course["title"]?>:  <?=$famouse_course['inscription_course']?> Users</p> 
        </div>
        <!-- Nombre Moyen de Sections par Cours -->
         <div class="card">
            <h1>Average sections by course:</h1>
           <p><?=$averge["Moyenne"]?></p> 
        </div>
        <!-- Tableau de Cours Ayant Plus de 5 Sections -->
         <div class="card">
            <h1>Sections>5 by course:</h1>
           <p><?=$cours["title"]?></p> 
        </div>
        <!-- Tableau de Utilisateurs Inscrits cette Année -->
         <div class="card">
            <h1>User inscription this year:</h1>
           <p><?=$user["user_name"]?></p> 
        </div>
        <!-- Tableau de Cours Sans Inscription -->
         <div class="card">
            <h1>Courses with no inscriptions:</h1>
           <p><?=$sans_inscription["title"]?></p> 
        </div>
        <!-- Tableau de Dernières Inscriptions-->
          <div class="card"> 
            <h1>last inscription:</h1>
           <p><?=$last_inscription["name"]?></p> 
        </div>
</div>