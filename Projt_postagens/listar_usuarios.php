<?php

require ('conn.php');

$sql = "SELECT * FROM usuarios";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        echo "ID:". $row["id"] . "  Email: " . $row["email"] . "  Senha: " . $row["senha"] ."<br>";
    }
}else{
    echo "Nenhum usuario encontrado";
}
mysqli_close($conn);

?>