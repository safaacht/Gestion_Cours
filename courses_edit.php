<?php
require 'connect_php.php';
include 'header.php';

$id=$_GET['id']; 
$course=mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM courses WHERE id=$id"));
if($_POST){
$title=$_POST['title'];
$desc=$_POST['description']; 
$level=$_POST['level'];
mysqli_query($connect,"UPDATE courses SET title='$title',description='$desc',level='$level' WHERE id=$id");
header('Location:courses_list.php'); exit;
}
?>
<form method='POST'>
<input name='title' value='<?= $course['title'] ?>'><br>
<input name='level' value='<?= $course['level'] ?>'><br>
<textarea name='description'><?= $course['description'] ?></textarea><br>
<button>Update</button>
</form>
<?php include 'footer.php'; ?>