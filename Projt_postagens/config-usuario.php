
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
?>
