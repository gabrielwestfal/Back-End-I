<?php
include 'config.php';
include 'config-postagem.php';
include 'conn.php';
criarTopo('IFES - Projeto Postagens');

$main = '<main>';

echo $main;

listarTodasPostagens($conn);

echo $rodape;
?>