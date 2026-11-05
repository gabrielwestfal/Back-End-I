<?php
include_once('config.php');
include('conn.php');
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
$id = @$_SESSION['id'];
function criarPostagem($conn, $titulo, $descricao, $id){

$sql = 'INSERT INTO `postagens` (`id`, `titulo`, `descricao`, `dta`, `idUsuario`) 
VALUES (NULL, "'.$titulo.'", "'.$descricao.'",NOW(),"'.$id.'")';

if(mysqli_query($conn, $sql)){
    criaMensagem('Postagem inserida com sucesso', 'sucesso');
    $_SESSION['logado'] = 1;
    header("Location: posts.php");
    exit();
}else{
    criaMensagem('Erro ao inserir postagem: '. mysqli_error($conn), 'erro');
    $_SESSION['logado'] = 0;
    header("Location: index.php");
    exit();
}

mysqli_close($conn);

}
function editarPostagem($id, $titulo, $descricao, $conn) {
    
    $sql = "UPDATE `postagens`
            SET 
                `titulo` = '$titulo',
                `descricao` = '$descricao'
            WHERE `id` = '$id'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['mensagem'] = '<div class="mensagem-sucesso">Postagem atualizada com sucesso</div>';
    } else {
        $_SESSION['mensagem'] = '<div class="mensagem-erro">Erro ao atualizar postagem: ' . mysqli_error($conn) . '</div>';
    }
    return mysqli_query($conn, $sql);
}
function listarPostagensUsuario($conn, $idUsuario) {
    $sql = "SELECT * FROM `postagens` WHERE `idUsuario` = '$idUsuario'";
    $resultado = mysqli_query($conn, $sql);
    if ($resultado) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            echo '<div class="feed-postagens"><article>
                <h2>  '.$row['titulo'] .' </h2>
                <p>  '.$row['descricao'].'  </p>
                
                <div>
                    <a href="editar-postagem.php?id='.$row['id'].'" class="btn-acao editar">
                        <i class="fa-solid fa-pen-to-square"></i> Editar
                    </a>
                    <a href="deletar-postagem.php?id='.$row['id'].'" class="btn-acao excluir" onclick="return confirm(\'Tem certeza que deseja deletar esta postagem?\')">
                        <i class="fa-solid fa-trash"></i> Deletar
                    </a>
                </div>

                </article></div>';
        }
    } else {
        echo '<div class="mensagem-erro">Erro ao listar postagens: ' . mysqli_error($conn) . '</div>';
    }
}
function listarTodasPostagens($conn){
    $sql = "SELECT * FROM `postagens`";
    $resultado = mysqli_query($conn, $sql);
    if ($resultado) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            echo '<div class="feed-postagens"><article>
                <h2>  '.$row['titulo'] .' </h2>
                <p>  '.$row['descricao'].'  </p>
                </article></div>';
        }
    } else {
        echo '<div class="mensagem-erro">Erro ao listar postagens: ' . mysqli_error($conn) . '</div>';
    }
}

?>