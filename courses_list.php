<?php include('header.php') ?>


<?php
$conn=require('connect_php.php');

$sql="SELECT * FROM courses";
$result=mysqli_query($conn,$sql);

// fetching the row results to an array
$courses=mysqli_fetch_all($result,MYSQLI_ASSOC);
// print_r($courses);

?>

<?php include('courses_delete') ?>

<div class="all_cards">
    <?php foreach($courses as $course){ ?>
        <div class="card">
            <div class="card_content">
                <h5> <?php echo htmlspecialchars($course['title']);?> </h5>
                <h5> <?php echo htmlspecialchars($course['description']);?> </h5>
                <h5> <?php echo htmlspecialchars($course['level']);?> </h5>
                <h5> <?php echo htmlspecialchars($course['created_at']);?> </h5>
    
            </div>
            <button class="delete">Delete</button>
        </div>
    <?php }?>

</div>


<?php include('./footer.php') ?>