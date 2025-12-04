<?php

$db_server="localhost";
$db_user="root";
$db_mdp="";
$db_name="gestion_cours";
$connect="";

$connect=mysqli_connect($db_server,
                        $db_user,
                        $db_mdp,
                        $db_name
);


// making sure if the connection went well
// if($connect){
//     echo "You are connected!";
// }else{
//     echo"Connection failed!";
// }
return $connect;
?>