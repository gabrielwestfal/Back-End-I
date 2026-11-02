
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
