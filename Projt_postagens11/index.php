<?php
include 'config.php';

criarTopo('IFES - Projeto Postagens');

?>
    <main>
<h1>Olá Projeto Postagens</h1>  
<?php
    if(isset($_SESSION['mensagem'])){
        echo $_SESSION['mensagem'];
    }
?>
</main>


<?php
echo $rodape;
?>