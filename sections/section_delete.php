<?php
include 'connect_php.php';

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $cid=$_GET['course_id'];

if(mysqli_query($connect,"DELETE FROM sections WHERE id=$id")){
    header("Location: sections_list.php?course_id=$cid"); 
    exit();
}else{
    echo "Erreur lors de la suppression du section: " . mysqli_error($connect);
}
}else{
    echo "Error 404: Section not found!";
    exit();
}
?>