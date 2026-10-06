<?php

require('config.php');
require('conn.php');
require ('config.usuario.php');

$id = $_GET['id'];
$usuario = buscarUsuario($id,$conn);
if($usuario != ""){
    echo "Achei usuario ". $usuario['id'] . "com email ". $usuario['email'];
}

?>