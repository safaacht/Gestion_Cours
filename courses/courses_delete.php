<?php
include('../includes/connect_php.php');

if(isset($_GET['id'])){
    $id=$_GET['id'];
    // $id = mysqli_real_escape_string($connect, $id);
    $id = (int)$id;

    $del="DELETE FROM courses WHERE id=$id";

    if(mysqli_query($connect,$del)){
        header("Location:courses_list.php");
        exit();
    }else{
        echo "Erreur lors de la suppression du cours: " . mysqli_error($connect);
    }
}else{
        echo "Error 404: Course not found!";
        exit();
    }
    
?>