<?php
session_start();

print_r($_POST);

$nome = @$_POST['login'];
$senha = @$_POST['senha'];


function verificarLogin($nome, $senha) {
if($nome == 'gabriel' && $senha == '123'){
    echo "Login realizado com sucesso!";
    $_SESSION['logado'] = 1;
    $_SESSION['nome'] = $nome;
    header("Location: index.php");
}else {
    echo "Login ou senha incorretos";
    @$_SESSION['logado'] = 0;
    @$_SESSION['mensagem'] = '<div class="mensagem">Login ou senha incorretos!</div>';
    header("Location: login.php");
};
};
 echo verificarLogin($nome, $senha)
?>