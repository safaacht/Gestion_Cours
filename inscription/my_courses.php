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

<div class="all_cdcards">
    <?php foreach($courses as $course){ ?>
    <div class="card">
        <p><?= htmlspecialchars($course['title']) ?></p>
        <p><?= htmlspecialchars($course['description']) ?></p>
        <p><?= htmlspecialchars($course['level']) ?></p>
    </div>
    <?php } ?>
</div>