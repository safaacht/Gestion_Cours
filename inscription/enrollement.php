<?php
session_start();
include '../includes/connect_php.php';

if(!isset($_SESSION['user_id'])){
    header("location:../Authentification/loging.php");exit;
}
// echo $_GET['course_id'];
if (!isset($_GET['course_id'])) {
    echo "Cours Introuvable!";
    exit();
}
$cid = (int) $_GET['course_id'];

// if user_id and course_id were found
$user_id   = $_SESSION['user_id'];
$course_id = intval($_GET['course_id']);
// checking si l"utilisateur est deja inscrit au cours
$check=mysqli_query($connect,"SELECT * FROM enrollment WHERE id_user=$user_id AND id_course=$cid");

if (mysqli_num_rows($check) > 0) {
    echo "U're already registred in this course";
    // header('location:../inscription/my_courses.php');
    echo "<a href=../inscription/my_courses.php> See my courses </a>";
    exit();
}

$stmt=mysqli_prepare($connect,"INSERT INTO enrollment(id_user,id_course) VALUES(?,?)");
mysqli_stmt_bind_param($stmt,"ii",$user_id,$cid);
$result=mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

if($result){
        header("Location: ../sections/sections_list.php?course_id=$cid");
    exit();
} else {
    echo "Error: ".mysqli_error($connect);
}


?>