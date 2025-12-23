<?php
session_start();
include '../includes/connect_php.php';

$cpt=0;

if(isset($_SESSION)){
    $cpt++;
}
echo $cpt;

echo "///////////// <br>";

$sql="SELECT u.user_name, c.id
FROM users u 
JOIN enrollment en  ON u.id=en.id_user
JOIN courses c ON c.id=en.id_course;
";
$rslt=mysqli_query($connect,$sql);
$rqt=mysqli_fetch_assoc($rslt)
 ?>

 <div>
    <p><?= $rqt ?></p>
 </div>