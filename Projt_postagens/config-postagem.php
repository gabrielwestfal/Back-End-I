<?php
include_once('config.php');
include_once('config-usuario.php');
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
function criarFormularioEditarPostagem($conn, $id){
    $id = (int)$id;
    $resultado = mysqli_query($conn, "SELECT * FROM postagens WHERE id = $id AND idUsuario = " . (int)$_SESSION['id']);
    $post = $resultado ? mysqli_fetch_assoc($resultado) : null;

    if (!$post) {
        echo '<div class="mensagem-erro">Postagem não encontrada.</div>';
        return;
    }

    echo '
    <div class="container">
    <form class="formulario" action="editar-postagem.php" method="POST">
        <h1>Editar Postagem</h1>
        <p>Preencha os campos abaixo</p>
        <input type="hidden" name="id" value="' . $id . '">
        <div class="campo">
            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo" value="' . htmlspecialchars($post['titulo']) . '" required>
        </div>
        <div class="campo">
            <label for="descricao">Descrição</label>
            <textarea id="descricao" name="descricao" required>' . htmlspecialchars($post['descricao']) . '</textarea>
        </div>
        <button type="submit">Editar Postagem</button>
    </form>
    </div>';
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
    $id = (int)$id;
    $titulo = mysqli_real_escape_string($conn, $titulo);
    $descricao = mysqli_real_escape_string($conn, $descricao);
    $idUsuario = (int)$_SESSION['id']; // ajuste ao nome usado na sua sessão

    $sql = "UPDATE `postagens`
            SET `titulo` = '$titulo', `descricao` = '$descricao'
            WHERE `id` = $id AND `idUsuario` = $idUsuario";

    if (mysqli_query($conn, $sql)) {
        criaMensagem('Postagem atualizada com sucesso', 'sucesso');
        header("Location: posts.php");
    } else {
        criaMensagem('Erro ao atualizar postagem: ' . mysqli_error($conn), 'erro');
        header("Location: editar-postagem.php?id=$id");
    }
    exit();
}
function listarPostagensUsuario($conn, $idUsuario) {
    $sql = "SELECT * FROM `postagens` WHERE `idUsuario` = '$idUsuario'";
    $resultado = mysqli_query($conn, $sql);
    if ($resultado) {
        echo '<div class="feed-postagens">';
        while ($row = mysqli_fetch_assoc($resultado)) {
            echo '<article>
                <h2>  '.$row['titulo'] .' </h2>
                <p>  <i class="fa-solid fa-file-text"></i> '.$row['descricao'].'  </p>
                <p>  <i class="fa-solid fa-calendar"></i> '.$row['dta'].'  </p>
                <p>  <i class="fa-solid fa-user"></i> '.buscarUsuario($row['idUsuario'], $conn)['email'].'  </p>
                
                <div>
                    <a href="editar-postagem.php?id='.$row['id'].'" class="btn-acao editar">
                        <i class="fa-solid fa-pen-to-square"></i> Editar
                    </a>
                    <a href="deletar-postagem.php?id='.$row['id'].'" class="btn-acao excluir" onclick="return confirm(\'Tem certeza que deseja deletar esta postagem?\')">
                        <i class="fa-solid fa-trash"></i> Deletar
                    </a>
                </div>

                </article>';
        }
        echo '</div>';
    } else {
        echo '<div class="mensagem-erro">Erro ao listar postagens: ' . mysqli_error($conn) . '</div>';
    }
}
function listarTodasPostagens($conn){
    $sql = "SELECT * FROM `postagens`";
    $resultado = mysqli_query($conn, $sql);
    if ($resultado) {
        echo '<div class="feed-postagens">';
        while ($row = mysqli_fetch_assoc($resultado)) {
            echo '<article>
                <h2>  '.$row['titulo'] .' </h2>
                <p>  <i class="fa-solid fa-file-text"></i> '.$row['descricao'].'  </p>
                <p>  <i class="fa-solid fa-calendar"></i> '.$row['dta'].'  </p>
                <p>  <i class="fa-solid fa-user"></i> '.buscarUsuario($row['idUsuario'], $conn)['email'].'  </p>
                </article>';
        }
        echo '</div>';
    } else {
        echo '<div class="mensagem-erro">Erro ao listar postagens: ' . mysqli_error($conn) . '</div>';
    }
}
function excluirPostagem($id, $conn) {
    $sql = "DELETE FROM `postagens` WHERE `id` = '$id'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['mensagem'] = '<div class="mensagem-sucesso">Postagem excluída com sucesso</div>';
        header("Location: posts.php");
        exit;
    } else {
        $_SESSION['mensagem'] = '<div class="mensagem-erro">Erro ao excluir postagem: ' . mysqli_error($conn) . '</div>';
    }
    return mysqli_query($conn, $sql);
}

?>