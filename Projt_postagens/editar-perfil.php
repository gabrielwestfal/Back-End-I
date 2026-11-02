<?php
include('config.php');
include('config-usuario.php');
include('conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    editarUsuario($_SESSION['id'], $_POST['email'], $_POST['senha'], $conn);
    header("Location: perfil.php");
    exit;
}
criarTopo('Editar Perfil');
criarFormularioEdicao();
echo $rodape;






?>