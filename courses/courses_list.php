<?php
include('../includes/header.php');
include('../includes/connect_php.php');

$sql="SELECT * FROM courses";
$result=mysqli_query($connect,$sql);

// fetching the row results to an array
$courses=mysqli_fetch_all($result,MYSQLI_ASSOC);
// print_r($courses);
?>

<div class="manage-courses-grid">
    <?php foreach($courses as $course){ ?>
        <div class="manage-card">
            <div class="manage-card-info">
                <h5 class="course-title"><?php echo htmlspecialchars($course['title']);?></h5>
                <h5 class="course-meta"><i class="fas fa-layer-group"></i> <?php echo htmlspecialchars($course['level']);?></h5>
                <p style="font-size: 0.9rem; color: #555;"><?php echo htmlspecialchars($course['description']);?></p>
                <p class="course-meta" style="margin-top:10px;">
                    <i class="far fa-calendar-alt"></i> Created: <?php echo date('M d, Y', strtotime($course['created_at']));?>
                </p>
            </div>

            <div class="manage-actions">
                <a class="btn-action btn-sections" href="../sections/sections_list.php?course_id=<?=$course['id'] ?>">
                    <i class="fas fa-list"></i> Sections
                </a>
                <a class="btn-action btn-edit" href="../courses/courses_edit.php?id=<?=$course['id'] ?>">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a class="btn-action btn-enroll" href="../inscription/enrollement.php?course_id=<?=$course['id']?>">
                    <i class="fas fa-plus"></i> Enroll
                </a>
                <a class="btn-action btn-delete" onclick="return confirm('Supprimer ce cours ?')" 
                   href="../courses/courses_delete.php?id=<?=$course['id'] ?>">
                    <i class="fas fa-trash"></i> Delete
                </a>
            </div>
        </div>
    <?php }?>
</div>


<?php include '../includes/footer.php' ?>