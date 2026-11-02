<?php
include 'config.php';

$logado = @$_SESSION["logado"];
$email = @$_SESSION["email"];

criarTopo('IFES - Perfil');
criarMenu($logado);
echo '<main><h1>Perfil do Usuário</h1>';

$btnEditar = '<a class="btn-acao editar" href="editar-perfil.php"><ion-icon name="create-outline"></ion-icon>Editar Perfil</a>';
$btnDeletar = '<a class="btn-acao excluir" href="deletar_usuario.php" onclick="return confirm(\'Excluir perfil?\')"><ion-icon name="trash-outline"></ion-icon>Excluir Perfil</a>';

echo '<div class="acoes-perfil">'.$btnEditar.$btnDeletar.'</div></main>';
$mensagem = @$_SESSION['mensagem'];
if (isset($mensagem)) {
    echo $mensagem;
    unset($_SESSION['mensagem']);
}
echo $rodape;
?>