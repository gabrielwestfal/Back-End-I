<?php
include 'config.php';

$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';

$stmt = mysqli_prepare($conn, "SELECT id, senha FROM usuarios WHERE email = ?");
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$usuario = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
mysqli_stmt_close($stmt);

if ($usuario && password_verify($senha, $usuario['senha'])) {
    $_SESSION['logado'] = 1;
    $_SESSION['id'] = $usuario['id'];
    $_SESSION['mensagem'] = '<div class="mensagem-sucesso">Login realizado com sucesso!</div>';
    header("Location: index.php");
} else {
    $_SESSION['logado'] = 0;
    $_SESSION['mensagem'] = '<div class="mensagem-erro">Email ou senha incorretos!</div>';
    header("Location: login.php");
}
exit;
