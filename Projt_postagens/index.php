<?php
include 'config.php';

criarTopo('IFES - Projeto Postagens');

?>
    <main>
<h1>Olá Projeto Postagens</h1>  
<?php
    if($_SESSION["logado"] == 1){
        echo criaMensagem("Você está logado!", "sucesso");
    }
    
?>
</main>


<?php
echo $rodape;
?>