<?php
include("config.php");
include('conn.php');

criarTopo('IFES - Cadastro de Usuário');
$nome  = $_POST['nome'];
$email = $_POST['email'];
criarUsuario($conn, $nome, $email);
echo criarFormularioCadastro();
echo $rodape;
