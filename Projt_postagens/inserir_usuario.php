<?php
include("config.php");
include("config-usuario.php");
include('conn.php');

criarTopo('IFES - Cadastro de Usuário');
$senha = $_POST['senha'];
$email = $_POST['email'];

criarUsuario($conn, $senha, $email);
echo $rodape;
