<?php
include 'config.php';

$logado = @$_SESSION["logado"];
$email = @$_SESSION["email"];

criarTopo('IFES - Perfil');
criarMenu($logado);

echo '<main><h1>Perfil do Usuário</h1>';
echo '<p>Email: ' . $email . '</p></main>';

$btnEditar = ' <button> <a href="editar-perfil.php">Editar Perfil</a></button>';
echo $btnEditar;
echo $rodape;
?>