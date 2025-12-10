<?php
require 'connect_php.php';

$id=$_GET['id']; 
$cid=$_GET['course_id'];

mysqli_query($connect,"DELETE FROM sections WHERE id=$id");

header("Location: sections_by_course.php?course_id=$cid"); 
?>