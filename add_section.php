<?php include('header.php') ?>

<section>
    <form id="my-form" action="add_course.php" method="POST">
    <h4>ADD Section</h4>
    <label>Title:</label>
    <input type="text" name="title">
    <label>To course:</label>
    <input type="number" name="course_id">
    <label>Content:</label>
    <input type="text" name="content">
    <label>Position:</label>
    <input type="number" name="position">
    <label>Created at:</label>
    <input type="datetime-local" name="created_at">

    <button id="submit" name="submit">Submit</button>
    </form>
</section>

<?php include('./footer.php') ?>