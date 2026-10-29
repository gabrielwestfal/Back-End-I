
<?php
include_once 'conn.php';
include_once 'config-usuario.php';


$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

$usuario = buscarLogin($email, $senha, $conn);

if ($usuario != 1 && $usuario !='') {
    $_SESSION["logado"] = 1;
    $_SESSION["id"] = $usuario['id'];

    header("Location: perfil.php");
    
} else {
    $_SESSION["logado"] = 0;
    $_SESSION["mensagem"] = '<div class="mensagem-erro">Usuário ou senha incorretos</div>';

    header("Location: login.php");
}
?>
