<?php
include('header.php');
require('connect_php.php');

$sql="SELECT * FROM courses";
$result=mysqli_query($connect,$sql);

// fetching the row results to an array
$courses=mysqli_fetch_all($result,MYSQLI_ASSOC);
// print_r($courses);
?>

<div class="all_cards">
    <?php foreach($courses as $course){ ?>
        <div class="card">
            <div class="card_content">
                <h5> <?php echo htmlspecialchars($course['title']);?> </h5>
                <h5> <?php echo htmlspecialchars($course['description']);?> </h5>
                <h5> <?php echo htmlspecialchars($course['level']);?> </h5>
                <h5> <?php echo htmlspecialchars($course['created_at']);?> </h5>
    
            </div>

            <a class="btn-secondary btn" href="add_section.php?course_id=<?= $course['id'] ?>">Sections</a>
            <a class="btn" href="courses_edit.php?id=<?= $course['id'] ?>">Edit</a>
            <a class="btn-danger btn" onclick="return confirm('Supprimer ce cours ?')" 
               href="courses_delete.php?id=<?= $course['id'] ?>">DELETE</a>

        </div>
    <?php }?>

</div>


<?php include('./footer.php') ?>