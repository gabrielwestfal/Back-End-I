<?php

function criarFormularioPostagem(){
    $formulario = '
    <div class="container">
    <form class="formulario" action="inserir-postagem.php?action=criar" method="POST">
        <h1>Faça sua Postagem</h1>
        <p>Preencha os campos abaixo</p>
        <div class="campo">
            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo" required>
        </div>
        <div class="campo">
            <label for="descricao">Descrição</label>
            <textarea id="descricao" name="descricao" required></textarea>
        </div>
        <button type="submit">Cadastrar Postagem</button>
    </form>
    </div>
    ';
    echo $formulario;
}
$id = $_SESSION['id'];
function criarPostagem($conn, $titulo, $descricao, $id){

$sql = 'INSERT INTO `postagens` (`id`, `titulo`, `descricao`, `dta`, `idUsuario`) 
VALUES (NULL, "'.$titulo.'", "'.$descricao.'",NOW(),"'.$id.'")';

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