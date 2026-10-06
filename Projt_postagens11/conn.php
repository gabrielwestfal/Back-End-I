<?php

$servername = "localhost";
$usarname = "root";
$password = "";
$dbname = "projetogames_2026";

$conn = mysqli_connect($servername, $usarname, $password, $dbname);

if(!$conn){
    die("falha na conexão: ". mysqli_connect_error());
}

?>
