<?php
include ("conn.php");

$email = "gaberosn123@hotmail.com";
$senha = "12345";

$sql = "INSERT INTO usuarios (email, senha)VALUES ('$email','$senha')";

if(mysqli_query($conn, $sql)){
    echo "Usuario inserido com sucesso";
}else{
    echo "Erro ao inserir usuario: ". mysqli_error($conn);
}

mysqli_close($conn);

?>