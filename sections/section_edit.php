<?php 
require 'connect_php.php';
include 'header.php';

$id=$_GET['id']; 
$section=mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM sections WHERE id=$id"));
$cid=$section['course_id'];
if($_POST){
$title=$_POST['title']; 
$content=$_POST['content']; 
$pos=$_POST['position'];
mysqli_query($connect,"UPDATE sections SET title='$title',content='$content',position=$pos WHERE id=$id");
header("Location: sections_by_course.php?course_id=$cid"); exit;
}
?>

<form method='post'>
    <input name='title' value='<?= $section['title'] ?>'><br>
    <input name='position' value='<?= $section['position'] ?>'><br>
    <textarea name='content'><?= $section['content'] ?></textarea><br>
    <button>Update</button>
</form>

<?php include('footer.php'); ?>