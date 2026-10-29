<?php
include 'config.php';

$logado = @$_SESSION["logado"];

criarTopo('IFES - Perfil');
criarMenu($logado);
echo $rodape;
?>