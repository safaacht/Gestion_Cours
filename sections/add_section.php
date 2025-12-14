<?php 
include('header.php');
require 'connect_php.php';

$cid=$_GET['course_id'];
if($_POST){
$title=$_POST['title'];
$content=$_POST['content']; 
$position=$_POST['position'];


mysqli_query($connect,"INSERT INTO sections(course_id,title,content,position,created_at) VALUES($cid,'$title','$content',$pos,NOW())");

header("Location: sections_list.php?course_id=$cid"); 
exit;
}
?>


<section>
    <form id="my-form" action="add_course.php" method="POST">
    <h4>ADD Section</h4>
    <label>Title:</label>
    <input type="text" name="title">
    <label>Content:</label>
    <input type="text" name="content">
    <label>Position:</label>
    <input type="number" name="position">

    <button id="submit" name="submit">Submit</button>
    </form>
</section>

<?php include('./footer.php') ?>