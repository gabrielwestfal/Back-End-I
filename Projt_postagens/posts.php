<?php
// @session_start();
include 'config.php';
include 'config-postagem.php';
include 'conn.php';
if($_SESSION['logado'] != 1){
    $_SESSION['mensagem'] = '<div class="mensagem-erro">Você precisa estar logado para criar uma postagem</div>';
    header("Location: index.php");
    exit();
}
criarTopo('IFES - Projeto Postagens');

$main = '<main>';

echo $main;
$mensagem = $_SESSION['mensagem'] ?? '';
if (isset($mensagem)) {
    echo $mensagem;
    unset($_SESSION['mensagem']);
}
listarPostagensUsuario($conn, $_SESSION['id']);
echo $rodape;
?>