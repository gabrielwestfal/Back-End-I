
<?php
include_once 'config.php';

function buscarLogin($email, $senha, $conn) {
    $dados = "";

    $sql = "SELECT * FROM `usuarios`
            WHERE `email` = '$email'
            AND `senha` = '$senha'";

    $resultado = mysqli_query($conn, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        $dados = mysqli_fetch_assoc($resultado);
    }

    return $dados;
}
function criarUsuario($conn, $senha, $email){
    
$senha = $_POST['senha'];
$email = $_POST['email'];

$sql = "INSERT INTO usuarios (email, senha)VALUES ('$email','$senha')";

if(mysqli_query($conn, $sql)){
    $_SESSION['mensagem'] = '<div class="mensagem-sucesso">Usuario inserido com sucesso</div>';
    $_SESSION['logado'] = 1;
    $_SESSION['id'] = mysqli_insert_id($conn); // Obtém o ID do usuário recém-inserido
    header("Location: index.php");
}else{
    $_SESSION['mensagem'] = '<div class="mensagem-erro">Erro ao inserir usuario: '. mysqli_error($conn) .'</div>';
    $_SESSION['logado'] = 0;
    header("Location: index.php");
}

mysqli_close($conn);

}
function editarUsuario($id, $email, $senha, $conn) {
    
    $sql = "UPDATE `usuarios`
            SET 
                `email` = '$email',
                `senha` = '$senha'
            WHERE `id` = '$id'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['mensagem'] = '<div class="mensagem-sucesso">Perfil atualizado com sucesso</div>';
    } else {
        $_SESSION['mensagem'] = '<div class="mensagem-erro">Erro ao atualizar perfil: ' . mysqli_error($conn) . '</div>';
    }
    return mysqli_query($conn, $sql);
}
function excluirUsuario($id, $conn) {
    $sql = "DELETE FROM `usuarios` WHERE `id` = '$id'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['mensagem'] = '<div class="mensagem-sucesso">Perfil excluído com sucesso</div>';
        session_destroy();
        header("Location: index.php");
        exit;
    } else {
        $_SESSION['mensagem'] = '<div class="mensagem-erro">Erro ao excluir perfil: ' . mysqli_error($conn) . '</div>';
    }
    return mysqli_query($conn, $sql);
}
?>
