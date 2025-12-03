<?php include('header.php') ?>


<section>
    <form id="my-form" action="add_course.php" method="POST">
    <h4>ADD COURSE</h4>
    <label>Title:</label>
    <input type="text" name="title">
    <label>Description:</label>
    <input type="text" name="description">
    <label>Level:</label>
    <select name="level">
        <option select disabled>--CHOOSE ONE--</option>
        <option value="Débutant">Débutant</option>
        <option value="Intermédiaire">Intermédiaire</option>
        <option value="Avancé">Avancé</option>
    </select>
    <label>Created at:</label>
    <input type="datetime-local" name="created_at">

    <button id="submit" name="submit">Submit</button>
    </form>
</section>
<?php include('./footer.php') ?>