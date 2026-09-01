<?php
session_start();

print_r($_POST);

$nome = $_POST['login'];
$senha = $_POST['senha'];

function verificarLogin($nome, $senha) {
if($nome == 'gabriel' && $senha == '123'){
    echo "Login realizado com sucesso!";
    $_SESSION['logado'] = 1;
    $_SESSION['nome'] = $nome;
}else {
    echo "Login ou senha incorretos";
    $_SESSION['logado'] = 0;
};
};
 echo verificarLogin($nome, $senha)
?>