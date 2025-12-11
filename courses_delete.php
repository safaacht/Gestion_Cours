<?php
require('connect_php.php');

if(isset($_GET['id'])){
    $id=$_GET['id'];
    // INFO: cette fonction est bien pour le SQL Injection : mysqli_real_escape_string
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
    // alors la c'est un 404 "Not Found" message error a afficher, pas redirect!
        // get is done without id
        header("Location:courses_list.php");
        exit();
    }
    
?>