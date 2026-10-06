<?php
require('config.php');

paginaRestrita(@$_SESSION["logado"]);

criarTopo('Lista de usuários');
$result = mysqli_query($conn, "SELECT id, email FROM usuarios");

if ($result && mysqli_num_rows($result) > 0) {
    echo "<main><table class='tabela'>
    <tr>
        <td>Ações</td>
        <td></td>
        <td>ID</td>
        <td>Email</td>
    </tr>";
    while ($dados = mysqli_fetch_assoc($result)) {
        $id = (int)$dados["id"];
        echo '<tr>
        <td><a class="btn-acao editar" href="buscar_usuario.php?id='.$id.'"><ion-icon name="pencil-outline"></ion-icon>Editar</a></td>
        <td><a class="btn-acao excluir" href="deletar_usuario.php?id='.$id.'"><ion-icon name="trash-outline"></ion-icon>Excluir</a></td>
        <td>'.$id.'</td>
        <td>'.htmlspecialchars($dados["email"]).'</td>
        </tr>';
    }
    echo '</table></main>';
} else {
    echo "<main><p>Nenhum usuário encontrado</p></main>";
}
echo $rodape;
