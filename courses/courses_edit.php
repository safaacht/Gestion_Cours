<?php
require 'connect_php.php';
include 'header.php';
include 'helper.php';

$id=$_GET['id']; 

if(isset($_POST['submit'])){

$title=$_POST['title'];
$desc=$_POST['description']; 
$level=$_POST['level'];


$errors=[];
    
    if(!input_valid($_POST['title'])){
        $errors['title'] = "Title is required";    
    }else{
        echo htmlspecialchars($_POST['title']);
    }

    if(!input_valid($_POST['description'])){
        $errors['description'] = "Description is required";
    }else{
        echo htmlspecialchars($_POST['description']);
    }
    if(!isset($_POST['level'])){
        echo "Choose a level";
    }elseif(in_array($_POST['level'],["Débutant","Intermédiaire","Avancé"])){
        echo htmlspecialchars($_POST['level']);
    }else{
        echo"Choice inavailable";
    }  


    if(empty($errors)){

    $stmt=mysqli_prepare($connect,"UPDATE courses SET title=?,description=?,level=? WHERE id=?");
    mysqli_stmt_bind_param($stmt, "sssi", $title, $desc, $level, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header('Location: courses_list.php'); exit;
    }  
}else{
    $stmt=mysqli_prepare($connect,"SELECT * FROM courses WHERE id=?");
    mysqli_stmt_bind_param($stmt,"i",$id);
    mysqli_stmt_execute($stmt);

    $rslt=mysqli_stmt_get_result($stmt);
    $course=mysqli_fetch_assoc($rslt);

    mysqli_stmt_close($stmt);

}


?>
<form method='POST'>
<input name='title' value='<?= $course['title'] ?>'><br>
<input name='level' value='<?= $course['level'] ?>'><br>
<textarea name='description'><?= $course['description'] ?></textarea><br>
<button>Update</button>
</form>
<?php include 'footer.php'; ?>