<?php
include('config.php');
include('config-usuario.php');
include('config-postagem.php');
include('conn.php');
if($_SESSION['logado'] != 1){
    $_SESSION['mensagem'] = '<div class="mensagem-erro">Você precisa estar logado para criar uma postagem</div>';
    header("Location: index.php");
    exit();
}
criarTopo('Criar Postagem');
$titulo = @$_POST['titulo'];
$descricao = @$_POST['descricao'];
criarFormularioPostagem();

if(@$_GET['action'] == 'criar'){
    criarPostagem($conn, $titulo, $descricao, $_SESSION['id']);
    $_SESSION['mensagem'] = '<div class="mensagem-sucesso">Postagem criada com sucesso</div>';
    header('Location: inserir-postagem.php');
}
echo @$_SESSION['mensagem'];

echo $rodape;
?>