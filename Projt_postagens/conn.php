<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projetogames_2026";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn){
    die("Falha na conexão: ". mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8mb4");
