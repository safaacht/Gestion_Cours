<?php
include('connect_php.php');

if(isset($_GET['delete'])){
    $id=$_GET['delete'];

    $del="DELETE FROM courses WHERE id=$id";
    mysqli_query($connect,$del);
}
?>
