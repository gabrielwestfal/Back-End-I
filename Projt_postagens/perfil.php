<?php
include 'config.php';

$logado = @$_SESSION["logado"];

echo $logado;

criarTopo($logado);
criarMenu($logado);
echo $rodape;
?>