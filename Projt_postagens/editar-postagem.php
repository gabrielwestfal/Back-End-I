<?php
include_once('config.php');
include_once('config-postagem.php');
include('conn.php');

if($_SESSION['logado'] != 1){
    $_SESSION['mensagem'] = '<div class="mensagem-erro">Você precisa estar logado para editar uma postagem</div>';
    header("Location: index.php");
    exit();
}

$id = (int)($_REQUEST['id'] ?? 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    editarPostagem($id, $_POST['titulo'] ?? '', $_POST['descricao'] ?? '', $conn);
}

criarTopo('IFES - Editar Postagem');
echo '<main>';
criarFormularioEditarPostagem($conn, $id);
echo '</main>';
echo $rodape;
?>