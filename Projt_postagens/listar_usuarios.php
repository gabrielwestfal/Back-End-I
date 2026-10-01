<?php
require('config.php');
require('conn.php');
criarTopo('Lista de usuários');
$sql = "SELECT * FROM usuarios";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<main><table class='tabela'>
    <tr>
    <td>Ações</td>
    <td></td>
    <td>ID</td>
    <td>Email</td>
    <td>Senha</td>
    </tr>";
    while ($dados = mysqli_fetch_assoc($result)) {
        echo '<tr>
        <td><button href ="deletar_usuario.php?id=' . $dados["id"] . ' class="btn-acao editar"><ion-icon name="pencil-outline"></ion-icon>Editar</button></td>
        <td><button class="btn-acao excluir"><ion-icon name="trash-outline"></ion-icon>Excluir</button></td>
        <td>' . $dados["id"] . '</td>
        <td>' . $dados["email"] . '</td>
        <td>' . $dados["senha"] . '</td>
        </tr>';
    }
    echo '</table></main>';
} else {
    echo "Nenhum usuario encontrado";
}
mysqli_close($conn);
echo $rodape;
