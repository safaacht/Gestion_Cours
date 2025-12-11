<?php
require 'connect_php.php';
include 'header.php';

$id=$_GET['id']; 
// INFO: fonction dans fonction, pas lisible, 
// recuperer le $query est apres $result (m_query), puis mysqli_f_a 
// TODO: et ce traitement doit etre passé dans le else de if($_POST), 
// parceque dans le cas d'un POST ca serai rien de recuprer les données alors tu va faire un traiement pas l'affichage !  
$course=mysqli_fetch_assoc(mysqli_query($connect,"SELECT * FROM courses WHERE id=$id"));
if($_POST){
$title=$_POST['title'];
$desc=$_POST['description']; 
$level=$_POST['level'];
// TODO: la validation ni JS ni PHP !
// INFO: il ya une diff entre mysqli_query et mysqli_prepare (concernant SQL Injection) a revoire
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