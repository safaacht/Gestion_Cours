<?php
include '../includes/connect_php.php';
include '../includes/header.php';


if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];

$sql="SELECT title,description,level  FROM courses INNER JOIN enrollment ON courses.id=enrollment.id_course WHERE id_user=?";
$stmt=mysqli_prepare($connect,$sql);
mysqli_stmt_bind_param($stmt,"i",$user_id);
mysqli_stmt_execute($stmt);
$result=mysqli_stmt_get_result($stmt);
$courses=mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_stmt_close($stmt);
}
?>

<div class="courses-grid">
    <?php if(empty($courses)): ?>
        <p>You are not enrolled in any courses yet.</p>
    <?php else: ?>
        <?php foreach($courses as $course): ?>
            <div class="course-item">
                <div class="course-banner"></div>
                <div class="course-body">
                    <span class="badge-level">
                        <i class="fas fa-signal"></i> <?= htmlspecialchars($course['level']) ?>
                    </span>
                    <h3 class="course-title"><?= htmlspecialchars($course['title']) ?></h3>
                    <p class="course-desc"><?= htmlspecialchars($course['description']) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>