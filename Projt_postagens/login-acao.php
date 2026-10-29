
<?php
session_start();

include_once 'conn.php';
include_once 'config-usuario.php';

$nome = $_POST['nome'] ;
$email = $_POST['email'] ;
$senha = $_POST['senha'] ;

$usuario = buscarLogin($email, $senha, $conn);

if ($usuario != "") {
    $_SESSION["logado"] = 1;
    $_SESSION["nome"] = $nome;
    $_SESSION["id"] = $usuario['id'];

    header("Location: index.php");
    
} else {
    $_SESSION["logado"] = 0;
    $_SESSION["mensagem"] = '<div class="mensagem-erro">Usuário ou senha incorretos</div>';

    header("Location: login.php");
}
?>
