<?php
include_once('config.php');
include_once('config-postagem.php');
include('conn.php');

excluirPostagem($_REQUEST['id'], $conn);
?>