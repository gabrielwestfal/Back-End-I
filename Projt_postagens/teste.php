<?php

print_r($_POST);

$nome = $_POST['login'];
$senha = $_POST['senha'];

function verificarLogin($nome, $senha) {
if($nome == 'gabriel' && $senha == '123'){
    return "Parabens vc esta logado";
}else {
    return "Login ou senha incorretos";
};
};
 echo verificarLogin($nome, $senha)
?>