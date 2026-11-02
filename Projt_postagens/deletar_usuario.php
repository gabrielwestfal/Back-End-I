<?php
include('config.php');
include('conn.php');
include('config-usuario.php');
$id = $_SESSION['id'];
excluirUsuario($id, $conn);


?>