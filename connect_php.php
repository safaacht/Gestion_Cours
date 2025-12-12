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

// if there is no connection stop the script immediately
if(!$connect){
    die("Database connection: failed" );
}
?>