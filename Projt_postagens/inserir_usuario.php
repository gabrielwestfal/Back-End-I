<?php
include ("config.php");

criarTopo('IFES - Cadastro de Usuário');
criarUsuario();
echo criarFormularioCadastro();
echo $rodape;

?>