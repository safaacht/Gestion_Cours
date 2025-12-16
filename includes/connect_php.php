<?php

$db_server="localhost";
$db_user="root";
$db_mdp="";
$db_name="gestion_cours";
$db_port=3307;
$connect="";

$connect=mysqli_connect($db_server,
                        $db_user,
                        $db_mdp,
                        $db_name,
                        $db_port
);
// if($connect){
//     echo "AAAAAAAAAAA";
// }
// if there is no connection stop the script immediately
if(!$connect){
    die("Database connection: failed" );
}
?>