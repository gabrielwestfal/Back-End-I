<?php
include("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    if ($email !== '' && $senha !== '') {
        criarUsuario($conn, $email, $senha); // redireciona e encerra
    }
}

criarTopo('IFES - Cadastro de Usuário');
echo '<main>'.criarFormularioCadastro().'</main>';
echo $rodape;
