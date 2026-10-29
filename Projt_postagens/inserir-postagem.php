<?php
include('config.php');
include('conn.php');
if($_SESSION['logado'] != 1){
    $_SESSION['mensagem'] = '<div class="mensagem-erro">Você precisa estar logado para criar uma postagem</div>';
    header("Location: index.php");
    exit();
}
$id_usuario = $_SESSION['id'];
function criarPostagem($conn, $titulo, $descricao, $id_usuario){

$sql = 'INSERT INTO `postagens` (`id`, `titulo`, `descricao`, `dta`, `idUsuario`) 
VALUES (NULL, "'.$titulo.'", "'.$descricao.'",NOW(),"'.$id_usuario.'")';

if(mysqli_query($conn, $sql)){
    $_SESSION['mensagem'] = '<div class="mensagem-sucesso">Postagem Inserida com sucesso</div>';
    $_SESSION['logado'] = 1;
    header("Location: posts.php");
}else{
    $_SESSION['mensagem'] = '<div class="mensagem-erro">Erro ao inserir postagem: '. mysqli_error($conn) .'</div>';
    $_SESSION['logado'] = 0;
    header("Location: index.php");
}

mysqli_close($conn);

}
?>